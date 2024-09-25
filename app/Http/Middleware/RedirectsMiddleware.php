<?php namespace App\Http\Middleware;

use SiteHelper;
use Closure;
use Response;

class RedirectsMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 *
	 * @return mixed
	 */
	public function handle(\Illuminate\Http\Request $request, Closure $next) {
		$url = str_replace($request->root(), '', $request->url());
		//check_regions
		$prefix = '';
		$redirect = SiteHelper::getRedirects($url);
		if ($redirect) {
			return Response::redirectTo($prefix . $redirect->to, $redirect->code);
		} else {
			return $next($request);
		}
	}

}
