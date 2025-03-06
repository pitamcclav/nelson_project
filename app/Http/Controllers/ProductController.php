<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
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
        // \Log::info($request->all());
        //check type of the image
        // \Log::info($request->image->extension());
        // die();

        try{
            $validated = $request->validate([
                'name' => 'required|max:255',
                'category' => 'required|max:255',
                'description' => 'required',
                'unit' => 'required|max:50',
                'quantity' => 'required|numeric|min:0',
                'price' => 'required|numeric|min:0',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);



            if ($request->hasFile('image')) {
                $image = $request->file('image'); // Correct Way
                $imageName = time().'.'.$image->extension();
                $image->move(public_path('images'), $imageName);
                $validated['image'] = $imageName; 
            }
            


            $validated['user_id'] = Auth::user()->id;

            // \Log::info($validated);
            // die();
            Product::create($validated);

            return redirect()->route('products.index')
                ->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')
            ->with('error', 'Product creation failed.');
        }
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
    public function edit(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category' => 'required|max:255',
            'description' => 'required',
            'unit' => 'required|max:50',
            'quantity' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
