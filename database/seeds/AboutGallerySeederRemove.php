<?php

use Illuminate\Database\Seeder;

class AboutGallerySeederRemove extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('galleries')->where('code', 'about_gallery')->delete();
    }
}
