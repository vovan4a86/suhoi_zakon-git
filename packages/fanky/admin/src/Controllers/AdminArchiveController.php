<?php namespace Fanky\Admin\Controllers;

use Fanky\Admin\Models\Archive;
use Request;
use Text;
use Validator;
use DB;
use Fanky\Admin\Models\Review;

class AdminArchiveController extends AdminController {

	public function getIndex()
	{
		$archive = Archive::orderBy('year', 'desc')->get();

		return view('admin::archive.main', ['archive' => $archive]);
	}

	public function getEdit($id = null)
	{
		if (!$id || !($arc = Archive::findOrFail($id))) {
			$arc = new Archive();
			$arc->published = 1;
		}

		return view('admin::archive.edit', ['arc' => $arc]);
	}

	public function postSave()
	{
		$id = Request::input('id');
		$data = Request::except(['id', 'image']);

        if (!array_get($data, 'published')) $data['published'] = 0;

        $rules = [
            'year' => 'required',
        ];

		// валидация данных
		$validator = Validator::make(
		    $data,
		    $rules
		);
		if ($validator->fails()) {
			return ['errors' => $validator->messages()];
		}

		// сохраняем страницу
		$arc = Archive::find($id);
		if (!$arc) {
			$arc = Archive::create($data);
			return ['redirect' => route('admin.archive.edit', [$arc->id])];
		} else {
			$arc->update($data);
		}

		return ['msg' => 'Изменения сохранены.'];
	}

	public function postDelete($id)
	{
		$arc = Archive::find($id);

        if(count($arc->magazines)) {
            foreach ($arc->magazines as $m) {
                $m->delete();
            }
        }
		$arc->delete();

		return ['success' => true];
	}

}
