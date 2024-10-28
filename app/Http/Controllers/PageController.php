<?php
namespace App\Http\Controllers;

use App;
use Fanky\Admin\Models\Page;
use Fanky\Admin\Models\SearchIndex;
use Fanky\Auth\Auth;
use Illuminate\Http\Response;
use Request;
use S;
use SEOMeta;
use View;

class PageController extends Controller
{

    public function page($alias = null): Response
    {
        $path = explode('/', $alias);
        if ($alias) {
            $page = Page::getByPath($path);
            if (!$page) {
                abort(404, 'Страница не найдена');
            }
        }

        $bread = $page->getBread();
        $page->h1 = $page->getH1();
        $page->ogGenerate();
        $page->setSeo();

        Auth::init();
        if (Auth::user() && Auth::user()->isAdmin) {
            View::share('admin_edit_link', route('admin.pages.edit', [$page->id]));
        }

        return response()->view(
            'pages.text',
            [
                'page' => $page,
                'h1' => $page->h1,
                'text' => $page->text,
                'text_after' => $page->text_after,
                'title' => $page->title,
                'bread' => $bread,
            ]
        );
    }

    public function policy()
    {
        $page = Page::whereAlias('policy')->first();
        if (!$page) {
            abort(404, 'Страница не найдена');
        }
        $page->ogGenerate();
        $page->setSeo();

        return view(
            'pages.policy',
            [
                'page' => $page,
                'text' => $page->text,
                'h1' => $page->getH1(),
            ]
        );
    }

    public function search() {
        $q = Request::get('q', '');

        if (!$q) {
            $items = [];
        } else {
            $items = SearchIndex::orWhere('name', 'LIKE', '%' . $q . '%')
                ->orWhere('announce_text', 'LIKE', '%' . $q . '%')
                ->orWhere('text', 'LIKE', '%' . $q . '%')
                ->paginate(S::get('search_per_page', 6))
                ->appends(['s' => $q]);
        }

        SEOMeta::setTitle('Результат поиска «' . $q . '»');
        \View::share('canonical', route('search'));

        return view('search.index', [
            'items'       => $items,
            'q'           => $q
        ]);
    }

    public function robots()
    {
        $robots = new App\Robots();
        if (App::isLocal()) {
            $robots->addUserAgent('*');
            $robots->addDisallow('/');
        } else {
            $robots->addUserAgent('*');
            $robots->addDisallow('/admin');
            $robots->addDisallow('/ajax');
        }

        $robots->addHost(config('app.url'));
        $robots->addSitemap(secure_url('sitemap.xml'));

        $response = response($robots->generate())
            ->header('Content-Type', 'text/plain; charset=UTF-8');
        $response->header('Content-Length', strlen($response->getOriginalContent()));

        return $response;
    }
}
