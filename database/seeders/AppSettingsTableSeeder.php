<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AppSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('app_settings')->delete();
        
        \DB::table('app_settings')->insert(array (
            0 => 
            array (
                'earning_type' => NULL,
                'facebook_url' => 'https://www.facebook.com/actcmsvn/',
                'helpline_number' => '+84973909143',
                'id' => 1,
                'inquriy_email' => 'info@actcms.io.vn',
                'instagram_url' => 'https://www.instagram.com/actcmsvn/?igshid=YmMyMTA2M2Y%3D',
                'language_option' => '["nl","fr","it","pt","es","en","ar"]',
                'linkedin_url' => 'https://www.linkedin.com/company/iqonicthemes/',
                'remember_token' => NULL,
                'site_copyright' => '© 2024 All Rights Reserved by ACTCMS Vietnam',
                'site_description' => 'Ra mắt Dịch vụ tại nhà theo yêu cầu trực tuyến trên thiết bị di động của riêng bạn với ứng dụng di động Spa Online. Các mẫu tùy chỉnh của ứng dụng tuyệt vời này có thể nhanh chóng cho phép các nhà phát triển thiết lập hệ thống đặt dịch vụ để chấp nhận đặt dịch vụ từ khách hàng từ bất kỳ đâu chỉ trong vài phút. Với trang Đăng nhập, trang Đăng ký, trang Phương thức thanh toán, danh sách Đặt chỗ, bản demo Loại dịch vụ, trang chi tiết Thợ sửa chữa, trang Phiếu giảm giá, v.v. đã sẵn sàng sử dụng, ứng dụng Spa Online này cho phép doanh nghiệp có ứng dụng hệ thống đặt dịch vụ hoàn chỉnh và đang hoạt động trong thời gian ngắn. Nhà cung cấp trong ứng dụng Spa Online này có thể chỉ định đặt chỗ cho Thợ sửa chữa và đẩy nhanh dịch vụ. Ứng dụng hệ thống Spa Online này đi kèm với bảng quản trị Laravel PHP để có thông tin chi tiết có ý nghĩa từ bảng điều khiển quản trị và số liệu thống kê. Chỉ định nhiều vai trò và quyền như Quản trị viên, Nhà cung cấp dịch vụ, Thợ sửa chữa và khách hàng bằng ứng dụng này. Ngoài ra, ứng dụng Dịch vụ Thợ sửa chữa này hỗ trợ hỗ trợ Nhiều ngôn ngữ/RTL. Ứng dụng có thể tùy chỉnh, sẵn sàng sử dụng này đi kèm với hỗ trợ chủ đề sáng và tối cũng như thông báo đẩy để tương tác với khách hàng theo cách tương tác hơn.',
                'site_email' => NULL,
                'site_favicon' => NULL,
                'site_logo' => '/tmp/phplwW9Vi',
                'site_name' => 'Spa Online',
                'time_zone' => 'Asia/Ho_Chi_Minh',
                'twitter_url' => 'https://twitter.com/actcmsvn',
                'youtube_url' => 'https://www.youtube.com/actcmsvn',
            ),
        ));
        
        
    }
}