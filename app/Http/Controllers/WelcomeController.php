<?php namespace App\Http\Controllers;

use Fanky\Admin\Models\News;
use Fanky\Admin\Models\Page;
use Illuminate\Http\Response;
use S;

class WelcomeController extends Controller {

    public function index(): Response
    {
        $page = Page::find(1);
        $page->ogGenerate();
        $page->setSeo();

        $news_pack = News::public()
            ->orderByDesc('date')
            ->limit(S::get('news_per_page'))
            ->get();

        $news = $news_pack->chunk(3);

        return response()->view('pages.index', [
            'page' => $page,
            'text' => $page->text,
            'h1' => $page->getH1(),
            'news' => $news
        ]);
    }
}
