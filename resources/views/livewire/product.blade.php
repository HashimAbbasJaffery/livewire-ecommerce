
<div class="product product-7 text-center">
<figure class="product-media" style="position: relative;">
                        <a href="{{ route("product", [ 'product' => $product->id ]) }}" style="height: 253px;">
                            <img src="/uploads/{{ $thumbnail }}" loading="lazy" alt="Product image" class="product-image">
                            <img src="/uploads/{{ $thumbnail }}" loading="lazy" alt="Product image" class="product-image-hover">
                        </a>
                        <!-- <div class="spinner" style="display: flex; align-items: center; justify-content: space-around; height: 253px; width: 100%;">
                            <div class="loader-container">
                                <div class="loader"></div>
                            </div>
                        </div> -->

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart" wire:click.prevent="addToCart({{ $product }})"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Clothing</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">{{ $product->title }}</a></h3><!-- End .product-title -->
                        <div class="product-price mt-1">
                            RS {{ $product->price }}
                        </div><!-- End .product-price -->

                        <div class="product-nav product-nav-thumbs">
                            @foreach($product->images as $image)
                            <a @class(['active' => $thumbnail === $image->image]) stye="cursor: pointer;">
                                <img wire:click="changeThumbnail('{{ $image->image }}')" src="/uploads/{{ $image->image }}" alt="product desc">
                            </a>
                            @endforeach
                        </div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

