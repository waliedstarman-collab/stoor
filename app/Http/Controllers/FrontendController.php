<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * استخراج رابط الصورة الأولى للمنتج
     */
    private function getFirstImageUrl($product)
    {
        $images = [];
        if ($product->image) {
            if (is_string($product->image)) {
                $decoded = json_decode($product->image, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $images = $decoded;
                } else {
                    $images = [$product->image];
                }
            } elseif (is_array($product->image)) {
                $images = $product->image;
            }
        }
        
        $firstImage = $images[0] ?? null;
        return $firstImage ? asset('storage/' . $firstImage) : null;
    }

    public function index()
    {
        $categories = Category::withCount('products')->get();
        $products = Product::where('is_available', true)
                          ->latest()
                          ->take(12)
                          ->get();
        
        // تجهيز الصورة الأولى لكل منتج
        foreach ($products as $product) {
            $product->first_image_url = $this->getFirstImageUrl($product);
        }
        
        return view('website.index', compact('categories', 'products'));
    }

    public function category($slug)
    {
        $categories = Category::withCount('products')->get();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()
                            ->where('is_available', true)
                            ->latest()
                            ->paginate(12);
        
        // تجهيز الصورة الأولى لكل منتج
        foreach ($products as $product) {
            $product->first_image_url = $this->getFirstImageUrl($product);
        }
        
        return view('website.category', compact('categories', 'category', 'products'));
    }

    public function product($id)
    {
        $categories = Category::withCount('products')->get();
        $product = Product::with('category')->findOrFail($id);
        
        // تحويل الصور إلى مصفوفة
        $images = [];
        if ($product->image) {
            if (is_string($product->image)) {
                $decoded = json_decode($product->image, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $images = $decoded;
                } else {
                    $images = [$product->image];
                }
            } elseif (is_array($product->image)) {
                $images = $product->image;
            }
        }
        
        // تجهيز روابط الصور الكاملة
        $imageUrls = array_map(function ($img) {
            return asset('storage/' . $img);
        }, $images);
        
        $mainImage = $imageUrls[0] ?? null;
        
        return view('website.product', compact('categories', 'product', 'imageUrls', 'mainImage'));
    }
}