<?php namespace App\Http\Controllers;

use Fanky\Admin\Models\Page;
use Illuminate\Http\Response;
use Settings;

class WelcomeController extends Controller {

    public function index(): Response
    {
        $page = Page::find(1);
        $page->ogGenerate();
        $page->setSeo();

        $all_services = Settings::get('main_services');
        $services = array_chunk($all_services, 3);

        return response()->view('pages.index', [
            'page' => $page,
            'text' => $page->text,
            'h1' => $page->getH1(),
            'services' => $services
        ]);
    }
}
