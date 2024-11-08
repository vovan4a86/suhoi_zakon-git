<?php

namespace Fanky\Admin\Models;

use App\Traits\HasFile;
use App\Traits\HasH1;
use App\Traits\HasImage;
use App\Traits\HasSeo;
use App\Traits\HasSeoOptimization;
use App\Traits\OgGenerate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;

/**
 * Fanky\Admin\Models\Product
 *
 * @property int $id
 * @property int $catalog_id
 * @property string $name
 * @property string $alias
 * @property string|null $text
 * @property int $price
 * @property int $raw_price
 * @property string $image
 * @property int $published
 * @property boolean $on_main
 * @property int $is_hit
 * @property int $is_new
 * @property int $in_stock
 * @property int $article
 * @property string|null $is_discount
 * @property int $order
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $size
 * @property string|null $h1
 * @property string|null $price_name
 * @property string|null $og_title
 * @property string|null $og_description
 * @property-read Catalog $catalog
 * @property-read mixed $image_src
 * @property-read mixed $url
 * @property-read Collection|ProductImage[] $images
 * @property mixed length
 * @property mixed width
 * @property mixed height
 * @method static bool|null forceDelete()
 * @method static Builder|Product onMain()
 * @method static Builder|Product public ()
 * @method static bool|null restore()
 * @method static Builder|Product whereAlias($value)
 * @method static Builder|Product whereArticle($value)
 * @method static Builder|Product whereCatalogId($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDeletedAt($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereImage($value)
 * @method static Builder|Product whereKeywords($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product whereOnMain($value)
 * @method static Builder|Product whereOrder($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product wherePriceUnit($value)
 * @method static Builder|Product wherePublished($value)
 * @method static Builder|Product whereText($value)
 * @method static Builder|Product whereTitle($value)
 * @method static Builder|Product whereUnit($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereBalance($value)
 * @method static Builder|Product whereCharacteristic($value)
 * @method static Builder|Product whereCharacteristic2($value)
 * @method static Builder|Product whereComment($value)
 * @method static Builder|Product whereCutting($value)
 * @method static Builder|Product whereGost($value)
 * @method static Builder|Product whereH1($value)
 * @method static Builder|Product whereLength($value)
 * @method static Builder|Product whereOgDescription($value)
 * @method static Builder|Product whereOgTitle($value)
 * @method static Builder|Product wherePriceName($value)
 * @method static Builder|Product whereSize($value)
 * @method static Builder|Product whereSteel($value)
 * @method static Builder|Product whereWall($value)
 * @method static Builder|Product whereWarehouse($value)
 * @method static Builder|Product whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Product withoutTrashed()
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasSeo, HasH1, HasImage, OgGenerate, HasSeoOptimization;

    protected $_parents = [];

    protected $guarded = ['id'];

    const UPLOAD_PATH = '/public/uploads/products/';
    const UPLOAD_URL = '/uploads/products/';

    const NO_IMAGE = "/adminlte/no_foto.jpg";

    public static $thumbs = [
        1 => '120x120|fit', //admin
        2 => '240x240|fit', //list
    ];

    public static function findRootParentCatalog($catalog_id)
    {
        $root = Catalog::find($catalog_id)->getParents(false, true);

        if (isset($root[0])) {
            return Catalog::find($root[0]['id']);
        } else {
            return Catalog::find($catalog_id);
        }
    }

    public function catalog(): BelongsTo
    {
        return $this->belongsTo(Catalog::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id')
            ->orderBy('order');
    }

    public function single_image(): HasOne
    {
        return $this->hasOne(ProductImage::class, 'product_id')
            ->orderBy('order');
    }

    public function getBread()
    {
        $bread = $this->catalog->getBread();
        $bread[] = [
            'url' => $this->url,
            'name' => $this->name
        ];

        return $bread;
    }

    public function getImage(): string
    {
        if ($this->image) {
            return $this->image_src;
        }
        $catalog = Catalog::find($this->catalog_id);
        return Catalog::UPLOAD_URL . $catalog->image;
    }

    public function getRootImage(): string
    {
        $category = Catalog::find($this->catalog_id);
        $root = $category;
        while ($root->parent_id !== 0) {
            $root = $root->findRootCategory($root->parent_id);
        }
        if ($root->image) {
            return Catalog::UPLOAD_URL . $root->image;
        } else {
            return self::NO_IMAGE;
        }
    }

    public function scopePublic($query)
    {
        return $query->where('published', 1);
    }

    public function scopeIsAction($query)
    {
        return $query->where('is_action', 1);
    }

    public function scopeInStock($query)
    {
        return $query->where('in_stock', 1);
    }

    public function scopeOnMain($query)
    {
        return $query->where('on_main', 1);
    }

    public function getImageSrcAttribute(): string
    {
        return self::UPLOAD_URL . $this->image;
    }

    public function getUrlAttribute(): string
    {
        if (!$this->_url) {
            $this->_url = $this->catalog->url . '/' . $this->alias;
        }
        return $this->_url;
    }

    public function getParents($with_self = false, $reverse = false): array
    {
        $parents = [];
        if ($with_self) {
            $parents[] = $this;
        }
        $parents = array_merge($parents, $this->catalog->getParents(true));
        $parents = array_merge($parents, $this->_parents);
        if ($reverse) {
            $parents = array_reverse($parents);
        }

        return $parents;
    }

    private $_url;

    public function delete()
    {
        foreach ($this->images as $image) {
            $image->delete();
        }

        parent::delete();
    }

    /**
     * @return Carbon
     */
    public function getLastModify(): ?Carbon
    {
        return $this->updated_at;
    }

    public function showAnyImage(): string
    {
        $cat_image = Catalog::whereId($this->catalog_id)->first();
        $root_image = $this->getRootImage() ?: self::NO_IMAGE;
        return $cat_image->image ? Catalog::UPLOAD_URL . $cat_image->image :
            $root_image;
    }
}
