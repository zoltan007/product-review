<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Review;
use App\Models\Order;
use App\Models\OrdersDetail;


class ProductsController extends Controller
{
    
    public function detail($id){
        $productDetails = Product::with('category','images','attributes')->find($id)->toArray();
        $getProductStock = Product::where('id',$id)->sum('stock');

        $reviews = Review::with('user')->where('status',1)->where('product_id', $id)->get()->toArray();

        //Get average rating of product
        $ratingsSum = Review::where('status',1)->where('product_id',$id)->sum('rating');
        $ratingsCount = Review::where('status',1)->where('product_id',$id)->count();

        if($ratingsCount>0){
            $avgRating = round($ratingsSum/$ratingsCount,2);
            $avgStarRating = round($ratingsSum/$ratingsCount);    
        }else{
            $avgRating = 0;
            $avgStarRating = 0;
        }

        return view('front.products.detail')->with(compact('productDetails','getProductStock','reviews','avgRating','avgStarRating'));
    }

}
