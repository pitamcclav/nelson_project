<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

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
}
