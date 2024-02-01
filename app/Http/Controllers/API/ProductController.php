<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App;

class ProductController extends Controller
{
    /** @var ProductRepository */
    private $productRepository;
    private $categoryRepository;
 
    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function listProducts($lang) {
        $data = $this->productRepository->listProducts($lang);
        return response()->json($data);
    }

    public function categories($lang, $slug) {

        App::setLocale($lang);
        
        $category = $this->categoryRepository->all(["slug" => $slug])->first();

        return response()->json([
            "name" => $category->name,
            "products" => $category->products->map(function ($product) {
                return [
                    "id" => $product->id,
                    "title" => $product->title,
                    "slug" => $product->slug,
                    "price" => $product->price,
                    "handle" => $product->handle,
                    "created_at" => $product->created_at,
                    "thumbnail" => env('APP_URL').'/storage/'.$product->attachment
                ];
            })
        ]);
    }

    public function product($lang, $slug) {

        App::setLocale($lang);
        
        $product = $this->productRepository->all(["slug" => $slug])->first();

        return response()->json([
            "id" => $product->id,
            "title" => $product->title,
            "slug" => $product->slug,
            "price" => $product->price,
            "handle" => $product->handle,
            "created_at" => $product->created_at,
            "thumbnail" => env('APP_URL').'/storage/'.$product->attachment
        ]);
    }
}
