<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
use App\Models\Wallet;
use App\Models\User;
use App\Models\PaymentHistory;
use App\Models\PaymentGateway;
use App\Http\Resources\API\PaymentResource;
use App\Http\Resources\API\PaymentHistoryResource;
use App\Http\Resources\API\GetCashPaymentHistoryResource;
use App\Traits\NotificationTrait;
use App\Http\Resources\API\PaymentGatewayResource;
use App\Models\Service;
use App\Models\Setting;

class PaymentController extends Controller
{
    use NotificationTrait;


    public function savePayment(Request $request)
    {
        $data = $request->all();
        $data['datetime'] = isset($request->datetime) ? date('Y-m-d H:i:s', strtotime($request->datetime)) : date('Y-m-d H:i:s');
        $result = Payment::create($data);
        $booking = Booking::find($request->booking_id);
        if (!empty($result) && $result->payment_status == 'advanced_paid') {
            $booking->advance_paid_amount = $request->advance_payment_amount;
            $booking->status = 'pending';
        }
        $firstHandymanId = optional($booking->handymanAdded->first())->handyman_id;
        $assignedUserData = User::find($firstHandymanId);
        if ($firstHandymanId != null && $assignedUserData->user_type == 'provider') {
            $payment_history = [
                'payment_id' => $result->id,
                'booking_id' => $result->booking_id,
                'parent_id' => $result->booking_id,
                'action' => 'handyman_send_provider',
                'status' => 'pending_by_provider',
                'sender_id' => $request->customer_id,
                'receiver_id' => $firstHandymanId,
                'datetime' => $request->datetime,
                'total_amount' => $request->total_amount,
                'txn_id' => $request->txn_id,
                'type' => $request->payment_type,
                'text' => __('messages.payment_transfer', ['from' => get_user_name($request->customer_id), 'to' => get_user_name($firstHandymanId), 'amount' => getPriceFormat((float) $request->total_amount)]),
            ];
            $res = PaymentHistory::create($payment_history);
            $res->parent_id = $res->id;
            $res->update();
        }
        $service_id = Booking::where('id', $request->booking_id)->pluck('service_id');
        $service = Service::where('id', $service_id)->first();
        $booking->payment_id = $result->id;
        $booking->update();
        $status_code = 200;
        if ($request->payment_type == 'wallet') {
            $wallet = Wallet::where('user_id', $booking->customer_id)->first();
            if ($wallet !== null) {
                $wallet_amount = $wallet->amount;
                if ($wallet_amount >= $request->total_amount) {
                    $wallet->amount = $wallet->amount - $request->total_amount;
                    $wallet->update();
                    $activity_data = [
                        'activity_type' => 'paid_with_wallet',
                        'wallet' => $wallet,
                        'booking_id' => $request->booking_id,
                        'booking_amount' => $request->total_amount,
                        'service_name' => $service->name,
                    ];
                    $this->sendNotification($activity_data);

                } else {
                    $message = __('messages.wallent_balance_error');
                }
            }
        }
        $message = __('messages.payment_completed');
        $activity_data = [
            'activity_type' => 'payment_message_status',
            'payment_status' => $data['payment_status'],
            'booking_id' => $booking->id,
            'booking' => $booking,
            'booking_amount' => $request->total_amount,
        ];
        $this->sendNotification($activity_data);

        if ($result->payment_status == 'failed') {
            $status_code = 400;
        }
        return comman_message_response($message, $status_code);
    }

