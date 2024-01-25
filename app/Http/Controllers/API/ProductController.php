<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
     /** @var ProductRepository */
     private $productRepository;
 
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function listProducts($lang) {
        return $this->productRepository->listProducts($lang);
    }
}
