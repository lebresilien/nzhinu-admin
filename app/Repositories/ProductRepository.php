<?php

namespace App\Repositories;

use App\Models\{Category, Product};
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App;

class ProductRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Product::class;
    }

    public function listProducts($lang)  {

        $data = collect([]);

        App::setLocale($lang);

        foreach (Category::all() as $category) {
            $data->push([
                'name' => $category->name,
                'slug' => $category->slug,
                'products' => $category->products->map(function ($product) {
                    return [
                        "title" => $product->title,
                        "slug" => $product->slug,
                        "price" => $product->price,
                        "handle" => $product->handle,
                        "created_at" => $product->created_at,
                        "thumbnail" => $product->attachment
                    ];
                })
            ]);
        }
    }

}