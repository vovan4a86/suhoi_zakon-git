<?php namespace Fanky\Admin\Controllers;

use Fanky\Admin\Models\Subscriber;

class AdminSubscribersController extends AdminController {

	public function getIndex()
	{
		$subscribers = Subscriber::orderBy('created_at')->paginate(30);

		return view('admin::subscribers.main', ['subscribers' => $subscribers]);
	}
}
