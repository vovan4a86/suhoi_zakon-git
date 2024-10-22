<?php

namespace App\Console\Commands;

use DirectoryIterator;
use Fanky\Admin\Models\Archive;
use Fanky\Admin\Models\Magazine;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class UploadMagazines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:upl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload magazines from directory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $year = 2019;
        $directory = public_path('test/'.$year.'/');

        $iterator = new DirectoryIterator($directory);

        foreach($iterator as $fileInfo) {
            if($fileInfo->isDot()) continue;
            if(!$fileInfo->isDir()) {
                $file_name = $fileInfo->getFilename();
                $name_arr = explode('.pdf', $file_name);

                $numbers = explode('(', $name_arr[0]);

                $data['number_year'] = $numbers[0];
                $data['number_total'] = substr($numbers[1], 0, strlen($numbers[1]) - 1);

                $new_file_name_pdf = md5(uniqid(rand(), true)) . '_' . time() . '.pdf';
                $new_file_name_jpg = md5(uniqid(rand(), true)) . '_' . time() . '.jpg';
                copy($directory . $file_name, public_path(Magazine::UPLOAD_URL . $new_file_name_pdf));
                copy($directory . 'covers/' . $name_arr[0] . '.jpg', public_path(Magazine::UPLOAD_URL . $new_file_name_jpg));

                $data['image'] = $new_file_name_jpg;
                $data['file'] = $new_file_name_pdf;

                $archive = Archive::where('year', $year)->first();
                $data['archive_id'] = $archive->id;

                Magazine::create($data);
            }
        }

        $this->info('Success!!!!');
    }
}
