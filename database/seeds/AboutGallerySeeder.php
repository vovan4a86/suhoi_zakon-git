<?php

use Carbon\Carbon;
use Fanky\Admin\Models\Page;
use Illuminate\Database\Seeder;

class AboutGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page_about = Page::whereAlias('about')->first();

        if($page_about) {
            $list_params = [
                "thumbs" => [
                    1 => "100x100",
                    2 => "347x490"
                ],
                "fields" => [
                    "text" => [
                        "type" => 0,
                        "title" => "Название"
                    ]
                ]
            ];
            DB::table('galleries')->updateOrInsert(
                [
                    'page_id' => $page_about->id,
                    'code' => 'about_gallery',
                    'name' => 'Благодарственные письма',
                    'params' => json_encode($list_params),
                    'order' => 0,
                ]
            );
        }

    }
}
