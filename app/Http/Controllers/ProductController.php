<?php

namespace App\Http\Controllers;

use App\Services\JdsProductService;
use App\Services\RateConvertionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    private $rateConvertionService;
    private $jdsProductService;

    public function __construct()
    {
        $this->rateConvertionService = new RateConvertionService;
        $this->jdsProductService = new JdsProductService;
    }

    public function indexAdmin()
    {
        if(auth()->user()->role !== 'admin') {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to access this page'
            ], 403);
        }
        $products = $this->jdsProductService->getProductAdmin();
        if(config('services.rate_convertion.status')){
            $rate     = $this->rateConvertionService->convert('IDR', 'USD', 1);
            foreach ($products as $key => $product) {
                $products[$key]['price_idr'] = $product['price'] * $rate->result;
            }
        }

        return response()->json([
            'status' => 'success',
            'data'   => $products
        ], 200);
    }

    public function index()
    {
        $products = $this->jdsProductService->getProduct();
        if (config('services.rate_convertion.status')) {
            $rate     = $this->rateConvertionService->convert('IDR', 'USD', 1);
            foreach ($products as $key => $product) {
                $products[$key]['price_idr'] = $product['price'] * $rate->result;
            }
        }

        return response()->json([
            'status' => 'success',
            'data'   => $products
        ], 200);
    }

    public function myProduct()
    {
        $userProduct = auth()->user()->product;
        $products    = $this->jdsProductService->getProduct($userProduct);
        if (config('services.rate_convertion.status')) {
            $rate        = $this->rateConvertionService->convert('IDR', 'USD', 1);
            foreach ($products as $key => $product) {
                $products[$key]['price_idr'] = $product['price'] * $rate->result;
            }
        }

        return response()->json([
            'status' => 'success',
            'data'   => $products
        ], 200);
    }
}
