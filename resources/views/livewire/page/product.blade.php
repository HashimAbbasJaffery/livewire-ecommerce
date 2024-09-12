<main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container d-flex align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sticky Info</li>
                    </ol>

                    <nav class="product-pager ml-auto" aria-label="Product">
                        <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                            <i class="icon-angle-left"></i>
                            <span>Prev</span>
                        </a>

                        <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                            <span>Next</span>
                            <i class="icon-angle-right"></i>
                        </a>
                    </nav><!-- End .pager-nav -->
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                    <div class="product-details-top">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-gallery product-gallery-separated">
                                    @if($product->new_price)
                                        <span class="product-label label-sale">Sale</span>
                                    @endif
                                    @foreach($product->images as $image)
                                        <figure class="product-separated-item">
                                            <img src="/storage/{{ $image->image }}" data-zoom-image="assets/images/products/single/sticky/1-big.jpg" alt="product image">
                                        </figure>
                                    @endforeach

                                     </div><!-- End .product-gallery -->
                            </div><!-- End .col-md-6 -->

                            <div class="col-md-6">
                                <div class="product-details sticky-content">
                                    <h1 class="product-title">{{ $product->title }}</h1><!-- End .product-title -->
                                    @php
                                        $cart = new \App\Services\Cart();
                                        $quantity = $cart->quantityValidator((float)$quantity);
                                    @endphp
                                    <div class="product-price">
                                        <span class="new-price">PKR {{  $quantity * ($product->new_price ?? $product->price) }}</span>
                                        @if($product->new_price)
                                            <span class="old-price">PKR {{ $quantity * $product->price }}</span>
                                        @endif
                                    </div><!-- End .product-price -->

                                    <div class="product-content">
                                        <p>{{ $product->description }}</p>
                                    </div><!-- End .product-content -->

                                    <div class="product-countdown" data-until="2019, 10, 29"></div><!-- End .product-countdown -->

                                    <div class="details-filter-row details-row-size">
                                        <label for="qty">Qty:</label>
                                        <div class="product-details-quantity">
                                            <input type="number" wire:model.live="quantity" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                        </div><!-- End .product-details-quantity -->
                                    </div><!-- End .details-filter-row -->

                                    <div class="product-details-action">
                                        <a href="#" class="btn-product btn-cart" wire:click="addToCart()"><span>add to cart</span></a>

                                        <div class="details-action-wrapper">
                                            <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                        </div><!-- End .details-action-wrapper -->
                                    </div><!-- End .product-details-action -->

                                    <div class="product-details-footer">
                                        @if(count($product->categories))
                                            <div class="product-cat">
                                                <span>Category:</span>
                                                @foreach($product->categories as $category)
                                                    <a href="#">{{ $category->category }}</a>@if(!$loop->last), @endif
                                                @endforeach
                                            </div><!-- End .product-cat -->
                                        @endif

                                    </div><!-- End .product-details-footer -->

                                    <div class="accordion accordion-plus product-details-accordion" id="product-accordion">
                                        <div class="card card-box card-sm">
                                            <div class="card-header" id="product-desc-heading">
                                                <h2 class="card-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#product-accordion-desc" aria-expanded="false" aria-controls="product-accordion-desc">
                                                        Description
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="product-accordion-desc" class="collapse" aria-labelledby="product-desc-heading" data-parent="#product-accordion">
                                                <div class="card-body">
                                                    <div class="product-desc-content">
                                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci.</p>
                                                        <ul>
                                                            <li>Nunc nec porttitor turpis. In eu risus enim. In vitae mollis elit. </li>
                                                            <li>Vivamus finibus vel mauris ut vehicula.</li>
                                                            <li>Nullam a magna porttitor, dictum risus nec, faucibus sapien.</li>
                                                        </ul>

                                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a, pede.</p>
                                                    </div><!-- End .product-desc-content -->
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->

                                        <div class="card card-box card-sm">
                                            <div class="card-header" id="product-info-heading">
                                                <h2 class="card-title">
                                                    <a role="button" data-toggle="collapse" href="#product-accordion-info" aria-expanded="true" aria-controls="product-accordion-info">
                                                        Additional Information
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="product-accordion-info" class="collapse show" aria-labelledby="product-info-heading" data-parent="#product-accordion">
                                                <div class="card-body">
                                                    <div class="product-desc-content">
                                                        {!! $product->extra_description !!}

                                                        <h3 class="mt-3">Variants</h3>
                                                        <div style="display: flex;">
                                                            @foreach ($product->images as $image)
                                                                <img wire:click="changeSelected('{{ $image->image }}')" src="/storage/{{ $image->image }}" style="@if($selected === $image->image) border: 1px solid yellow; @endif height: 70px; border-radius: 10px; margin: 3px; padding: 3px; cursor: pointer; cursor: pointer;" alt="">
                                                            @endforeach
                                                        </div>
                                                    </div><!-- End .product-desc-content -->
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->

                                    </div><!-- End .accordion -->
                                </div><!-- End .product-details -->
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-details-top -->

                    <hr class="mt-3 mb-5">
       </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
