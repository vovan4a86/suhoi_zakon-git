<?php namespace App\Http\Controllers;

use Fanky\Admin\Models\Archive;
use Fanky\Admin\Models\Article;
use Fanky\Admin\Models\News;
use Fanky\Admin\Models\Page;
use Fanky\Admin\Models\Review;
use Illuminate\Http\Response;
use S;

class WelcomeController extends Controller {

    public function index(): Response
    {
        $page = Page::find(1);
        $page->ogGenerate();
        $page->setSeo();

        $news = News::public()
            ->orderByDesc('date')
            ->limit(S::get('main_news_per_page', 6))
            ->get();
        $news_chunks = $news->chunk(3);

        $articles = Article::public()
            ->onMain()
            ->orderByDesc('date')
            ->limit(S::get('main_articles_per_page', 4))
            ->get();
        $articles_chunks = $articles->chunk(2);

        $reviews = Review::public()
            ->onMain()
            ->orderByDesc('date')
            ->limit(S::get('main_reviews_per_page', 6))
            ->get();

        $years = Archive::public()
            ->get();

        $current_year = Archive::where('year', S::get('main_magazines_year', date('Y')))
            ->public()
            ->first();

        $magazines_chunks = [];
        if($current_year) {
            $magazines = $current_year->magazines()
                ->with('archive')
                ->limit(S::get('main_magazines_per_page', 8))
                ->get();

            $magazines_chunks = $magazines->chunk(4);
        }

        return response()->view('pages.index', [
            'page' => $page,
            'text' => $page->text,
            'h1' => $page->getH1(),
            'news_chunks' => $news_chunks,
            'articles_chunks' => $articles_chunks,
            'reviews' => $reviews,
            'years' => $years,
            'magazines_chunks' => $magazines_chunks
        ]);
    }
}
