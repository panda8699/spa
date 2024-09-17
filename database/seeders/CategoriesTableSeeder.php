<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 12:55:09',
                'deleted_at' => NULL,
                'description' => 'Vì môi trường sống ngày càng ô nhiễm, cho nên da của chị em ngày càng bị hư tổn và lão hóa. Để khôi phục lại làn da khỏe đẹp của mình, không ít người đã “nhờ cậy” đến các Spa chăm sóc da mặt. Chăm sóc da mặt là một trong các gói dịch vụ Spa cơ bản và đông khách nhất hiện nay, bạn đừng bỏ sót dịch vụ này nhé.',
                'id' => 9,
                'is_featured' => 1,
                'name' => 'Chăm sóc da mặt',
                'status' => 1,
                'category_image' => public_path('/images/category-images/1.svg'),
                'updated_at' => '2023-09-04 12:55:15',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 12:56:14',
                'deleted_at' => NULL,
                'description' => 'Sở hữu đôi lông mày cân đối, sắc nét, đôi môi căng mọng là mơ ước của rất nhiều chị em. Bạn đừng bỏ qua phun xăm thẩm mỹ trong bảng menu dịch vụ spa của mình nhé',
                'id' => 10,
                'is_featured' => 0,
                'name' => 'Phun xăm thẩm mỹ',
                'status' => 1,
                'category_image' => public_path('/images/category-images/2.svg'),
                'updated_at' => '2023-09-04 12:56:14',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 12:57:10',
                'deleted_at' => NULL,
                'description' => 'Dịch vụ trị thâm, nám, tàng nhang giúp lấy lại sự tươi trẻ cho làn da, đây là một trong những dịch vụ spa thu hút khách hàng nhất hiện nay bởi nhu cầu là rất lớn.',
                'id' => 11,
                'is_featured' => 0,
                'name' => 'Trị thâm, nám, tàn nhang',
                'status' => 1,
                'category_image' => public_path('/images/category-images/3.svg'),
                'updated_at' => '2023-09-04 12:57:10',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 12:57:44',
                'deleted_at' => NULL,
                'description' => 'Thông thường một liệu trình dịch vụ trẻ hóa da sẽ bao gồm cả trị sẹo, vết thâm, nám, tàng nhang. Hiệu quả dịch vụ sẽ nhanh chóng và kéo dài tới vài năm. Đây chính là dịch vụ spa mà khách hàng thường hay tìm kiếm, đặc biệt là với nhóm khách hàng trên 30 tuổi.',
                'id' => 12,
                'is_featured' => 0,
                'name' => 'Trẻ hóa da',
                'status' => 1,
                'category_image' => public_path('/images/category-images/4.svg'),
                'updated_at' => '2023-09-04 12:57:44',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 12:58:07',
                'deleted_at' => NULL,
                'description' => 'Massage foot và massage body có tác dụng giúp khách hàng giảm đau, thư giãn, xua tan mệt mỏi và căng thẳng, tăng cường hệ miễn dịch.',
                'id' => 13,
                'is_featured' => 0,
                'name' => 'Massage',
                'status' => 1,
                'category_image' => public_path('/images/category-images/5.svg'),
                'updated_at' => '2023-09-04 12:58:07',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 12:58:27',
                'deleted_at' => NULL,
                'description' => 'Tăng cân, béo phì là vấn đề mà rất nhiều chị em lo lắng, việc chăm lo cho vóc dáng dường như đã trở thành nhu cầu thiết yếu của con người trong cuộc sống hiện đại.',
                'id' => 14,
                'is_featured' => 0,
                'name' => 'Giảm béo',
                'status' => 1,
                'category_image' => public_path('/images/category-images/6.svg'),
                'updated_at' => '2023-09-04 12:58:27',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 12:58:53',
                'deleted_at' => NULL,
                'description' => 'Cũng như giảm béo, tẩy lông vĩnh viễn cũng là điều mà chị em phụ nữ rất quan tâm. Phái đẹp luôn muốn mình có một thân hình cân đối, một làn da mịn màng để dễ dàng diện những bộ cánh body, cắt xẻ quyến rũ.',
                'id' => 15,
                'is_featured' => 0,
                'name' => 'Triệt lông vĩnh viễn',
                'status' => 1,
                'category_image' => public_path('/images/category-images/7.svg'),
                'updated_at' => '2023-09-04 12:58:53',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 12:59:13',
                'deleted_at' => NULL,
                'description' => 'Tắm trắng thực sự là mảnh đất “màu mỡ” mà các Spa nên cho vào danh sách menu dịch vụ làm đẹp. Tuy nhiên, đây cũng là dịch vụ Spa đặc biệt cần nhiều đến các thiết bị Spa đắt tiền như: máy tắm trắng phi thuyền, lồng hấp trắng… Cho nên các chủ đầu tư cũng phải bỏ ra vốn đầu tư không hề nhỏ.',
                'id' => 16,
                'is_featured' => 0,
                'name' => 'Tắm trắng',
                'status' => 1,
                'category_image' => public_path('/images/category-images/8.svg'),
                'updated_at' => '2023-09-04 12:59:13',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 12:59:31',
                'deleted_at' => NULL,
                'description' => 'Mỗi ngày, cơ thể của bạn thường xuyên phải tiếp xúc với ánh nắng mặt trời, khói bụi, làm cho làn da dần trở nên lão hóa. Trong thời tiết lạnh thì da còn bị khô, tróc vảy khiến việc sử dụng mỹ phẩm kém hiệu quả.',
                'id' => 17,
                'is_featured' => 0,
                'name' => 'Tẩy da chết toàn thân',
                'status' => 1,
                'category_image' => public_path('/images/category-images/pandit.png'),
                'updated_at' => '2023-09-04 12:59:31',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 13:00:04',
                'deleted_at' => NULL,
                'description' => 'Sở hữu đôi lông mày cân đối, sắc nét, đôi môi căng mọng là mơ ước của rất nhiều chị em. Bạn đừng bỏ qua phun xăm thẩm mỹ trong bảng menu dịch vụ spa của mình nhé',
                'id' => 18,
                'is_featured' => 1,
                'name' => 'Phun xăm thẩm mỹ',
                'status' => 1,
                'category_image' => public_path('/images/category-images/10.svg'),
                'updated_at' => '2023-09-04 13:06:10',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 13:00:26',
                'deleted_at' => NULL,
                'description' => 'Experience the convenience of pristine garments with our comprehensive Laundry services, ensuring freshness and care for your clothing.🧼',
                'id' => 19,
                'is_featured' => 0,
                'name' => 'Laundry',
                'status' => 1,
                'category_image' => public_path('/images/category-images/laundry.png'),
                'updated_at' => '2023-09-04 13:00:26',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 13:00:55',
                'deleted_at' => NULL,
                'description' => 'The Gardener category cultivates a wealth of knowledge on plant care, landscaping, and sustainable gardening practices to help enthusiasts foster thriving green spaces. 🏡⛏️',
                'id' => 20,
                'is_featured' => 0,
                'name' => 'Gardener',
                'status' => 1,
                'category_image' => public_path('/images/category-images/gardener.png'),
                'updated_at' => '2023-09-04 13:05:54',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 13:01:27',
                'deleted_at' => NULL,
                'description' => 'Experience top-notch Automotive Care for your vehicle\'s longevity and performance. From maintenance to repairs, our experts ensure your ride stays at its best. 🚛🚙',
                'id' => 21,
                'is_featured' => 0,
                'name' => 'Automotive Care',
                'status' => 1,
                'category_image' => public_path('/images/category-images/automotive_care.png'),
                'updated_at' => '2023-09-04 13:01:27',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 13:02:07',
                'deleted_at' => NULL,
                'description' => 'The Cooking category offers a delightful exploration of culinary techniques, recipes, and kitchen tips, catering to both novice cooks and seasoned chefs. 🫕🍲',
                'id' => 22,
                'is_featured' => 1,
                'name' => 'Cooking',
                'status' => 1,
                'category_image' => public_path('/images/category-images/cooking.png'),
                'updated_at' => '2023-09-04 13:02:10',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 13:02:54',
                'deleted_at' => NULL,
                'description' => 'The Plumber category guides you through the intricacies of pipes, fixtures, and plumbing systems to help you tackle issues and master essential plumbing skills. 🛠️',
                'id' => 23,
                'is_featured' => 1,
                'name' => 'Plumber',
                'status' => 1,
                'category_image' => public_path('/images/category-images/plumber.png'),
                'updated_at' => '2023-09-04 13:02:54',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 13:03:21',
                'deleted_at' => NULL,
                'description' => 'Efficiently remove dirt and grime with our cleaning products, restoring surfaces to their pristine condition. 🧼🧽🧹🧻',
                'id' => 24,
                'is_featured' => 1,
                'name' => 'Cleaning',
                'status' => 1,
                'category_image' => public_path('/images/category-images/cleaning.png'),
                'updated_at' => '2023-09-04 13:03:21',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 13:04:01',
                'deleted_at' => NULL,
                'description' => 'Delve into the Electrician category to illuminate your understanding of electrical systems, from wiring complexities to safety essentials. 💡🪛🔌',
                'id' => 25,
                'is_featured' => 1,
                'name' => 'Electrician',
                'status' => 1,
                'category_image' => public_path('/images/category-images/electrician.png'),
                'updated_at' => '2023-09-04 13:06:04',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 13:04:41',
                'deleted_at' => NULL,
                'description' => 'A carpenter is a skilled tradesperson who specializes in working with wood to construct, install, and repair structures and objects. 🪛 🪚',
                'id' => 26,
                'is_featured' => 1,
                'name' => 'Carpenter',
                'status' => 1,
                'category_image' => public_path('/images/category-images/carpenter.png'),
                'updated_at' => '2023-09-04 13:04:53',
            ],
            [
                'color' => '#000000',
                'created_at' => '2023-09-04 13:05:01',
                'deleted_at' => NULL,
                'description' => 'This service will be completed Online/Remotely. 🧑🏻‍🔧🔧🪛',
                'id' => 27,
                'is_featured' => 1,
                'name' => 'Remote Services',
                'status' => 1,
                'category_image' => public_path('/images/category-images/remote_service.png'),
                'updated_at' => '2023-09-04 13:05:01',
            ],
        ];
        
        foreach ($data as $key => $val) {
            $featureImage = $val['category_image'] ?? null;
            $categoryData = Arr::except($val, ['category_image']);
            $category = Category::create($categoryData);
            if (isset($featureImage)) {
                $this->attachFeatureImage($category, $featureImage);
            }
        } 
    }

    private function attachFeatureImage($model, $publicPath)
    {

        $file = new \Illuminate\Http\File($publicPath);

        $media = $model->addMedia($file)->preservingOriginal()->toMediaCollection('category_image');

        return $media;

    }
}