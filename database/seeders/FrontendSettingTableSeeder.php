<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FrontendSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonDataSection1 = '{"section_1":1,"title":"Liên kết tức thời của bạn đến dịch vụ Spa hoàn hảo","description":"Trải nghiệm sự dễ dàng: Hãy tin tưởng dịch vụ Spa của chúng tôi. Từ sửa chữa đến lắp đặt, hãy tin tưởng chúng tôi sẽ lo cho bạn. Người trợ giúp gia đình tuyệt vời nhất của bạn!","current_location":"on","enable_search":"on","enable_post_job":"on","enable_popular_services":"on","category_id":["10","11","12","13"],"enable_popular_provider":"on","provider_id":["4","16","7","13"]}';
        $jsonDataSection2 = '{"section_2":1,"title":"Danh mục hàng đầu","category_id":["9","18","22","23"]}';
        $jsonDataSection3 = '{"section_3":1,"title":"Dịch vụ được đánh giá cao nhất","service_id":["35","66","87","85","84","39","40","79"]}';
        $jsonDataSection4 = '{"section_4":1,"title":"Dịch vụ nổi bật","service_id":["13","27","35","44","45","53","66","68"]}';
        $jsonDataSection5 = '{"section_5":1,"title":"Nâng cao doanh số và chuyên môn của bạn bằng cách tham gia cùng chúng tôi","email":"info@actcms.io.vn","contact_number":"+84973909143","description":"Nhà cung cấp tận tâm, cung cấp dịch vụ đặc biệt. Chuyên môn đã được chứng minh về kết quả chất lượng và sự hài lòng của khách hàng. Cùng nhau nâng cao dự án của bạn."}';
        $jsonDataSection6 = '{"section_6":1,"title":"Nâng cao trải nghiệm của bạn với ứng dụng của chúng tôi","description":"Khám phá nhiều dịch vụ tiện ích và cập nhật những ưu đãi mới nhất bằng cách tải xuống ứng dụng của chúng tôi!"}';
        $jsonDataSection7 = '{"section_7":1,"title":"Giải pháp tinh vi và quy trình làm việc chuyên nghiệp hợp lý","description":"Quy trình làm việc hợp lý: Lên kế hoạch, Thực hiện, Cộng tác, Thích ứng. Áp dụng Tự động hóa, Giao tiếp và Linh hoạt để Đạt năng suất cao nhất.","url":"https:\/\/www.youtube.com\/watch?v=KswIQq7j_54","subtitle":["Quản trị viên đến Nhà cung cấp","Nhà cung cấp đến Kỹ thuật viên","Kỹ thuật viên đến Khách hàng"],"subdescription":["Người quản trị tạo điều kiện cho người dùng đặt chỗ và phối hợp với nhà cung cấp để đảm bảo dịch vụ được thực hiện thành công.","Nhà cung cấp sẽ sắp xếp lịch đặt chỗ của người dùng và sau đó liên lạc với Kỹ thuật viên để đảm bảo hoàn thành dịch vụ thành công.","Kỹ thuật viên hoàn thành việc đặt chỗ của người dùng"]}';
        $jsonDataSection8 = '{"section_8":1,"title":"Lượt xem gần đây của bạn & Hơn thế nữa","description":"Dịch vụ Spa đáng tin cậy cho việc sửa chữa, cải tạo và bảo trì của bạn. Đội ngũ chuyên gia lành nghề, giải pháp kịp thời và đảm bảo sự hài lòng của khách hàng."}';
        $jsonDataSection9 = '{"section_9":1,"title":"Khách hàng đáng tin cậy của chúng tôi","overall_rating":"on","description":"Sự hoàn hảo trong thực tế: 99,9% khách hàng hài lòng, hơn 500 đánh giá và 5.068 dịch vụ được cung cấp thành công."}';
        $jsonDataFooterSection = '{"footer_setting":1,"enable_popular_category":1,"category_id":["9","26","24","22","25","16"],"enable_popular_service":1,"service_id":["11","12","13","35","66"]}';
        $jsonDataHeaderSection = '{"header_setting":1,"home":1,"service":1,"provider":1,"categories":1,"blogs":1,"bookings":1,"job_post":1,"enable_language":1,"enable_darknight_mode":1}';
        $jsonDataLoginRegisterSection = '{"login_register":1,"title":"Chào mừng đến với Spa của chúng tôi","description":"Dịch vụ Spa chuyên nghiệp: Spa, Massage, cải tạo và nâng cấp không gian của bạn một cách chuyên nghiệp, đơn giản hóa cuộc sống, từng dự án một."}';
        \DB::table('frontend_settings')->delete();
        $section1Data = json_decode($jsonDataSection1, true);
        $section2Data = json_decode($jsonDataSection2, true);
        $section3Data = json_decode($jsonDataSection3, true);
        $section4Data = json_decode($jsonDataSection4, true);
        $section5Data = json_decode($jsonDataSection5, true);
        $section6Data = json_decode($jsonDataSection6, true);
        $section7Data = json_decode($jsonDataSection7, true);
        $section8Data = json_decode($jsonDataSection8, true);
        $section9Data = json_decode($jsonDataSection9, true);
        $sectionFooterData = json_decode($jsonDataFooterSection, true);
        $sectionHeaderData = json_decode($jsonDataHeaderSection, true);
        $sectionLoginRegisterData = json_decode($jsonDataLoginRegisterSection, true);
        \DB::table('frontend_settings')->insert(array (
            0 =>
            array (
                'id' => 1,
                'type' => 'landing-page-setting',
                'key' => 'section_1',
                'status' => '1',
                'value' => json_encode($section1Data),
            ),
            1 =>
            array (
                'id' => 2,
                'type' => 'landing-page-setting',
                'key' => 'section_2',
                'status' => '1',
                'value' => json_encode($section2Data),
            ),
            array (
                'id' => 3,
                'type' => 'landing-page-setting',
                'key' => 'section_3',
                'status' => '1',
                'value' => json_encode($section3Data),
            ),
            array (
                'id' => 4,
                'type' => 'landing-page-setting',
                'key' => 'section_4',
                'status' => '1',
                'value' => json_encode($section4Data),
            ),
            array (
                'id' => 5,
                'type' => 'landing-page-setting',
                'key' => 'section_5',
                'status' => '1',
                'value' => json_encode($section5Data),
            ),
            array (
                'id' => 6,
                'type' => 'landing-page-setting',
                'key' => 'section_6',
                'status' => '1',
                'value' => json_encode($section6Data),
            ),
            array (
                'id' => 7,
                'type' => 'landing-page-setting',
                'key' => 'section_7',
                'status' => '1',
                'value' => json_encode($section7Data),
            ),
            array (
                'id' => 8,
                'type' => 'footer-setting',
                'key' => 'footer-setting',
                'status' => '1',
                'value' => json_encode($sectionFooterData),
            ),
            array (
                'id' => 9,
                'type' => 'heder-menu-setting',
                'key' => 'heder-menu-setting',
                'status' => '1',
                'value' => json_encode($sectionHeaderData),
            ),
            array (
                'id' => 10,
                'type' => 'landing-page-setting',
                'key' => 'section_8',
                'status' => '1',
                'value' => json_encode($section8Data),
            ),
            array (
                'id' => 11,
                'type' => 'landing-page-setting',
                'key' => 'section_9',
                'status' => '1',
                'value' => json_encode($section9Data),
            ),
            array (
                'id' => 12,
                'type' => 'login-register-setting',
                'key' => 'login-register-setting',
                'status' => '1',
                'value' => json_encode($sectionLoginRegisterData),
            ),
        ));
    }
}
