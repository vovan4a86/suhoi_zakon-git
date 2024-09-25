<?php namespace Fanky\Admin\Controllers;

use Fanky\Admin\Models\Article;
use Fanky\Admin\Models\PublicationTag;
use Fanky\Admin\Settings;
use Illuminate\Support\Str;
use Request;
use Validator;
use Text;
use Thumb;
use Image;

class AdminArticlesController extends AdminController {

	public function getIndex() {
		$articles = Article::orderBy('date', 'desc')->paginate(100);

		return view('admin::articles.main', ['articles' => $articles]);
	}

	public function getEdit($id = null) {
		if (!$id || !($article = Article::find($id))) {
			$article = new Article();
			$article->date = date('Y-m-d');
			$article->published = 1;
		}

		return view('admin::articles.edit', ['article' => $article]);
	}

	public function postSave() {
		$id = Request::input('id');
		$data = Request::except(['id', 'image']);
		$image = Request::file('image');

		if (!array_get($data, 'alias')) $data['alias'] = Text::translit($data['name']);
		if (!array_get($data, 'title')) $data['title'] = $data['name'];
		if (!array_get($data, 'published')) $data['published'] = 0;

		// валидация данных
		$validator = Validator::make($data, [
				'name' => 'required',
				'date' => 'required',
			]);
		if ($validator->fails()) {
			return ['errors' => $validator->messages()];
		}

		// Загружаем изображение
		if ($image) {
			$file_name = Article::uploadImage($image);
			$data['image'] = $file_name;
		}

		// сохраняем страницу
		$article = Article::find($id);
		$redirect = false;
		if (!$article) {
			$article = Article::create($data);
			$redirect = true;
		} else {
			if ($article->image && isset($data['image'])) {
				$article->deleteImage();
			}
			$article->update($data);
		}

		if($redirect){
			return ['redirect' => route('admin.articles.edit', [$article->id])];
		} else {
			return ['msg' => 'Изменения сохранены.'];
		}

	}

	public function postDelete($id) {
		$article = Article::find($id);
		$article->delete();

		return ['success' => true];
	}
}
