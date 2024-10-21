<?php namespace App\Http\Controllers;

use Fanky\Admin\Models\Archive;
use Fanky\Admin\Models\Article;
use Fanky\Admin\Models\Page;
use Fanky\Auth\Auth;
use View;

class ArchiveController extends Controller {

	public $bread = [];
	protected $archive_page;

	public function __construct() {
		$this->archive_page = Page::whereAlias('archive_full')
			->first();
	}

	public function index() {
		$page = $this->archive_page;
		if (!$page)
			abort(404, 'Страница не найдена');

        $page->ogGenerate();
        $page->setSeo();

        $years = Archive::public()
            ->with(['public_magazines'])
            ->get();

        $years_chunks = $years->chunk(4);

        return view('archive.index', [
            'h1'    => $page->getH1(),
            'years' => $years,
            'years_chunks' => $years_chunks
        ]);
	}

	public function item($year) {
		$item = Archive::where('year', $year)->public()->first();

		if (!$item) abort(404);
		$item->ogGenerate();
		$item->setSeo();

        $h1 = $this->archive_page->getH1();

        Auth::init();
        if (Auth::user() && Auth::user()->isAdmin) {
            View::share('admin_edit_link', route('admin.articles.edit', [$item->id]));
        }

        $years = Archive::public()
            ->get();

        $magazines = $item->public_magazines;
        $magazines_chunks = $magazines->chunk(4);

		return view('archive.item', [
            'h1'          => $h1,
            'years'      => $years,
            'item'        => $item,
            'magazines_chunks' => $magazines_chunks
        ]);
	}
}
