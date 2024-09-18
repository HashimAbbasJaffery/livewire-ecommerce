
<div class="deal bg-image pt-8 pb-8" style="background-image: url(/assets/images/demos/demo-6/deal/bg-1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8 col-lg-6">
                <div class="deal-content text-center">
                    <h2>Popular Sale!</h2>
                    <div class="deal-countdown" data-until="+10h"></div><!-- End .deal-countdown -->
                </div><!-- End .deal-content -->
                <div class="row deal-products">
                    @foreach($deals as $deal)
                        <div class="col-6 deal-product text-center">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="/storage/{{ $deal->images[0]?->image ?? "dummy.jpg" }}" alt="Product image" class="product-image">
                                </a>

                            </figure><!-- End .product-media -->

                            <div class="product-body mt-1">
                                <h3 class="product-title"><a href="product.html">{{ $deal->title }}</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    <span class="new-price">Now RS {{ $deal->new_price }}</span>
                                    <span class="old-price">Was RS {{ $deal->price }}</span>
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                            <a href="{{ route('product', [ 'product' => $deal->id ]) }}" class="action">shop now</a>
                        </div>
                    @endforeach
                </div>
            </div><!-- End .col-lg-5 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div>
