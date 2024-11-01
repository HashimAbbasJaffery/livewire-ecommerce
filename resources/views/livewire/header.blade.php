@section("image", $setting->logo)
<header class="header header-6">
    <div class="loading" wire:loading wire:target="removeFromCart" style="border-radius: 0px; width: 100px; border-radius: 0px; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 20;">
        <span class="loader"></span>
    </div>
    <div class="loading" wire:loading wire:target="addToCart" style="border-radius: 0px; width: 100px; border-radius: 0px; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 20;">
        <span class="loader"></span>
    </div>
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <ul class="top-menu top-link-menu d-none d-md-block">
                            <li>
                                <a href="#">Links</a>
                                <ul>
                                    <li><a href="tel:#"><i class="icon-phone"></i>Call: {{ $setting->phone }}</a></li>
                                </ul>
                            </li>
                        </ul><!-- End .top-menu -->
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <ul class="top-menu top-link-menu">
                            <li>
                                <a href="#">Links</a>

                                @auth
                                    <div class="options" style="display: flex; justify-content: space-space-between; width: 10%; padding: 2px;">
                                        <form method="POST" class="mb-2" action="{{ route("logout") }}" style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="mr-3" style="border: none; background: #c96; color: white; border-radius: 4px; margin-bottom: 10px;">Logout</button>
                                        </form>
                                        <p class="mr-2">{{ auth()->user()->name }}</p>
                                    </div>
                                @endauth
                                @guest
                                    <div class="actions" style="display: flex;">
                                        <form action="{{ route('login') }}" class="mr-3">
                                            <button style="border: none; background: #c96; color: white; border-radius: 4px; margin-bottom: 10px;" type="submit">Login</button>
                                        </form>
                                        <form action="{{ route('register') }}">
                                            <button style="border: none; background: #c96; color: white; border-radius: 4px; margin-bottom: 10px;" type="submit">Register</button>
                                        </form>
                                    </div>
                                @endguest

                            </li>
                        </ul><!-- End .top-menu -->

                    </div><!-- End .header-right -->
                </div>
            </div>
            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <div x-data="{ search: ''  }" class="header-search header-search-extended header-search-visible d-none d-lg-block position-relative" x-data="{ open: false }">
                          <form method="get">
                                <div class="header-search-wrapper search-wrapper-wide">
                                    <label for="q" class="sr-only">Search</label>
                                    <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                    <input x-model="search" wire:model.live.debounce.500ms="search" type="search" class="form-control" name="q" id="q" placeholder="Search product ..." required>
                                </div><!-- End .header-search-wrapper -->
                            </form>
                            <div x-if="search.length > 0" wire:loading wire:target="search" class="suggestions position-absolute p-3 bg-light border border-black w-100">
                                <div class="spinner-black mx-auto"></div>
                            </div>
                            @if($products && count($products) > 0)
                                <div wire:loading.remove wire:target="search" class="suggestions position-absolute p-3 bg-light border border-black w-100" style="max-height: 250px; z-index: 999999; overflow-x: auto;">
                                    @foreach($products as $product)
                                        <a href="{{ route('product', [ 'product' => $product->id ]) }}">
                                            <div class="product d-flex">
                                                <div class="product-img" style="width: 20%;">
                                                    <img src="/storage/{{ $product->images[0]?->image ?? 'dummy.jpg' }}" alt="">
                                                </div>
                                                <div class="product-detail ml-3 d-flex flex-column" style="justify-content: space-between; width: 70%;">
                                                    <p>{{ $product->title }} <br> <span style="font-size: 11px; padding-top: 10px;">{{ $product->categories[0]?->category ?? "Not assigned" }}</span></p>
                                                    <p style="font-size: 14px; color: #c96;">{{ $product->price }}RS</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                    @if(count($products) < $products->total())
                                        <p wire:click="loadMore" style="background: #c96; color: white; text-align: center; cursor:pointer;" class="p-3">
                                            Load More
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div><!-- End .header-search -->
                    </div>
                    <div class="header-center">
                        <a href="{{ route('home') }}" class="logo">
                            <img src="/storage/{{ $setting->logo }}" alt="Molla Logo" width="82" height="20">
                        </a>
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        @auth
                            <a href="{{ route("wishlists") }}" class="wishlist-link">
                                <i class="icon-heart-o"></i>
                                <span class="wishlist-count">{{ $total_wishlists }}</span>
                                <span class="wishlist-txt">My Wishlist</span>
                            </a>
                        @endauth

                        <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <i class="icon-shopping-cart"></i>
                                <span class="cart-count">{{ count($cart) }}</span>
                                <span class="cart-txt">PKR {{ (new \App\Services\Cart())->totalPrice($cart) }}</span>
                            </a>
                            @if(count($cart) > 0)
                            <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-cart-products">
                                        @foreach($cart as $product)
                                        <div class="product" style="position: relative;" wire:key="{{ $product['id'] }}">
                                            <div class="deleting" wire:loading.flex wire:target="removeFromCart('{{ $product["variant"] }}')" style="display: none; justify-content: center; align-items: center; background: white; position: absolute; width: 100%; z-index: 10; height: 100%; opacity: 0.5;">
                                                &nbsp;
                                            </div>
                                            <div class="product-cart-details">
                                                <h4 class="product-title">
                                                    <a href="product.html">{{ $product["title"] }}</a>
                                                </h4>

                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">{{ $product["quantity"] }}</span>
                                                    x RS {{ ($product["new_price"] ?? $product["price"]) }}
                                                </span>
                                            </div><!-- End .product-cart-details -->

                                            <figure class="product-image-container">
                                                <a href="product.html" class="product-image">
                                                    <img src="/storage/{{ $product["variant"] ? $product["variant"] : $product['images'][0]['image'] }}" alt="product">
                                                </a>
                                            </figure>
                                            <a class="btn-remove" title="Remove Product" wire:click.prevent="removeFromCart('{{ $product["variant"] }}')"><i class="icon-close"></i></a>

                                            <!-- <span style="display: inline;" class="spinner-black ml-3"></span> -->
                                        </div><!-- End .product -->
                                        @endforeach

                                    </div><!-- End .cart-product -->

                                    <div class="dropdown-cart-total">
                                        <span>Total</span>

                                        <span class="cart-total-price">PKR {{ (new \App\Services\Cart())->totalPrice($cart) }}</span>
                                    </div><!-- End .dropdown-cart-total -->

                                    <div class="dropdown-cart-action">
                                        <a href="{{ route('cart') }}" class="btn btn-primary text-white">View Cart</a>
                                        <a href="{{ route('checkout') }}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                                    </div><!-- End .dropdown-cart-total -->

                                </div><!-- End .dropdown-menu -->
                                @endif
                        </div><!-- End .cart-dropdown -->
                    </div>
                </div><!-- End .container -->
            </div><!-- End .header-middle -->

            <div class="header-bottom sticky-header">
                <div class="container">
                    <div class="header-left">
                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li @class(["active" => request()->routeIs("home")])>
                                    <a href="{{ route("home") }}">Home</a>
                                </li>
                                <li @class(["active" => request()->routeIs("products")])>
                                    <a href="{{ route("products") }}">Shop</a>
                                </li>
                                <li @class(["active" => request()->routeIs("track")])>
                                    <a href="{{ route("track") }}">Track</a>
                                </li>
                                @can('admin')
                                    <li>
                                        <a href="/admin">Admin</a>
                                    </li>
                                @endcan
                                @auth
                                    <li @class(["active" => request()->routeIs("orders")])>
                                        <a href="{{ route('orders') }}">Orders</a>
                                    </li>
                                @endauth
                            </ul><!-- End .menu -->
                        </nav><!-- End .main-nav -->

                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>
                    </div><!-- End .header-left -->
                </div><!-- End .container -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->
