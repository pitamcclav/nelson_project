<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
// Get featured products for the welcome page
        $featuredProducts = Product::where('quantity', '>', 0)
                                 ->orderBy('created_at', 'desc')
                                 ->take(8)
                                 ->get();
        
        return view('welcome', compact('featuredProducts'));
    }

    public function marketplace(Request $request)
    {
        $query = Product::query();

        // Apply category filter
        if ($request->has('category')) {
            $query->whereIn('category', $request->category);
        }

        // Apply price range filter
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Apply sorting
        switch ($request->get('sort', 'latest')) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'popularity':
                $query->withCount('reviews')
                      ->orderBy('reviews_count', 'desc');
                break;
            default:
                $query->latest();
        }

        $products = $query->paginate(12);
        return view('guest.marketplace', compact('products'));
    }

    public function productDetail(Product $product)
    {
        $product->load(['reviews.user', 'seller']);
        $relatedProducts = Product::where('category', $product->category)
                                ->where('id', '!=', $product->id)
                                ->take(4)
                                ->get();
        
        return view('guest.product-detail', compact('product', 'relatedProducts'));
    }

    public function farmers()
    {
        $farmers = User::where('role', 'seller')
                      ->withCount('products')
                      ->withAvg('reviews', 'rating')
                      ->paginate(12);
        
        return view('guest.farmers', compact('farmers'));
    }

    public function buyers()
    {
        return view('guest.buyers');
    }

    public function contact()
    {
        return view('guest.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Here you would typically send an email or store the contact message
        // For now, we'll just return a success response
        return back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }

    public function privacy()
    {
        return view('guest.privacy');
    }

    public function terms()
    {
        return view('guest.terms');
    }

    public function subscribeNewsletter(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'privacy_accepted' => 'required|accepted'
        ]);

        try {
            Newsletter::updateOrCreate(
                ['email' => $validated['email']],
                ['privacy_accepted' => true]
            );

            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing to our newsletter!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function search(Request $request)
    {
        $query = Product::query();

        // Search by name, description, or category
        if ($request->has('query')) {
            $searchTerm = $request->input('query');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('category', 'like', "%{$searchTerm}%");
            });
        }

        // Apply category filter
        if ($request->has('category')) {
            $query->whereIn('category', $request->category);
        }

        // Apply price range filter
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Only show products with stock
        $query->where('quantity', '>', 0);

        // Apply sorting
        switch ($request->get('sort', 'latest')) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'popularity':
                $query->withCount('reviews')
                      ->orderBy('reviews_count', 'desc');
                break;
            default:
                $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        
        return view('guest.marketplace', compact('products'));
    }
}
