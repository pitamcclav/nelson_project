<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        $buyers = User::where('role', 'buyer')->get();
        $products = Product::all();
        return view('orders.index', compact('orders', 'buyers', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       $validated = $request->validate([
            'buyer_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
        ]);
        $product = Product::find($validated['product_id']);
        $total_price = $product->price * $validated['quantity'];
        $validated['total_price'] = $total_price;


        Order::create($validated);
        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'payment_method' => 'required|in:mpesa,card,cash',
            'mpesa_code' => 'required_if:payment_method,mpesa',
            'card_number' => 'required_if:payment_method,card',
            'card_expiry' => 'required_if:payment_method,card',
            'card_cvv' => 'required_if:payment_method,card',
        ]);

        $cart = session()->get('cart', []);

        if(empty($cart)) {
            return redirect()->route('guest.cart')
                           ->with('error', 'Your cart is empty');
        }

        try {
            DB::beginTransaction();

            // Calculate totals
            $subtotal = collect($cart)->sum(function($item) {
                return $item['price'] * $item['quantity'];
            });
            $shipping = 200;
            $total = $subtotal + $shipping;

            // Create order
            $order = Order::create([
                'buyer_id' => auth()->id(), // null for guests
                'guest_name' => $request->name,
                'guest_email' => $request->email,
                'guest_phone' => $request->phone,
                'delivery_address' => $request->address,
                'delivery_city' => $request->city,
                'shipping_fee' => $shipping,
                'subtotal' => $subtotal,
                'total' => $total,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'transaction_code' => $request->mpesa_code,
                'status' => 'pending'
            ]);

            // Create order items and update product quantities
            foreach($cart as $id => $item) {
                $product = Product::findOrFail($id);

                if($product->quantity < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$product->name}");
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'product_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity']
                ]);

                // Update product quantity
                $product->decrement('quantity', $item['quantity']);
            }

            DB::commit();

            // Clear the cart
            session()->forget('cart');

            return redirect()->route('guest.order.success', $order->id)
                           ->with('success', 'Order placed successfully!');

        } catch(\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function success($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);
        return view('guest.order-success', compact('order'));
    }
}
