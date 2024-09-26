@section("title", "Wishlist")
<main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Wishlist<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="container">
                    @if(count($wishlists) > 0)
                        <table class="table table-wishlist table-mobile">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($wishlists as $wishlist)
                                    <tr wire:key="wishlist-{{ $wishlist->id }}">
                                        <td class="product-col">
                                            <div class="product">
                                                <figure class="product-media">
                                                    <a href="#">
                                                        <img src="/storage/{{ $wishlist->images[0]?->image ?? "dummy.jpg" }}" alt="Product image">
                                                    </a>
                                                </figure>

                                                <h3 class="product-title">
                                                    <a href="#">{{ $wishlist->title }}</a>
                                                </h3><!-- End .product-title -->
                                            </div><!-- End .product -->
                                        </td>
                                        <td class="price-col">RS {{ $wishlist->new_price ?? $wishlist->price }}</td>
                                        <td class="action-col">
                                            <div class="dropdown">
                                            <button wire:loading.attr="disabled" wire:target="addToCart({{ $wishlist }})" wire:click="addToCart({{ $wishlist }})" class="btn btn-block btn-outline-primary-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Add To Cart
                                                <div wire:loading wire:target="addToCart({{ $wishlist }})" class="spinner-black ml-3"></div>
                                            </button>
                                            </div>
                                        </td>
                                        <td class="remove-col"><button class="btn-remove" wire:click="remove('{{ $wishlist->id }}')"><i class="icon-close"></i></button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table><!-- End .table table-wishlist -->
                        {{ $wishlists->links('pagination.pagination') }}
                    @else
                        <div class="alert alert-dark mb-2" role="alert">
                            No Product is in the wishlist yet! Add Products from <a href="{{ route('products') }}">Shop</a>
                        </div>
                    @endif
	            	<div class="wishlist-share">
	            		<div class="social-icons social-icons-sm mb-2">
	            			<label class="social-label">Share on:</label>
	    					<a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
	    					<a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
	    					<a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
	    					<a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
	    					<a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
	    				</div><!-- End .soial-icons -->
	            	</div><!-- End .wishlist-share -->
            	</div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
