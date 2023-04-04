<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class CartController extends SiteController
{

    public function __construct() {
        parent::__construct();
        $this->template = 'main.cart.template';



    }


    public function cart() {

        $this->title = 'Корзина';
        $this->slug = 'Свежее и органическое';
        $this->desc = 'О нас';
        $this->keywords = 'О нас';

        $products = $this->cart->products;
        $finalPrice = null;
        if($products) {
            foreach($products as $product) {
                $finalPrice += ($product->price * $product->pivot->quantity);
            }
        }

        if($this->cart->getCountItems() === 0) {
            $this->content = view('errors.emptycart')->render();
        }else {
            $this->content = view('main.cart.cart', compact('products', 'finalPrice'))->render();
        }



        return $this->renderOutput();

    }



    public function checkout() {

        $this->title = 'Оформление заказа';
        $this->slug = 'Свежее и органическое';
        $this->desc = 'Свежее и органическое';
        $this->keywords = 'Свежее и органическое';

        $orderDetail = $this->cart->getOrderDetail();

        $total = $this->cart->getTotalPrice();

        $this->content = view('main.cart.checkout', compact('orderDetail', 'total'))->render();

        return $this->renderOutput();
    }

    public function storeOrder(Request $request) {
        $data = $request->except('_token');

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'comment' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if($this->cart) {
            $this->cart->saveOrder($data);
        }

        return response()->json(['success' => 'Ваш заказ успешно размещен.В ближайшее время с вами свяжется менеджер'])->cookie(Cookie::forget('cart_id'));
    }



    public function add(Request $request, $id) {

        $quantity = $request->input('quantity') ?? 1;

        $this->cart->increase($id, $quantity);

        return response()->json(["success" => true, 'count' => $this->cart->getCountitems()])->cookie(cookie('cart_id', $this->cart->id, 525600));

    }

    public function changeCount(Request $request, $id) {

        $quantity = $request->input('quantity') ?? 1;

        $quantity = $this->cart->change($id, $quantity);

        $totalPrice = $this->cart->products()->find($id)->price * $quantity;

        return response()->json(['success'=> true, 'total' => $totalPrice, 'count' => $this->cart->getCountitems()])->cookie(cookie('cart_id', $this->cart->id, 525600));
    }



    public function remove(Request $request, $id) {

        $last = $this->cart->products->count() === 1;

        $this->cart->products()->detach($id);

        return response()->json(['success'=> true, 'product_id' => $id, 'count' => $this->cart->getCountitems(), 'last' => $last])->cookie(cookie('cart_id', $this->cart->id, 525600));
    }

    public function updateCart() {

        $products = $this->cart->products;
        $finalPrice = null;

        if ($products->isEmpty()) {
            return response()->json(['success' => false]);
        }
        foreach($products as $product) {
            $finalPrice += ($product->price * $product->pivot->quantity);
        }

        return response()->json(['success' => true, 'finalPrice' => $finalPrice]);




    }

}



//
//
//
//
//
//
//
//
//
//
//
//
///*<?php
//
//namespace App\Http\Controllers\Main;
//
//
//use App\Models\Cart;
//use Illuminate\Database\Eloquent\ModelNotFoundException;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Cookie;
//
//class CartController extends SiteController
//{
//
//    private $cart;
//
//    public function __construct() {
//        $this->template = 'main.cart.template';
//        $this->cart = getCart();
//    }
//    private function getCart() {
//        $cart_id = request()->cookie('cart_id');
//        if (!empty($cart_id)) {
//            try {
//                $this->cart = Cart::findOrFail($cart_id);
//            } catch (ModelNotFoundException $e) {
//                $this->cart = Cart::create();
//            }
//        } else {
//            $this->cart = Cart::create();
//        }
//        Cookie::queue('cart_id', $this->cart->id, 525600);
//    }
//
//
//    public function cart(Request $request) {
//
//
//        $cart_id = $request->cookie('cart_id');
//        if (!empty($cart_id)) {
//            $products = Cart::findOrFail($cart_id)->products;
//            $this->content = view('main.cart.cart', compact('products'));
//            return $this->renderOutput();
//        } else {
//            abort(404);
//        }
//
//
//        /*$this->content = view('main.cart.cart')->render();
//
//        return $this->renderOutput();
//    }
//
//    public function checkout() {
//
//        $this->content = view('main.cart.checkout')->render();
//
//        return $this->renderOutput();
//    }
//
//    public function add(Request $request, $id) {
//
//        $quantity = $request->input('quantity') ?? 1;
//        $this->cart->increase($id, $quantity);
//        // выполняем редирект обратно на ту страницу,
//        // где была нажата кнопка «В корзину»
//        return back();
//    }
//
//    public function plus(Request $request, $id) {
//        $this->cart->increase($id);
//        // выполняем редирект обратно на страницу корзины
//        return redirect()->route('main.cart');
//    }
//
//
//    public function minus($id) {
//        $this->cart->decrease($id);
//        // выполняем редирект обратно на страницу корзины
//        return redirect()->route('main.cart');
//    }
//
//
//    private function change($cart_id, $product_id, $count = 0) {
//        if ($count == 0) {
//            return;
//        }
//        $cart = Cart::findOrFail($cart_id);
//        // если товар есть в корзине — изменяем кол-во
//        if ($cart->products->contains($product_id)) {
//            $pivotRow = $cart->products()->where('product_id', $product_id)->first()->pivot;
//            $quantity = $pivotRow->quantity + $count;
//            if ($quantity > 0) {
//                // обновляем кол-во товара $product_id в корзине
//                $pivotRow->update(['quantity' => $quantity]);
//                // обновляем поле `updated_at` таблицы `carts`
//                $cart->touch();
//            } else {
//                // кол-во равно нулю — удаляем товар из корзины
//                $pivotRow->delete();
//            }
//        }
//    }
//
//    public function remove($id) {
//
//        $this->cart->remove($id);
//        // выполняем редирект обратно на страницу корзины
//        return redirect()->route('main.cart');
//    }
//
//}*/
