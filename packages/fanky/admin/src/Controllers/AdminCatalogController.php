<?php

namespace Fanky\Admin\Controllers;

use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Fanky\Admin\Models\CatalogFeature;
use Fanky\Admin\Models\CatalogGalleryItem;
use Fanky\Admin\Pagination;
use Request;
use Validator;
use Text;
use DB;
use Fanky\Admin\Models\Catalog;
use Fanky\Admin\Models\Product;
use Fanky\Admin\Models\ProductImage;

class AdminCatalogController extends AdminController
{

    public function getIndex()
    {
        $catalogs = Catalog::orderBy('order')->get();

        return view(
            'admin::catalog.main',
            [
                'catalogs' => $catalogs
            ]
        );
    }

    public function postProducts($catalog_id)
    {
        $catalog = Catalog::findOrFail($catalog_id);
        $products = Pagination::init($catalog->products()->orderBy('order'), 20)->get();

        return view(
            'admin::catalog.products',
            [
                'catalog' => $catalog,
                'products' => $products
            ]
        );
    }

    public function getProducts($catalog_id)
    {
        $catalogs = Catalog::orderBy('order')->get();

        return view(
            'admin::catalog.main',
            [
                'catalogs' => $catalogs,
                'content' => $this->postProducts($catalog_id)
            ]
        );
    }

    public function postCatalogEdit($id = null)
    {
        /** @var Catalog $catalog */
        if (!$id || !($catalog = Catalog::findOrFail($id))) {
            $catalog = new Catalog(
                [
                    'parent_id' => Request::get('parent'),
                    'published' => 1
                ]
            );
        }
        $catalogs = Catalog::orderBy('order')
            ->where('id', '!=', $catalog->id)
            ->get();

        $catalogProducts = $catalog->getRecurseProducts()->orderBy('name')->pluck('id', 'name')->all();

        return view(
            'admin::catalog.catalog_edit',
            [
                'catalog' => $catalog,
                'catalogs' => $catalogs,
                'catalogProducts' => $catalogProducts,
            ]
        );
    }

    public function getCatalogEdit($id = null)
    {
        $catalogs = Catalog::orderBy('order')->get();

        return view(
            'admin::catalog.main',
            [
                'catalogs' => $catalogs,
                'content' => $this->postCatalogEdit($id)
            ]
        );
    }

    public function postCatalogSave(): array
    {
        $id = Request::input('id');
        $data = Request::except(['id']);
        if (!array_get($data, 'alias')) {
            $data['alias'] = Text::translit($data['name']);
        }
        if (!array_get($data, 'title')) {
            $data['title'] = $data['name'];
        }
        if (!array_get($data, 'h1')) {
            $data['h1'] = $data['name'];
        }

        $image = Request::file('image');

        // валидация данных
        $validator = Validator::make(
            $data,['name' => 'required']
        );
        if ($validator->fails()) {
            return ['errors' => $validator->messages()];
        }

        $catalog = Catalog::find($id);

        // Загружаем изображение
        if ($image) {
            $file_name = Catalog::uploadImage($image);
            $data['image'] = $file_name;
        }

        $redirect = false;
        // сохраняем страницу

        if (!$catalog) {
            $data['order'] = Catalog::where('parent_id', $data['parent_id'])->max('order') + 1;
            $catalog = Catalog::create($data);
            $redirect = true;
        } else {
            $catalog->update($data);
        }

        if ($redirect) {
            return ['redirect' => route('admin.catalog.catalogEdit', [$catalog->id])];
        } else {
            return ['success' => true, 'msg' => 'Изменения сохранены'];
        }
    }

    public function postCatalogReorder(): array
    {
        // изменение родителя
        $id = Request::input('id');
        $parent = Request::input('parent');
        DB::table('catalogs')->where('id', $id)->update(array('parent_id' => $parent));
        // сортировка
        $sorted = Request::input('sorted', []);
        foreach ($sorted as $order => $id) {
            DB::table('catalogs')->where('id', $id)->update(array('order' => $order));
        }

        return ['success' => true];
    }

