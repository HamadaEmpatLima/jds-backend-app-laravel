<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class JdsProductService
{

    public function getProduct($product = null)
    {
        $url = "https://60c18de74f7e880017dbfd51.mockapi.io/api/v1/jabar-digital-services/product";
        $prefixParam = "?";
        if ($product !== null) {
            $url .= $prefixParam . "product=" . $product;
            $prefixParam = "&";
        }
        $response = Http::get($url);
        return $response->json();
    }

    public function getProductAdmin()
    {
        $url = "https://60c18de74f7e880017dbfd51.mockapi.io/api/v1/jabar-digital-services/product";
        $prefixParam = "?";
        if(request('department')){
            $url .= $prefixParam . "department=".request('department');
            $prefixParam = "&";
        }
        if(request('product')){
            $url .= $prefixParam . "product=".request('product');
            $prefixParam = "&";
        }
        if(request('price')){
            $url .= $prefixParam . "price=".request('price');
            $prefixParam = "&";
        }
        $response = Http::get($url);
        $response = $response->json();

        if(request('sort')){
            $sort = request('sort');
            if($sort == 'price_asc'){
                usort($response, function($a, $b) {
                    return $a['price'] - $b['price'];
                });
            }
            if($sort == 'price_desc'){
                usort($response, function($a, $b) {
                    return $b['price'] - $a['price'];
                });
            }
        }

        return $response;
    }
}
