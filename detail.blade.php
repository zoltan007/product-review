<?php use App\Models\Product; ?>
@extends('front.layout.layout')
@section('content')
                            <!-- Reviews-Tab -->
                            <div class="tab-pane active show fade" id="review">
                                <div class="review-whole-container">                                    
                                    <div class="row r-2 u-s-m-b-26 u-s-p-b-22">
                                        <div class="col-lg-12">
                                            <div class="your-rating-wrapper">
                                                <h6 class="review-h6">Penilaian produk yang Anda beli akan sangat membantu kami.</h6>
                                                <h6 class="review-h6">Bagaimana penilaian Anda terhadap produk kami?</h6>
                                                <br>
                                                <form method="POST" action="{{ url('/add-review') }}" name="reviewForm" id="reviewForm">@csrf
                                                <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
                                                <div class="star-wrapper u-s-m-b-8">
                                                <div class="rate">
                                                    <input type="radio" id="star5" name="rating" value="5" />
                                                    <label for="star5">5 stars</label>
                                                    <input type="radio" id="star4" name="rating" value="4" />
                                                    <label for="star4">4 stars</label>
                                                    <input type="radio" id="star3" name="rating" value="3" />
                                                    <label for="star3">3 stars</label>
                                                    <input type="radio" id="star2" name="rating" value="2" />
                                                    <label for="star2">2 stars</label>
                                                    <input type="radio" id="star1" name="rating" value="1" />
                                                    <label for="star1">1 star</label>
                                                </div>
                                                </div>
                                                &nbsp;
                                                    <div class="u-s-m-b-30">
                                                    <label for="review-title" class="label-title">Judul
                                                        <span class="astk"> *</span>
                                                    </label>
                                                    <input id="review-title" type="text" class="text-field" placeholder="Judul Ulasan" name="title">
                                                    </div>
                                                    <div class="u-s-m-b-30">
                                                    <label for="review-text-area" class="label-title">Isi Ulasan
                                                        <span class="astk"> *</span>
                                                    </label>
                                                    <textarea class="text-area u-s-m-b-8" id="review-text-area" placeholder="Review" name="review"></textarea>
                                                    </div>
                                                    <button class="button button-outline-secondary" type="submit">Kirim Ulasan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Get-Reviews -->
                                    <div class="get-reviews u-s-p-b-22">
                                        <!-- Review-Options -->
                                        <div class="review-options u-s-m-b-16">
                                            <div class="review-option-heading">
                                                <h6>Ulasan</h6>                                                
                                            </div>                                            
                                        </div>
                                        <!-- Review-Options /- -->
                                        <!-- All-Reviews -->
                                        <div class="reviewers">
                                            @if(count($reviews)>0)
                                            @foreach($reviews as $review)
                                            <div class="review-data">
                                                <div class="reviewer-name-and-date">
                                                    <h6 class="reviewer-name">{{ $review['user']['name'] }}</h6>
                                                    <h6 class="review-posted-date">{{ date("d-m-Y", strtotime($review['created_at'])) }}</h6>
                                                </div>
                                                <div class="reviewer-stars-title-body">
                                                    <div class="reviewer-stars">
                                                            <?php
                                                            $count=1;
                                                            while($count<$review['rating']){ ?>
                                                            <span>&#9733;</span>
                                                            <?php $count++; } ?>
                                                        <span class="review-title">{{ $review['title'] }}</span>
                                                    </div>
                                                    <p class="review-body">
                                                        {{ $review['review'] }}
                                                    </p>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                                <p> Tidak ada ulasan untuk produk ini.</p>
                                            @endif                                            
                                        </div> 
                                        <!-- All-Reviews /- -->                                        
                                    </div>
                                    <!-- Get-Reviews /- -->
                                </div>
                            </div>
                            <!-- Reviews-Tab /- -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Detail-Tabs /- -->
        </div>
    </div>
    <!-- Single-Product-Full-Width-Page /- -->
@endsection
