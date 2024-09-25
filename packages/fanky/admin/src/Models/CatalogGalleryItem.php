<?php namespace Fanky\Admin\Models;

use App\Traits\HasImage;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Fanky\Admin\Models\ProductImage
 *
 * @property int        $id
 * @property int        $product_id
 * @property string     $image
 * @property int        $order
 * @property-read mixed $src
 * @method static \Illuminate\Database\Eloquent\Builder|\Fanky\Admin\Models\ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Fanky\Admin\Models\ProductImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Fanky\Admin\Models\ProductImage whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Fanky\Admin\Models\ProductImage whereProductId($value)
 * @mixin Eloquent
 * @property-read mixed $image_src
 * @method static \Illuminate\Database\Eloquent\Builder|\Fanky\Admin\Models\ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Fanky\Admin\Models\ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Fanky\Admin\Models\ProductImage query()
 */
class CatalogGalleryItem extends Model {

	use HasImage;
	protected $table = 'catalog_gallery_items';

	protected $fillable = ['catalog_id', 'image', 'text', 'order'];

	public $timestamps = false;

	const UPLOAD_URL = '/uploads/catalog/gallery/';

	public static $thumbs = [
		1 => '100x100', //admin product
		2 => '335x223',
		3 => '335x335',
		4 => '335x478',
	];

    public function catalog(): BelongsTo
    {
        return $this->belongsTo(Catalog::class);
    }
}
