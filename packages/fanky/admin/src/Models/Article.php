<?php namespace Fanky\Admin\Models;

use App\Classes\SiteHelper;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Thumb;

/**
 * Fanky\Admin\Models\Article
 *
 * @property int $id
 * @property int $published
 * @property string $name
 * @property string $h1
 * @property string|null $og_title
 * @property string|null $og_description
 * @property string|null $announce
 * @property string|null $text
 * @property string $image
 * @property string $alias
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $image_src
 * @property-read mixed $url
 * @method static Builder|Article newModelQuery()
 * @method static Builder|Article newQuery()
 * @method static Builder|Article public()
 * @method static Builder|Article query()
 * @method static Builder|Article whereAlias($value)
 * @method static Builder|Article whereAnnounce($value)
 * @method static Builder|Article whereCreatedAt($value)
 * @method static Builder|Article whereDate($value)
 * @method static Builder|Article whereDeletedAt($value)
 * @method static Builder|Article whereDescription($value)
 * @method static Builder|Article whereH1($value)
 * @method static Builder|Article whereId($value)
 * @method static Builder|Article whereImage($value)
 * @method static Builder|Article whereKeywords($value)
 * @method static Builder|Article whereName($value)
 * @method static Builder|Article whereOgDescription($value)
 * @method static Builder|Article whereOgTitle($value)
 * @method static Builder|Article wherePublished($value)
 * @method static Builder|Article whereText($value)
 * @method static Builder|Article whereTitle($value)
 * @method static Builder|Article whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Article extends Model {

	use HasImage;

	protected $guarded = ['id'];

	const UPLOAD_URL = '/uploads/articles/';

	public static $thumbs = [
		1 => '100x100', //admin
	];

	public function scopePublic($query) {
		return $query->where('published', 1);
	}

	public function getUrlAttribute(): string
    {
		return route('articles.item', ['alias' => $this->alias]);
	}

	public function dateFormat($format = 'd.m.Y') {
		if (!$this->date) return null;
		$date =  date($format, strtotime($this->date));
		$date = str_replace(array_keys(SiteHelper::$monthRu),
			SiteHelper::$monthRu, $date);

		return $date;
	}

	public static function last($count = 3) {
		$items = self::orderBy('date', 'desc')->public()->limit($count)->get();

		return $items;
	}
}
