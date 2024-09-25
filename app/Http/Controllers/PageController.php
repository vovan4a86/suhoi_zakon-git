<?php
namespace App\Http\Controllers;

use App;
use Fanky\Admin\Models\Gallery;
use Fanky\Admin\Models\Page;
use Fanky\Admin\Models\Product;
use Fanky\Admin\Models\SearchIndex;
use Fanky\Auth\Auth;
use Illuminate\Http\Response;
use Request;
use SiteHelper;
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

    public function contacts()
    {
        $page = Page::whereAlias('contacts')->first();
        if (!$page) {
            abort(404, 'Страница не найдена');
        }
        $page->ogGenerate();
        $page->setSeo();

        return view(
            'pages.contacts',
            [
                'page' => $page,
                'text' => $page->text,
                'h1' => $page->getH1(),
            ]
        );
    }

    public function ordering()
    {
        $page = Page::whereAlias('ordering')->first();
        if (!$page) {
            abort(404, 'Страница не найдена');
        }
        $page->ogGenerate();
        $page->setSeo();

        return view(
            'pages.ordering',
            [
                'page' => $page,
                'text' => $page->text,
                'text_after' => $page->text_after,
                'h1' => $page->getH1(),
            ]
        );
    }

    public function about()
    {
        $page = Page::whereAlias('about')->first();
        if (!$page) {
            abort(404, 'Страница не найдена');
        }
        $page->ogGenerate();
        $page->setSeo();

        $about_gallery = Gallery::whereCode('about_gallery')->first();
        $gallery = $about_gallery->items;

        return view(
            'pages.about',
            [
                'page' => $page,
                'text' => $page->text,
                'h1' => $page->getH1(),
                'gallery' => $gallery
            ]
        );
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
