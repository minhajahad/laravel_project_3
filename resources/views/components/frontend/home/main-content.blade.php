@php
$products = App\Models\Product::where('status',1)->orderBy('id','ASC')->limit(5)->get()
@endphp


<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Latest Products</h2>
                    <div class="product-carousel">
                        @foreach($products as $product)
                        <div class="single-product">
                            <div class="product-f-image">
                                <img src="/storage/products/{{($product->product_image)}}" alt="">
                            </div>

                            <h2><a href="single-product.html">{{($product->product_name)}}</a></h2>

                            <div class="product-carousel-price">
                                <ins>@if($product->discount_price == null)
                                    <span>{{($product->selling_price)}}</span>
                                    @elseif($product->discount_price == 0)
                                    <span class="badge rounded-pill">Free</span>
                                    @else
                                    {{$product->discount_price}}
                                    @endif</ins>

                                <del>
                                    @if($product->discount_price == null)
                                    <span></span>
                                    @elseif($product->discount_price == $product->selling_price)
                                    <span></span>
                                    @else
                                    <span">{{($product->selling_price)}}</span>
                                        @endif
                                </del>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>