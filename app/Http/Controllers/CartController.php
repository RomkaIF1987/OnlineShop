<?php

namespace App\Http\Controllers;

use App\Classes\Order;
use App\Classes\OrderItems;
use App\Models\Cart;
use App\Models\Product;
use Session;
use Illuminate\Http\Request;
use Auth;

class CartController extends Controller
{
    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return back();
    }

    public function getReduceByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        Session::put('cart', $cart);
        return redirect()->route('cartShow');
    }

    public function getUpdateItem($id)
    {
        $quantity = $request->validate([
            'quantity' => 'required'
        ]);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateItem($id, $quantity);

        Session::put('cart', $cart);
        return redirect()->route('cartShow');
    }

    public function getRemoveItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('cartShow');
    }

    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('cart.show', ['products' => []]);
        }
        $user = Auth::user();
        $product = Product::all();
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('cart.show', ['carts' => $cart->items, 'totalPrice' => $cart->totalPrice,
            'user' => $user, 'product' => $product, 'i' => 1, 'itemOrders' => $cart->itemOrders()]);
    }

    public function getCartConfirm($order_id)
    {
        $orders = Order::find($order_id);
        $orderItems = OrderItems::find($order_id);
        $products = Product::find($orderItems->product_id);

        return view('cart.confirm', ['orders' => $orders, 'i' => 1]);
    }
}
