<?php namespace Fanky\Admin\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleImage extends Model {

	use HasImage;
	protected $table = 'articles_images';

	protected $fillable = ['article_id', 'image', 'order'];

	public $timestamps = false;

	const UPLOAD_URL = '/uploads/articles/gallery/';

	public static $thumbs = [
		1 => '100x100', //admin
		2 => '300x200', //small image
	];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
