<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Models\Review;

class ReviewsController extends Controller
{
    public function addReview(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            if(!Auth::check()){
                $message = "Silahkan Log in untuk memberikan ulasan pada produk ini";
                Session::flash('error_message', $message);
                return redirect()->back();
            }

            if(!isset($data['rating'])){
                $message = "Tambahkan minimal satu rating bintang untuk produk ini";
                Session::flash('error_message', $message);
                return redirect()->back();
            }

            $reviewCount = Review::where(['user_id'=>Auth::user()->id, 'product_id'=>$data['product_id']])->count();
            if($reviewCount>0){
                $message = "Anda sudah memberikan ulasan pada produk ini";
                Session::flash('error_message', $message);
                return redirect()->back();
            }else {
                $review = new Review;
                $review->user_id = Auth::user()->id;
                $review->product_id = $data['product_id'];
                $review->title = $data['title'];
                $review->review = $data['review'];
                $review->rating = $data['rating'];
                $review->status = 0;
                $review->save();
                $message = "Terima kasih atas ulasan yang Anda berikan.";
                Session::flash('success_message', $message);
                return redirect()->back();
            }
        }
    }
}
