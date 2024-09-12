
<div class="product product-{{ $product->id }} text-center">
<figure class="product-media" style="position: relative;">
                        <a href="{{ route("product", [ 'product' => $product->id ]) }}" style="height: 253px;">
                            <img src="/storage/{{ $thumbnail }}" loading="lazy" alt="Product image" class="product-image">
                            <img src="/storage/{{ $thumbnail }}" loading="lazy" alt="Product image" class="product-image-hover">
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
                            <form wire:target="addToCart" wire:submit.prevent="addToCart({{ $product }})" wire:loading.attr="disabled" style="display: inline-block; width: 100%;">
                                <button type="submit" wire:target="addToCart" wire:loading.attr="disabled" style="transition: .5s ease; border: none; width: 100%;" class="btn-product btn-cart">
                                    <span>add to cart</span>
                                    <span wire:loading wire:target="addToCart" class="spinner ml-3"></span>
                                </button>
                            </form>
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
                            @foreach($images as $image)
                            <a wire:key="image-{{ $image->id }}" @class(['active' => $thumbnail === $image->image]) stye="cursor: pointer;">
                                <img wire:click="changeThumbnail('{{ $image->image }}')" src="/storage/{{ $image->image }}" alt="product desc">
                            </a>
                            @endforeach
                        </div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

