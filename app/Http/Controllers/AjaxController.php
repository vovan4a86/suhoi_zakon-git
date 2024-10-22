<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use Fanky\Admin\Models\Catalog;
use Fanky\Admin\Models\Feedback;
use Fanky\Admin\Models\Order as Order;
use Fanky\Admin\Models\Page;
use Fanky\Admin\Models\Product;
use Illuminate\Http\Request;
use Mail;

use Cart;
use Settings;
use SiteHelper;
use Validator;

class AjaxController extends Controller
{
    private $fromMail = 'info@sdvstroy.com';
    private $fromName = 'СДВ-СТРОЙ';

    //РАБОТА С КОРЗИНОЙ
    public function postAddToCart(Request $request): array
    {
        $id = $request->get('id');

        $product = Product::find($id);
        if ($product) {
            $product_item['id'] = $product->id;
            $product_item['name'] = $product->name;
            $product_item['price'] = $product->price;
            $product_item['measure'] = $product->measure;
            $product_item['count'] = 1;
            $product_item['url'] = $product->url;
            $product_item['image'] = $product->image ? $product->image_src : $product->catalog->image_src;

            Cart::add($product_item);
        }

        $cart = Cart::all();
        $item = $cart[$id];

        $basket_btn = view('blocks.basket_btn')->render();
        $cart_item = view('cart.cart_item', ['item' => $item])->render();
        $total = view('cart.total_sum')->render();


        return [
            'success' => true,
            'basket_btn' => $basket_btn,
            'cart_item' => $cart_item,
            'total' => $total
        ];
    }

    public function postEditCartProduct(Request $request): array
    {
        $id = $request->get('id');
        $count = $request->get('count', 1);
        /** @var Product $product */
        $product = Product::find($id);
        if ($product) {
            $product_item['image'] = $product->showAnyImage();
            $product_item = $product->toArray();
            $product_item['count_per_tonn'] = $count;
            $product_item['url'] = $product->url;

            Cart::add($product_item);
        }

        $popup = view('blocks.cart_popup', $product_item)->render();

        return ['cart_popup' => $popup];
    }

    public function postUpdateToCart(Request $request): array
    {
        $id = $request->get('id');
        $count = $request->get('count');

        Cart::updateCount($id, $count);

        $cart = Cart::all();
        $item = $cart[$id];
        $total = view('cart.total_sum')->render();
        $basket_item_data = view('cart.basket_item_data', ['item' => $item])->render();

        return [
            'success' => true,
            'total' => $total,
            'basket_item_data' => $basket_item_data,
            'id' => $id
        ];
    }

    public function postRemoveFromCart(Request $request): array
    {
        $id = $request->get('id');
        Cart::remove($id);
        $basket_btn = view('blocks.basket_btn')->render();
        $total = view('cart.total_sum')->render();

        return [
            'success' => true,
            'basket_btn' => $basket_btn,
            'total' => $total,
            'id' => $id
        ];
    }

    public function postPurgeCart(): array
    {
        Cart::purge();
        $total = view('cart.table_row_total')->render();
        $header_cart = view('blocks.header_cart')->render();
        return [
            'success' => true,
            'total' => $total,
            'header_cart' => $header_cart
        ];
    }

    //связаться с нами
    public function postContactUs(): array
    {
        $data = request()->only(['first_name', 'last_name', 'email', 'message']);
        $valid = Validator::make(
            $data,
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
            ],
            [
                'first_name.required' => 'Не заполнено поле имя',
                'last_name.required' => 'Не заполнено поле фамилия',
                'email.required' => 'Не заполнено поле email',
            ]
        );

        if ($valid->fails()) {
            return ['errors' => $valid->messages()];
        } else {
            $feedback_data = [
                'type' => 1,
                'data' => $data
            ];
            $feedback = Feedback::create($feedback_data);
            Mail::send(
                'mail.feedback',
                ['feedback' => $feedback],
                function ($message) use ($feedback) {
                    $title = $feedback->id . ' | Связаться с нами | Сухой Закон';
                    $message->from($this->fromMail, $this->fromName)
                        ->to(Settings::get('feedback_email'))
                        ->subject($title);
                }
            );

            return ['success' => true];
        }
    }

    public function search(Request $request)
    {
        $data = $request->only(['search']);

        $items = null;

        $page = Page::getByPath(['search']);
        $bread = $page->getBread();

        return [
            'success' => true,
            'redirect' => url(
                '/search',
                [
                    'bread' => $bread,
                    'items' => $items,
                    'data' => $data,
                ]
            )
        ];

//        return view('search.index', [
//            'bread' => $bread,
//            'items' => $items,
//            'data' => $data,
//        ]);

    }
}
