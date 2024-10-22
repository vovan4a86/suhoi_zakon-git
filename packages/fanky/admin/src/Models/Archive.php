<?php namespace Fanky\Admin\Models;

use App\Classes\SiteHelper;
use App\Traits\HasH1;
use App\Traits\HasImage;
use App\Traits\HasSeo;
use App\Traits\OgGenerate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use S;
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
class Archive extends Model {

    use HasImage, HasH1, OgGenerate, HasSeo;

    protected $guarded = ['id'];

    public $timestamps = false;

	const UPLOAD_URL = '/uploads/archive/';

	public function scopePublic($query) {
		return $query->where('published', 1);
	}

    public function scopeOnMain($query) {
        return $query->where('on_main', 1);
    }

    public function magazines(): HasMany
    {
        return $this->hasMany(Magazine::class)
            ->orderByRaw("CAST(number_year as UNSIGNED) ASC")
            ->orderBy('number_year');
    }

    public function public_magazines(): HasMany
    {
        return $this->magazines()
            ->where('published', 1);
    }

	public function getUrlAttribute(): string
    {
		return route('archive.item', ['year' => $this->year]);
	}

	public function dateFormat($format = 'd.m.Y') {
		if (!$this->date) return null;
		$date =  date($format, strtotime($this->date));
		$date = str_replace(array_keys(SiteHelper::$monthRu2),
			SiteHelper::$monthRu2, $date);

		return $date;
	}

	public static function last($count = 3) {
		$items = self::orderBy('date', 'desc')->public()->limit($count)->get();

		return $items;
	}

    public function getAnnounce() {
        $text = $this->announce ?: $this->text;

        return Str::limit($text, S::get('articles_announce_length', 123));
    }
}
