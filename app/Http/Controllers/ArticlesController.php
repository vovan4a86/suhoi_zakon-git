<?php namespace App\Http\Controllers;

use Fanky\Admin\Models\Article;
use Fanky\Admin\Models\News;
use Fanky\Admin\Models\Page;
use Fanky\Auth\Auth;
use Illuminate\Http\Request;
use Settings;
use View;

class ArticlesController extends Controller {

	public $bread = [];
	protected $articles_page;

	public function __construct() {
		$this->articles_page = Page::whereAlias('articles')
			->first();
	}

	public function index() {
		$page = $this->articles_page;
		if (!$page)
			abort(404, 'Страница не найдена');

		$bread = $this->articles_page->bread;
        $page->ogGenerate();
        $page->setSeo();

        $items = Article::public()->orderBy('order')
            ->paginate(Settings::get('articles_per_page', 9));

        if (count(request()->query())) {
            View::share('canonical', route('articles'));
        }

        return view('articles.index', [
            'bread' => $bread,
            'h1'    => $page->getH1(),
            'items' => $items
        ]);
	}

	public function item($alias) {
		$item = Article::whereAlias($alias)->public()->first();

		if (!$item) abort(404);
		$bread = $this->bread;

		$item->ogGenerate();
		$item->setSeo();

        Auth::init();
        if (Auth::user() && Auth::user()->isAdmin) {
            View::share('admin_edit_link', route('admin.articles.edit', [$item->id]));
        }

		$bread[] = [
			'url'  => $item->url,
			'name' => $item->name
		];

		return view('articles.item', [
            'bread'       => $bread,
            'date'        => $item->dateFormat('F d, Y'),
            'h1'          => $item->getH1(),
            'text'        => $item->text,
            'announce'    => $item->announce,
            'item'        => $item,
            'images'      => $item->images
        ]);
	}
}
