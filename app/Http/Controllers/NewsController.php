<?php namespace App\Http\Controllers;

use Fanky\Admin\Models\News;
use Fanky\Admin\Models\Page;
use Fanky\Auth\Auth;
use Settings;
use View;

class NewsController extends Controller {


	public $bread = [];
	protected $news_page;

	public function __construct() {
		$this->news_page = Page::whereAlias('news')
			->first();
	}

	public function index() {
		$page = $this->news_page;
		if (!$page)
			abort(404, 'Страница не найдена');

		$bread = $this->news_page->bread;
        $page->ogGenerate();
        $page->setSeo();

        $items = News::orderBy('date', 'desc')
            ->public()->paginate(Settings::get('news_per_page', 9));

        //обработка ajax-обращений, в routes добавить POST метод(!)
        if (request()->ajax()) {
            $view_items = [];
            foreach ($items as $item) {
                //добавляем новые элементы
                $view_items[] = view('news.list_item', [
                    'item' => $item,
                ])->render();
            }

            return [
                'items'      => $view_items,
                'paginate' => view('paginations.links_limit', ['paginator' => $items])->render()
            ];
        }

        if (count(request()->query())) {
            View::share('canonical', route('news'));
        }

        return view('news.index', [
            'bread' => $bread,
            'h1'    => $page->getH1(),
            'items' => $items
        ]);
	}

	public function item($alias) {
		$item = News::whereAlias($alias)->public()->first();

		if (!$item) abort(404);
		$bread = $this->bread;

		$item->ogGenerate();
		$item->setSeo();

        Auth::init();
        if (Auth::user() && Auth::user()->isAdmin) {
            View::share('admin_edit_link', route('admin.news.edit', [$item->id]));
        }

		$bread[] = [
			'url'  => $item->url,
			'name' => $item->name
		];

		return view('news.item', [
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