    public function postCatalogGalleryUpload($id): array
    {
        $images = Request::file('images');
        $items = [];
        if ($images) {
            foreach ($images as $image) {
                $file_name = CatalogGalleryItem::uploadImage($image);
                $order = CatalogGalleryItem::where('catalog_id', $id)->max('order') + 1;
                $item = CatalogGalleryItem::create(['catalog_id' => $id, 'image' => $file_name, 'order' => $order]);
                $items[] = $item;
            }
        }

        $html = '';
        foreach ($items as $item) {
            $html .= view('admin::catalog.catalog_image', ['image' => $item]);
        }

        return ['html' => $html];
    }

    public function postCatalogGalleryOrder(): array
    {
        $sorted = Request::get('sorted', []);
        foreach ($sorted as $order => $id) {
            CatalogGalleryItem::whereId($id)->update(['order' => $order]);
        }

        return ['success' => true];
    }

    /**
     * @throws Exception
     */
    public function postCatalogGalleryItemDelete($id): array
    {
        $item = CatalogGalleryItem::find($id);
        if(!$item) return ['errors' => 'catalog_not_found'];

        $item->delete();

        return ['success' => true];
    }


    /**
     * @throws Exception
     */
    public function postCatalogDelete($id): array
    {
        $catalog = Catalog::findOrFail($id);
        $catalog->delete();

        return ['success' => true];
    }

    public function postCatalogImageDelete($id): array
    {
        $catalog = Catalog::find($id);
        if(!$catalog) return ['errors' => 'catalog_not_found'];

        $catalog->deleteImage();
        $catalog->update(['image' => null]);

        return ['success' => true];
    }

    public function postProductEdit($id = null)
    {
        /** @var Product $product */
        if (!$id || !($product = Product::findOrFail($id))) {
            $product = new Product();
            $product->catalog_id = Request::get('catalog');
            $product->order = Product::whereCatalogId(Request::get('catalog'))->max('order') + 1;
            $product->published = 1;
        }
        $catalogs = Catalog::getCatalogList();

        $data = [
            'product' => $product,
            'catalogs' => $catalogs,
        ];
        return view('admin::catalog.product_edit', $data);
    }

    public function getProductEdit($id = null)
    {
        $catalogs = Catalog::orderBy('order')->get();

        return view(
            'admin::catalog.main',
            [
                'catalogs' => $catalogs,
                'content' => $this->postProductEdit($id)
            ]
        );
    }

    public function postProductSave(): array
    {
        $id = Request::get('id');
        $data = Request::except(['id']);

        if (!array_get($data, 'published')) {
            $data['published'] = 0;
        }
        if (!array_get($data, 'alias')) {
            $data['alias'] = Text::translit($data['name']);
        }
        if (!array_get($data, 'title')) {
            $data['title'] = $data['name'];
        }
        if (!array_get($data, 'h1')) {
            $data['h1'] = $data['name'];
        }

        $image = Request::file('image');

        $rules = [
            'name' => 'required'
        ];

        $rules['alias'] = $id
            ? 'required|unique:products,alias,' . $id . ',id,catalog_id,' . $data['catalog_id']
            : 'required|unique:products,alias,null,id,catalog_id,' . $data['catalog_id'];
        // валидация данных
        $validator = Validator::make(
            $data,
            $rules
        );
        if ($validator->fails()) {
            return ['errors' => $validator->messages()];
        }

        $redirect = false;

        // Загружаем изображение
        if ($image) {
            $file_name = Product::uploadImage($image);
            $data['image'] = $file_name;
        }

        // сохраняем страницу
        $product = Product::find($id);
        if (!$product) {
            $data['order'] = Product::where('catalog_id', $data['catalog_id'])->max('order') + 1;
            $product = Product::create($data);
            $redirect = true;
        } else {
            $product->update($data);
        }

        return $redirect
            ? ['redirect' => route('admin.catalog.productEdit', [$product->id])]
            : ['success' => true, 'msg' => 'Изменения сохранены'];
    }

    public function postProductReorder(): array
    {
        $sorted = Request::input('sorted', []);
        foreach ($sorted as $order => $id) {
            DB::table('products')->where('id', $id)->update(array('order' => $order));
        }

        return ['success' => true];
    }

