<?php namespace Fanky\Admin;

use Auth;
use Closure;
use Fanky\Admin\Models\Order;
use Lavary\Menu\Builder;
use Menu;

class AdminMenuMiddleware {

	/**
	 * Run the request filter.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		Menu::make('main_menu', function (Builder $menu) {
			$menu->add('Структура сайта', ['route' => 'admin.pages', 'icon' => 'fa-sitemap'])
				->active('/admin/pages/*');

			$menu->add('Новости', ['route' => 'admin.news', 'icon' => 'fa-calendar'])
				->active('/admin/news/*');

			$menu->add('Статьи', ['route' => 'admin.articles', 'icon' => 'fa-list'])
				->active('/admin/articles/*');

            $menu->add('Отзывы', ['route' => 'admin.reviews', 'icon' => 'fa-star'])
                ->active('/admin/reviews/*');

//			$menu->add('Галереи', ['route' => 'admin.gallery', 'icon' => 'fa-image'])
//				->active('/admin/gallery/*');

			$menu->add('Настройки', ['icon' => 'fa-cogs'])
				->nickname('settings');
			$menu->settings->add('Настройки', ['route' => 'admin.settings', 'icon' => 'fa-gear'])
				->active('/admin/settings/*');
			$menu->settings->add('Редиректы', ['route' => 'admin.redirects', 'icon' => 'fa-retweet'])
				->active('/admin/redirects/*');
		});

		return $next($request);
	}

}
