<?php

namespace App\Http\Controllers;

use App\Models\Furnitures;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function getCleanCart()
    {
        $cart = Session::get('cart', []);
        return array_filter($cart, function ($item) {
            return isset($item['id'], $item['quantity']);
        });
    }

    public function index()
{
    $cart = $this->getCleanCart();
    $cartItems = [];
    $total = 0;

    foreach ($cart as $item) {
        $furniture = Furnitures::find($item['id']);
        if ($furniture) {
            $cartItems[] = [
                'furniture' => $furniture,
                'name' => $furniture->name, // ✅ Tambahkan ini
                'quantity' => $item['quantity'],
                'total' => $furniture->price * $item['quantity'],
            ];
            $total += $furniture->price * $item['quantity'];
        }
    }

    Session::put('cart', array_values($cart));

    return view('cart', [
        'cartItems' => $cartItems,
        'subtotal' => $total,
    ]);
}


    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:furnitures,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $furniture = Furnitures::findOrFail($request->product_id);
        $cart = Session::get('cart', []);
        $found = false;

        foreach ($cart as &$item) {
            if ($item['id'] == $furniture->id) {
                $item['quantity'] += $request->quantity;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'id' => $furniture->id,
                'quantity' => $request->quantity,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');
    }

    public function add(Request $request, Furnitures $furniture)
    {
        $cart = Session::get('cart', []);
        $found = false;

        foreach ($cart as &$item) {
            if ($item['id'] == $furniture->id) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'id' => $furniture->id,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Item added to cart!');
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $quantity = $request->input('quantity');
    $cart = Session::get('cart', []);

    foreach ($cart as &$item) {
        if ($item['id'] == $id) {
            $item['quantity'] = $quantity;
            break;
        }
    }

    Session::put('cart', $cart);

    return redirect()->route('cart.index')->with('success', 'Cart updated!');
}


    public function remove($id)
    {
        $cart = Session::get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['id'] == $id) {
                unset($cart[$key]);
                break;
            }
        }

        Session::put('cart', array_values($cart));

        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }

    public function checkout(Request $request)
    {
        $cart = $this->getCleanCart();

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $request->validate([
            'c_country' => 'required|string',
            'c_fname' => 'required|string',
            'c_lname' => 'required|string',
            'c_address' => 'required|string',
            'c_city' => 'required|string',
            'c_state' => 'required|string',
            'c_zip' => 'required|string',
            'c_email' => 'required|email',
            'c_phone' => 'required|string',
        ]);

        $totalAmount = 0;
        $orderItems = [];

        foreach ($cart as $item) {
            $furniture = Furnitures::find($item['id']);
            if ($furniture) {
                $totalAmount += $furniture->price * $item['quantity'];
                $orderItems[] = [
                    'furniture_id' => $furniture->id,
                    'quantity' => $item['quantity'],
                    'price' => $furniture->price,
                ];
            }
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'billing_details' => json_encode([
                'country' => $request->c_country,
                'first_name' => $request->c_fname,
                'last_name' => $request->c_lname,
                'address' => $request->c_address,
                'city' => $request->c_city,
                'state' => $request->c_state,
                'zip' => $request->c_zip,
                'email' => $request->c_email,
                'phone' => $request->c_phone,
            ]),
        ]);

        foreach ($orderItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'furniture_id' => $item['furniture_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        Session::forget('cart');

        return redirect()->route('thankyou')->with('success', 'Order placed successfully!');
    }

    public function checkoutForm()
{
    $cart = $this->getCleanCart();

    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
    }

    $cartItems = [];
    $subtotal = 0;

    foreach ($cart as $item) {
        $furniture = Furnitures::find($item['id']);
        if ($furniture) {
            $total = $furniture->price * $item['quantity'];
            $cartItems[] = [
                'name' => $furniture->name,
                'quantity' => $item['quantity'],
                'total' => $total,
            ];
            $subtotal += $total;
        }
    }

    return view('checkout', compact('cartItems', 'subtotal'));
}

}
