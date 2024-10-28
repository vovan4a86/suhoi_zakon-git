<?php namespace Fanky\Admin\Controllers;

use Fanky\Admin\Models\Article;
use Fanky\Admin\Models\ArticleImage;
use Pagination;
use Request;
use Validator;
use Text;

class AdminArticlesController extends AdminController {

	public function getIndex() {
		$articles_query = Article::orderBy('date', 'desc');
        $articles = Pagination::init($articles_query, 50)->get();

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

    public function postDeleteImage($id) {
        $news = Article::find($id);
        if(!$news) return ['success' => false, 'msg' => 'Статья не найдена'];

        $news->deleteImage();
        $news->update(['image' => null]);

        return ['success' => true];
    }

    public function postArticleImageUpload($news_id): array
    {
        $images = Request::file('images');
        $items = [];
        if ($images) {
            foreach ($images as $image) {
                $file_name = ArticleImage::uploadImage($image);
                $order = ArticleImage::where('article_id', $news_id)->max('order') + 1;
                $item = ArticleImage::create(['article_id' => $news_id, 'image' => $file_name, 'order' => $order]);
                $items[] = $item;
            }
        }

        $html = '';
        foreach ($items as $item) {
            $html .= view('admin::articles.article_image', ['image' => $item]);
        }

        return ['html' => $html];
    }

    public function postArticleImageOrder(): array
    {
        $sorted = Request::get('sorted', []);
        foreach ($sorted as $order => $id) {
            ArticleImage::whereId($id)->update(['order' => $order]);
        }

        return ['success' => true];
    }

    public function postNewsImageDelete($id): array
    {
        $item = ArticleImage::findOrFail($id);
        $item->deleteImage();
        $item->delete();

        return ['success' => true];
    }

    public function postImageEdit($id)
    {
        $image = ArticleImage::findOrFail($id);
        return view('admin::articles.article_image_edit', ['image' => $image]);
    }

    public function postImageDataSave($id): array
    {
        $image = ArticleImage::findOrFail($id);
        $text = Request::get('image_text');
        $image->text = $text;
        $image->save();
        return ['success' => true];
    }
}