    public function postUpdateOrder($id): array
    {
        $order = Request::get('order');
        Product::whereId($id)->update(['order' => $order]);

        return ['success' => true];
    }

    public function postProductDelete($id): array
    {
        $product = Product::findOrFail($id);
        foreach ($product->images as $item) {
            $item->deleteImage();
            $item->delete();
        }
        $product->delete();

        return ['success' => true];
    }

    public function postProductImageUpload($product_id): array
    {
        $product = Product::findOrFail($product_id);
        $images = Request::file('images');
        $items = [];
        if ($images) {
            foreach ($images as $image) {
                $file_name = ProductImage::uploadImage($image);
                $order = ProductImage::where('product_id', $product_id)->max('order') + 1;
                $item = ProductImage::create(['product_id' => $product_id, 'image' => $file_name, 'order' => $order]);
                $items[] = $item;
            }
        }

        $html = '';
        foreach ($items as $item) {
            $html .= view('admin::catalog.product_image', ['image' => $item, 'active' => '']);
        }

        return ['html' => $html];
    }

    public function postProductImageOrder(): array
    {
        $sorted = Request::get('sorted', []);
        foreach ($sorted as $order => $id) {
            ProductImage::whereId($id)->update(['order' => $order]);
        }

        return ['success' => true];
    }

    /**
     * @throws Exception
     */
    public function postProductImageDelete($id): array
    {
        $product = Product::find($id);
        if(!$product) return ['errors' => 'product_not_found'];

        $product->deleteImage();
        $product->update(['image' => null]);

        return ['success' => true];
    }

    public function postCatalogGalleryItemEdit($id) {
        $image = CatalogGalleryItem::findOrFail($id);
        return view('admin::catalog.catalog_image_edit', ['image' => $image]);
    }

    public function postCatalogGalleryItemSave($id): array
    {
        $image = CatalogGalleryItem::findOrFail($id);
        $text = Request::get('image_text');
        $image->update(['text' => $text]);
        $image->save();
        return ['success' => true];
    }

    public function getGetCatalogs($id = 0): array
    {
        $catalogs = Catalog::whereParentId($id)->orderBy('order')->get();
        $result = [];
        foreach ($catalogs as $catalog) {
            $has_children = (bool)$catalog->children()->count();
            $result[] = [
                'id' => $catalog->id,
                'text' => $catalog->name,
                'children' => $has_children,
                'icon' => ($catalog->published) ? 'fa fa-eye text-green' : 'fa fa-eye-slash text-muted',
            ];
        }

        return $result;
    }

    //features
    public function postCatalogFeaturesUpload($id): array
    {
        $images = Request::file('features');
        $items = [];
        if ($images) {
            foreach ($images as $image) {
                $file_name = CatalogFeature::uploadImage($image);
                $order = CatalogFeature::where('catalog_id', $id)->max('order') + 1;
                $item = CatalogFeature::create(['catalog_id' => $id, 'image' => $file_name, 'order' => $order]);
                $items[] = $item;
            }
        }

        $html = '';
        foreach ($items as $item) {
            $html .= view('admin::catalog.catalog_feature', ['image' => $item]);
        }

        return ['html' => $html];
    }

    public function postCatalogFeaturesOrder(): array
    {
        $sorted = Request::get('sorted', []);
        foreach ($sorted as $order => $id) {
            CatalogFeature::whereId($id)->update(['order' => $order]);
        }

        return ['success' => true];
    }

    public function postCatalogFeatureDelete($id): array
    {
        $item = CatalogFeature::find($id);
        if(!$item) return ['errors' => 'catalog_feature_not_found'];

        $item->delete();

        return ['success' => true];
    }

    public function postCatalogFeatureEdit($id) {
        $image = CatalogFeature::findOrFail($id);
        return view('admin::catalog.catalog_feature_edit', ['image' => $image]);
    }

    public function postCatalogFeatureSave($id): array
    {
        $image = CatalogFeature::findOrFail($id);
        $text = Request::get('feat-text');
        $image->update(['text' => $text]);
        $image->save();
        return ['success' => true];
    }
}