    public function savePaymentVNPAY(Request $request)
    {
        $data = $request->all();

        $order_info_parts = explode(" ", $data['vnp_OrderInfo']);
        $data_create['booking_id'] = intval($order_info_parts[4]);
        $data_create['total_amount'] = $order_info_parts[6];
        $data_create['discount'] = $order_info_parts[7];
        $type = end($order_info_parts);
        $data_create['payment_type'] = 'vnpay';
        $data_create['txn_id'] = $data['vnp_TxnRef'];
        $vnp_ResponseCode = [
            '00' => 'Giao dịch thành công',
            '07' => 'Trừ tiền thành công. Giao dịch bị nghi ngờ (liên quan tới lừa đảo, giao dịch bất thường)',
            '09' => 'Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng chưa đăng ký dịch vụ InternetBanking tại ngân hàng.',
            '10' => 'Giao dịch không thành công do: Khách hàng xác thực thông tin thẻ/tài khoản không đúng quá 3 lần',
            '11' => 'Giao dịch không thành công do: Đã hết hạn chờ thanh toán. Xin quý khách vui lòng thực hiện lại giao dịch.',
            '12' => 'Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng bị khóa.',
            '13' => 'Giao dịch không thành công do Quý khách nhập sai mật khẩu xác thực giao dịch (OTP). Xin quý khách vui lòng thực hiện lại giao dịch.',
            '24' => 'Giao dịch không thành công do: Khách hàng hủy giao dịch',
            '51' => 'Giao dịch không thành công do: Tài khoản của quý khách không đủ số dư để thực hiện giao dịch.',
            '65' => 'Giao dịch không thành công do: Tài khoản của Quý khách đã vượt quá hạn mức giao dịch trong ngày.',
            '75' => 'Ngân hàng thanh toán đang bảo trì.',
            '79' => 'Giao dịch không thành công do: KH nhập sai mật khẩu thanh toán quá số lần quy định. Xin quý khách vui lòng thực hiện lại giao dịch',
            '99' => 'Các lỗi khác (lỗi còn lại, không có trong danh sách mã lỗi đã liệt kê)'
        ];


        $booking = Booking::find($data_create['booking_id']);
        $result = Payment::where('booking_id', $data_create['booking_id'])->first();
        if ($data['vnp_ResponseCode'] === "00") {
            $result->other_transaction_detail = $vnp_ResponseCode[$data['vnp_ResponseCode']];
            $data_create['txn_id'] = $data['vnp_BankTranNo'];

            if ($type == 'advance_payment') {
                $result->payment_status = 'advanced_paid';
            } else {
                $result->payment_status = 'paid';
                $booking->advance_paid_amount = $booking->advance_paid_amount + $data_create['total_amount'];
            }

        }
        ;
        $result->update($data_create);

        $booking->payment_id = $result->id;

        if (!empty($result) && $result->payment_status == 'advanced_paid') {
            $booking->advance_paid_amount = $result->total_amount;
            $booking->status = 'pending';
        }
        $booking->payment_id = $result->id;
        $booking->update();
        $activity_data = [
            'activity_type' => 'payment_message_status',
            'payment_status' => str_replace("_", " ", ucfirst($result->payment_status)),
            'booking_id' => $booking->id,
            'booking' => $booking,
        ];
        $this->sendNotification($activity_data);

        return redirect('/booking-list');
    }
    public function savePaymentMomo(Request $request)
    {
        $data = $request->all();
        $order_info_parts = explode("_", $data['orderInfo']);
        $data_create['booking_id'] = intval($order_info_parts[4]);
        $data_create['total_amount'] = $data['amount'];
        $data_create['discount'] = $order_info_parts[7];
        $data_create['payment_type'] = 'momo';
        $type = $order_info_parts[8] . '_' . $order_info_parts[9];

        $data_create['other_transaction_detail'] = $data['message'];

        $result = Payment::where('booking_id', $data_create['booking_id'])->first();
        $booking = Booking::find($data_create['booking_id']);

        if ($data['resultCode'] === "0") {
            $result->other_transaction_detail = $data['message'];
            $data_create['txn_id'] = $data['orderId'];

            if ($type == 'advance_payment') {
                $result->payment_status = 'advanced_paid';
            } else {
                $result->payment_status = 'paid';
                $booking->advance_paid_amount = $booking->advance_paid_amount + $data_create['total_amount'];

            }

        }
        ;
        $result->update();
        if (!empty($result) && $result->payment_status == 'advanced_paid') {
            $booking->advance_paid_amount = $result->total_amount;
            $booking->status = 'pending';
        }
        $booking->payment_id = $result->id;
        $booking->update();

        $activity_data = [
            'activity_type' => 'payment_message_status',
            'payment_status' => str_replace("_", " ", ucfirst($result->payment_status)),
            'booking_id' => $booking->id,
            'booking' => $booking,
        ];
        $this->sendNotification($activity_data);

        return redirect('/booking-list');
    }

