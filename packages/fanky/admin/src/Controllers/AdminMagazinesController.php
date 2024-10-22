<?php namespace Fanky\Admin\Controllers;

use Fanky\Admin\Models\Archive;
use Fanky\Admin\Models\Magazine;
use Request;
use Text;
use Validator;
use DB;
use Fanky\Admin\Models\Review;

class AdminMagazinesController extends AdminController {

	public function getIndex()
	{
		$magazines = Magazine::orderBy('archive_id', 'desc')
            ->orderBy('number_year')
            ->get();

		return view('admin::magazines.main', ['magazines' => $magazines]);
	}

	public function getEdit($id = null)
	{
		if (!$id || !($magazine = Magazine::findOrFail($id))) {
			$magazine = new Magazine();
			$magazine->published = 1;
		}
        $archive = Archive::orderBy('year', 'desc')
            ->pluck('year', 'id')
            ->all();

		return view('admin::magazines.edit', [
            'magazine' => $magazine,
            'archive' => $archive,
        ]);
	}

	public function postSave()
	{
		$id = Request::input('id');
		$data = Request::except(['id', 'image', 'file']);
		$image = Request::file('image');
		$file = Request::file('file');

        if (!array_get($data, 'published')) $data['published'] = 0;
		if (!array_get($data, 'on_main')) $data['on_main'] = 0;

        $rules = [
            'number_year' => 'required',
        ];

		// валидация данных
		$validator = Validator::make(
		    $data,
		    $rules
		);
		if ($validator->fails()) {
			return ['errors' => $validator->messages()];
		}

        if ($image) {
            $file_name = Magazine::uploadImage($image);
            $data['image'] = $file_name;
        }

        if ($file) {
            $file_name = Magazine::uploadFile($file);
            $data['file'] = $file_name;
        }

		// сохраняем страницу
		$magazine = Magazine::find($id);
		if (!$magazine) {
			$magazine = Magazine::create($data);
			return ['redirect' => route('admin.magazines.edit', [$magazine->id])];
		} else {
            if ($magazine->image && isset($data['image'])) {
                $magazine->deleteImage();
            }
            if ($magazine->file && isset($data['file'])) {
                $magazine->deleteFile();
            }
			$magazine->update($data);
		}

		return ['msg' => 'Изменения сохранены.'];
	}

	public function postReorder()
	{
		$sorted = Request::input('sorted', []);
		foreach ($sorted as $order => $id) {
			DB::table('magazines')->where('id', $id)->update(array('order' => $order));
		}
		return ['success' => true];
	}

	public function postDelete($id)
	{
		$magazine = Magazine::find($id);
        $magazine->deleteImage();
        $magazine->deleteFile();
		$magazine->delete();

		return ['success' => true];
	}

    public function postDeleteCover($id) {
        $magazine = Magazine::find($id);
        if(!$magazine) return ['msg' => 'Журнал не найден'];

        $magazine->deleteImage();
        $magazine->update(['image' => null]);

        return ['success' => true];
    }

    public function postDeleteFile($id) {
        $magazine = Magazine::find($id);
        if(!$magazine) return ['msg' => 'Журнал не найден'];

        $magazine->deleteFile();
        $magazine->update(['file' => null]);

        return ['success' => true];
    }

}
