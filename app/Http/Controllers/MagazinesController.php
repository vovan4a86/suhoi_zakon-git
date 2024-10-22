<?php namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Fanky\Admin\Models\Archive;
use Fanky\Admin\Models\Article;
use Fanky\Admin\Models\Magazine;
use Fanky\Admin\Models\Page;
use Fanky\Auth\Auth;
use View;

class MagazinesController extends Controller {

	public $bread = [];

	public function item($id) {
		$item = Magazine::whereId($id)->public()->first();

		if (!$item) abort(404);
		$item->ogGenerate();
		$item->setSeo();

        Auth::init();
        if (Auth::user() && Auth::user()->isAdmin) {
            View::share('admin_edit_link', route('admin.magazines.edit', [$item->id]));
        }

        $years = Archive::public()
            ->get();

        $more_magazines = Magazine::public()
            ->where('id', '<>', $item->id)
            ->where('archive_id', $item->archive->id)
            ->get();

		return view('magazines.item', [
            'h1'    => $item->getH1(),
            'item'  => $item,
            'years' => $years,
            'more_magazines' => $more_magazines
        ]);
	}
}