    public function paymentList(Request $request)
    {
        $payment = Payment::myPayment()->with('booking');
        if ($request->has('booking_id') && !empty($request->booking_id)) {
            $payment->where('booking_id', $request->booking_id);
        }
        if ($request->has('payment_type') && !empty($request->payment_type)) {

            if ($request->payment_type == 'cash') {
                $payment->where('payment_type', $request->payment_type);
            }
        }
        $per_page = config('constant.PER_PAGE_LIMIT');
        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $payment->count();
            }
        }

        $payment = $payment->orderBy('id', 'desc')->paginate($per_page);
        $items = PaymentResource::collection($payment);

        $response = [
            'pagination' => [
                'total_items' => $items->total(),
                'per_page' => $items->perPage(),
                'currentPage' => $items->currentPage(),
                'totalPages' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem(),
                'next_page' => $items->nextPageUrl(),
                'previous_page' => $items->previousPageUrl(),
            ],
            'data' => $items,
        ];

        return comman_custom_response($response);
    }

    public function transferPayment(Request $request)
    {
        $sitesetup = Setting::where('type', 'site-setup')->where('key', 'site-setup')->first();
        $admin = json_decode($sitesetup->value);
        $data = $request->all();
        $auth_user = authSession();
        $user_id = $auth_user->id;


        date_default_timezone_set($admin->time_zone ?? 'UTC');
        $data['datetime'] = date('Y-m-d H:i:s');

        if ($data['action'] == config('constant.PAYMENT_HISTORY_ACTION.HANDYMAN_SEND_PROVIDER')) {
            $data['text'] = __(
                'messages.payment_transfer',
                ['from' => get_user_name($data['sender_id']), 'to' => get_user_name($data['receiver_id']), 'amount' => getPriceFormat((float) $data['total_amount'])]
            );
        }
        if ($data['action'] == config('constant.PAYMENT_HISTORY_ACTION.PROVIDER_APPROVED_CASH')) {
            $data['text'] = __('messages.cash_approved', ['amount' => getPriceFormat((float) $data['total_amount']), 'name' => get_user_name($data['receiver_id'])]);
        }
        if ($data['action'] == config('constant.PAYMENT_HISTORY_ACTION.PROVIDER_SEND_ADMIN')) {
            $data['text'] = __('messages.payment_transfer', [
                'from' => get_user_name($data['sender_id']),
                'to' => get_user_name(admin_id()),
                'amount' => getPriceFormat((float) $data['total_amount'])
            ]);
        }
        $result = \App\Models\PaymentHistory::create($data);

        if ($data['action'] == 'provider_approved_cash' && $data['status'] == 'approved_by_provider') {
            $get_parent_history = \App\Models\PaymentHistory::where('id', $request->p_id)->first();
            $get_parent_history->status = 'approved_by_provider';
            $get_parent_history->update();

            $get_main_record = \App\Models\PaymentHistory::where('id', $request->parent_id)->first();
            $get_main_record->status = 'approved_by_provider';
            $get_main_record->update();

            $bookingdata = Booking::find($request->booking_id);
            $paymentdata = Payment::where('booking_id', $bookingdata->id)->first();
            if ($bookingdata->payment_id != null) {
                $payment_status = 'pending_by_admin';
                $paymentdata->update(['payment_status' => $payment_status]);
            }
        }
        if ($data['action'] == 'provider_send_admin' && $data['status'] == 'pending_by_admin') {
            $get_parent_history = \App\Models\PaymentHistory::where('id', $request->p_id)->first();
            $get_parent_history->status = 'pending_by_admin';
            $get_parent_history->update();
        }
        if ($data['action'] == 'handyman_send_provider' && $data['status'] == 'pending_by_provider') {
            $get_parent_history = \App\Models\PaymentHistory::where('id', $request->p_id)->first();
            $get_parent_history->status = 'send_to_provider';
            $get_parent_history->update();
        }
        $message = trans('messages.transfer');
        if ($request->is('api/*')) {
            return comman_message_response($message);
        }
    }

    public function paymentHistory(Request $request)
    {
        $booking_id = $request->booking_id;
        $payment = PaymentHistory::where('booking_id', $booking_id);

        $per_page = config('constant.PER_PAGE_LIMIT');
        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $payment->count();
            }
        }

        $payment = $payment->orderBy('id', 'desc')->paginate($per_page);
        $items = PaymentHistoryResource::collection($payment);

        $response = [
            'pagination' => [
                'total_items' => $items->total(),
                'per_page' => $items->perPage(),
                'currentPage' => $items->currentPage(),
                'totalPages' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem(),
                'next_page' => $items->nextPageUrl(),
                'previous_page' => $items->previousPageUrl(),
            ],
            'data' => $items,
        ];

        return comman_custom_response($response);

    }

    public function getCashPaymentHistory(Request $request)
    {
        $payment_id = $request->payment_id;
        $payment = PaymentHistory::where('payment_id', $payment_id)->with('booking');

        $per_page = config('constant.PER_PAGE_LIMIT');
        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $payment->count();
            }
        }

        $payment = $payment->orderBy('id', 'desc')->paginate($per_page);
        $items = GetCashPaymentHistoryResource::collection($payment);

        $response = [
            'pagination' => [
                'total_items' => $items->total(),
                'per_page' => $items->perPage(),
                'currentPage' => $items->currentPage(),
                'totalPages' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem(),
                'next_page' => $items->nextPageUrl(),
                'previous_page' => $items->previousPageUrl(),
            ],
            'data' => $items,
        ];

        return comman_custom_response($response);

    }


    public function paymentDetail(Request $request)
    {
        $auth_user = authSession();
        $user_id = $auth_user->id;

        $get_all_payments = PaymentHistory::where('receiver_id', $user_id);
        if (!empty($request->status)) {
            $get_all_payments = $get_all_payments->where('status', $request->status);
        }
        if (!empty($request->status) && $request->status == 'send_to_admin') {
            $get_all_payments = PaymentHistory::where('sender_id', $user_id);
            $get_all_payments = $get_all_payments->where('status', 'pending_by_admin');
        }

        if (!empty($request->from) && !empty($request->to)) {
            $get_all_payments = $get_all_payments->whereDate('datetime', '>=', $request->from)->whereDate('datetime', '<=', $request->to);
        }
        if (auth()->user()->hasAnyRole(['handyman'])) {
            $get_all_payments = $get_all_payments->where('action', 'handyman_approved_cash')->where('receiver_id', $user_id);
        }

        if (auth()->user()->hasAnyRole(['provider'])) {
            if (!empty($request->status) && $request->status == 'send_to_admin') {
                $get_all_payments = $get_all_payments->where('action', 'provider_send_admin')->where('sender_id', $user_id);
            } else {
                $get_all_payments = $get_all_payments->where('action', 'handyman_send_provider')->where('receiver_id', $user_id);
            }
        }

        $per_page = config('constant.PER_PAGE_LIMIT');
        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $get_all_payments->count();
            }
        }

        $get_all_payments = $get_all_payments->orderBy('id', 'desc')->paginate($per_page);


        $items = PaymentHistoryResource::collection($get_all_payments);

        $response = [
            'today_cash' => today_cash_total($user_id, $request->to, $request->from),
            'total_cash' => total_cash($user_id),
            'cash_detail' => $items
        ];

        return comman_custom_response($response);
    }

    public function getCashPayment(Request $request)
    {
        $payment = Payment::where('payment_type', 'cash');

        $per_page = config('constant.PER_PAGE_LIMIT');
        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $payment->count();
            }
        }

        $payment = $payment->orderBy('id', 'desc')->paginate($per_page);
        $items = PaymentResource::collection($payment);

        $response = [
            'pagination' => [
                'total_items' => $items->total(),
                'per_page' => $items->perPage(),
                'currentPage' => $items->currentPage(),
                'totalPages' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem(),
                'next_page' => $items->nextPageUrl(),
                'previous_page' => $items->previousPageUrl(),
            ],
            'data' => $items,
        ];

        return comman_custom_response($response);
    }
    public function paymentGateways(Request $request)
    {
        $payment = PaymentGateway::where('status', 1)->where('type', '!=', 'razorPayX')->get();
        $payment = PaymentGatewayResource::collection($payment);

        return comman_custom_response($payment);
    }
}
