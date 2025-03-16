<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        $shipping = count($cart) > 0 ? 200 : 0; // UGX 200 shipping fee if cart has items

        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('guest.cart', compact('cart', 'total', 'shipping'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->quantity,
            'action' => 'required|in:cart,buy'
        ]);

        $cart = session()->get('cart', []);
        
        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'unit' => $product->unit,
                'image' => $product->image ?? 'default-product.jpg'
            ];
        }
        
        session()->put('cart', $cart);

        if($request->action === 'buy') {
            return redirect()->route('guest.checkout');
        }
        
        return redirect()->route('guest.cart')->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);
        
        if(isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:products,id'
            ]);

            $cart = session()->get('cart', []);
            $id = $request->id;
            
            if(!isset($cart[$id])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item not found in cart'
                ], 404);
            }
            
            unset($cart[$id]);
            session()->put('cart', $cart);
            
            return response()->json([
                'success' => true,
                'message' => 'Item removed successfully'
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid product ID',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove item from cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if(empty($cart)) {
            return redirect()->route('guest.cart')
                           ->with('error', 'Your cart is empty');
        }

        $total = 0;
        $shipping = count($cart) > 0 ? 200 : 0;

        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('guest.checkout', compact('cart', 'total', 'shipping'));
    }
}