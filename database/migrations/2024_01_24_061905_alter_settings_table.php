<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use App\Models\AppSetting;
use App\Models\AppDownload;

class AlterSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $appSettingsData = [];
        $socialMediaData = [];
        $earningData = [];

        $siteSetupData = [
            'type' => 'site-setup',
            'key' => 'site-setup',
            'value' => [],
        ];

        $appsettings = AppSetting::all();
        foreach ($appsettings as $appsetting) {
            if(!empty($appsetting)){

                $appSettingsData[] = [
                    'type' => 'general-setting',
                    'key' => 'general-setting',
                    'value' => [
                        'site_name' => $appsetting->site_name ?? "Spa Online",
                        'site_description' => $appsetting->site_description ?? "Ra mắt Dịch vụ tại nhà theo yêu cầu trực tuyến trên thiết bị di động của riêng bạn với ứng dụng di động Spa Online. Các mẫu tùy chỉnh của ứng dụng tuyệt vời này có thể nhanh chóng cho phép các nhà phát triển thiết lập hệ thống đặt dịch vụ để chấp nhận đặt dịch vụ từ khách hàng từ bất kỳ đâu chỉ trong vài phút. Với trang Đăng nhập, trang Đăng ký, trang Phương thức thanh toán, danh sách Đặt dịch vụ, bản demo Loại dịch vụ, trang chi tiết Thợ sửa chữa, trang Phiếu giảm giá, v.v. sẵn sàng sử dụng, ứng dụng Spa Online này cho phép các doanh nghiệp có ứng dụng hệ thống đặt dịch vụ hoàn chỉnh và đang chạy trong thời gian ngắn. Nhà cung cấp trong ứng dụng Spa Online này có thể chỉ định đặt dịch vụ cho Thợ sửa chữa và đẩy nhanh dịch vụ. Ứng dụng hệ thống Spa Online này đi kèm với bảng quản trị Laravel PHP để có thông tin chi tiết có ý nghĩa từ bảng điều khiển quản trị và số liệu thống kê. Chỉ định nhiều vai trò và quyền như Quản trị viên, Nhà cung cấp dịch vụ, Thợ sửa chữa và khách hàng bằng ứng dụng này. Ngoài ra, ứng dụng Spa Online này hỗ trợ hỗ trợ Nhiều ngôn ngữ/RTL. Ứng dụng tùy chỉnh, sẵn sàng sử dụng này đi kèm với hỗ trợ chủ đề sáng và tối cũng như thông báo đẩy để tương tác với khách hàng theo cách tương tác hơn.",
                        'inquriy_email' => $appsetting->inquriy_email ?? "info@actcms.io.vn",
                        'helpline_number' => $appsetting->helpline_number ?? "+84973909143",
                        'website' => $appsetting->website ?? null,
                        'country_id' => $appsetting->country_id ?? "1",
                        'state_id' => $appsetting->state_id ?? "50",
                        'city_id' => $appsetting->city_id ?? "30",
                        'zipcode' => $appsetting->zipcode ?? "71000",
                        'address' => $appsetting->address ?? "123 Đ. Nguyễn Huệ, Bến Nghé, Quận 1, Hồ Chí Minh, Việt Nam",
                    ],
                ];




                $socialMediaData[] = [
                    'type' => 'social-media',
                    'key' => 'social-media',
                    'value' => [
                        'facebook_url' => $appsetting->facebook_url ?? "https://www.facebook.com/actcmsvn/",
                        'instagram_url' => $appsetting->instagram_url ?? "https://www.instagram.com/actcmsvn/?igshid=YmMyMTA2M2Y%3D",
                        'twitter_url' => $appsetting->twitter_url ?? "https://twitter.com/actcmsvn",
                        'linkedin_url' => $appsetting->linkedin_url ?? "https://www.linkedin.com/company/iqonicthemes/",
                        'youtube_url' => $appsetting->youtube_url ?? "https://www.youtube.com/actcmsvn",
                    ],
                ];

                $earningData[] = [
                    'type' => 'earning-setting',
                    'key' => 'earning-setting',
                    'value' => $appsetting->earning_type ?? 'commission',
                ];



                $siteSetupData['value'] = [
                    'date_format' => $appsetting->date_format ?? "F j, Y",
                    'time_format' => $appsetting->time_format ?? "g:i A",
                    'time_zone' => $appsetting->time_zone ?? "Asia/Ho_Chi_Minh",
                    'language_option' => $appsetting->language_option ?? ["vi", "en"],
                    'default_currency' => $appsetting->default_currency ?? "1",
                    'currency_position' => $appsetting->currency_position ?? "right",
                    'google_map_keys' => $appsetting->google_map_keys ?? "AIzaSyCtTed7y_ePqg1QoDMHOyu01FtP_Ot-mDU",
                    'latitude' => $appsetting->latitude ?? null,
                    'longitude' => $appsetting->longitude ?? null,
                    'distance_type' => $appsetting->distance_type ?? "km",
                    'radious' => $appsetting->radious ?? "50",
                    'digitafter_decimal_point' => $appsetting->digitafter_decimal_point ?? "0",
                    'android_app_links' => $appsetting->android_app_links ?? 0,
                    'playstore_url' => $appsetting->playstore_url ?? "https://play.google.com/store/apps/details?id=io.actcms.spa.user",
                    'provider_playstore_url' => $appsetting->provider_playstore_url ?? "https://play.google.com/store/apps/details?id=io.actcms.spa.vendor",
                    'ios_app_links' => $appsetting->ios_app_links ?? 0,
                    'appstore_url' => $appsetting->appstore_url ?? "https://apps.apple.com/vn/app/market-online/id6472641956",
                    'provider_appstore_url' => $appsetting->provider_appstore_url ?? "https://apps.apple.com/vn/app/it-home-dịch-vụ-tại-nhà/id6484594491",
                    'site_copyright' => $appsetting->site_copyright ?? "© 2024 All Rights Reserved by ACTCMS Vietnam",
                ];
            }
        }

        $appdownloads = AppDownload::all();
        foreach ($appdownloads as $appdownload) {
            if (!empty($appdownload)) {
                $siteSetupData['value']['playstore_url'] = $appdownload->playstore_url ?? "https://play.google.com/store/apps/details?id=io.actcms.spa.user";
                $siteSetupData['value']['provider_playstore_url'] = $appdownload->provider_playstore_url ?? "https://play.google.com/store/apps/details?id=io.actcms.spa.vendor";
                $siteSetupData['value']['appstore_url'] = $appdownload->appstore_url ?? "https://apps.apple.com/vn/app/market-online/id6472641956";
                $siteSetupData['value']['provider_appstore_url'] = $appdownload->provider_appstore_url ?? "https://apps.apple.com/vn/app/it-home-dịch-vụ-tại-nhà/id6484594491";

            }
        }

        $settings = Setting::all();
        foreach ($settings as $setting) {

            if ($setting->key == 'CURRENCY_COUNTRY_ID') {
                $siteSetupData['value']['default_currency'] = $setting->value ?? "1";
            }

            if ($setting->key == 'CURRENCY_POSITION') {
                $siteSetupData['value']['currency_position'] = $setting->value ?? "right";
            }

            if ($setting->key == 'DISTANCE_TYPE') {
                $siteSetupData['value']['distance_type'] = $setting->value ?? "km";
            }

            if ($setting->key == 'DISTANCE_RADIOUS') {
                $siteSetupData['value']['radious'] = $setting->value ?? "50";
            }

            if ($setting->key == 'GOOGLE_MAP_KEY') {
                $siteSetupData['value']['google_map_keys'] = $setting->value ?? "AIzaSyCtTed7y_ePqg1QoDMHOyu01FtP_Ot-mDU";
            }
            if ($setting->key == 'OTHER_SETTING') {
                $setting->update([
                    'value' => '{"social_login":1,"google_login":1,"apple_login":1,"otp_login":1,"online_payment":1,"blog":1,"maintenance_mode":0, "advanced_payment_setting":1,"wallet":1,"enable_chat_gpt":1,"test_without_key":1,"chat_gpt_key":null,"force_update_user_app":0,"user_app_minimum_version":null,"user_app_latest_version":null,"force_update_provider_app":0,"provider_app_minimum_version":null,"provider_app_latest_version":null,"force_update_admin_app":0,"admin_app_minimum_version":null,"admin_app_latest_version":null,"firebase_notification":1,"project_id":"Firebase Key","auto_assign_provider":0}',
                ]);
            }
            else{
                Setting::firstOrCreate([
                    'type' => 'OTHER_SETTING',
                    'key' => 'OTHER_SETTING',
                ], [
                    'value' =>  '{"social_login":1,"google_login":1,"apple_login":1,"otp_login":1,"online_payment":1,"blog":1,"maintenance_mode":0, "advanced_payment_setting":1,"wallet":1,"enable_chat_gpt":1,"test_without_key":1,"chat_gpt_key":null,"force_update_user_app":0,"user_app_minimum_version":null,"user_app_latest_version":null,"force_update_provider_app":0,"provider_app_minimum_version":null,"provider_app_latest_version":null,"force_update_admin_app":0,"admin_app_minimum_version":null,"admin_app_latest_version":null,"firebase_notification":1,"project_id":"Firebase Key","auto_assign_provider":0}',
                ]);
            }
            if ($setting->key != 'service-configurations') {
                Setting::firstOrCreate([
                    'type' => 'service-configurations',
                    'key' => 'service-configurations',
                ], [
                    'value' => '{"advance_payment":1,"slot_service":1,"digital_services":1,"service_packages":1,"service_addons":1,"post_services":1}',
                ]);
            }
            if ($setting->key != 'cookie-setup') {
                Setting::firstOrCreate([
                    'type' => 'cookie-setup',
                    'key' => 'cookie-setup',
                ], [
                    'value' => '{"title":"Thông báo về cookie","description":"Chúng tôi sử dụng cookie để duyệt tốt hơn, nội dung được cá nhân hóa và phân tích lưu lượng truy cập. Nhấp vào `Chấp nhận tất cả` để đồng ý."}',
                ]);
            }
        }

        $mergedData = array_merge($appSettingsData, $socialMediaData,$earningData, [$siteSetupData]);

        foreach ($mergedData as $data) {
            $existingSetting = Setting::where('type', $data['type'])->where('key', $data['key'])->first();
            if ($existingSetting) {
                $existingSetting->update(['value' => json_encode($data['value'])]);
            } else {
                Setting::create([
                    'type' => $data['type'],
                    'key' => $data['key'],
                    'value' => json_encode($data['value']),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // You can add rollback logic if needed
    }
}
