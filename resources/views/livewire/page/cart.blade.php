@section("title", "Cart")
<main class="main">
<div class="loading" wire:loading style="border-radius: 0px; width: 100px; border-radius: 0px; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 40;">
    <span class="loader"></span>
</div>
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="cart">
	                <div class="container">
	                	<div class="row">
	                		<div class="col-lg-9">
                                @if(count($cart) > 0)
	                			<table class="table table-cart table-mobile">
									<thead>
										<tr>
											<th>Product</th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Total</th>
											<th></th>
										</tr>
									</thead>
                                  	<tbody>
                                      <div class="loading-wrapper" wire:loading style="background: white; opacity: 0.5; position: absolute; width: 100%; z-index: 20; height: 100%;">&nbsp;</div>

                                        @foreach($cart as $key => $product)
                                        <tr wire:key="{{ $product['variant'] }}">
                                            <td class="product-col" style="position: relative;">
												<div class="product">
													<figure class="product-media">
														<a href="#">
															<img src="/storage/{{ $product["variant"] ? $product["variant"] : $product["images"][0]["image"]}}" alt="Product image">
														</a>
													</figure>

													<h3 class="product-title">
														<a href="#">{{ $product["title"] }}</a>
													</h3><!-- End .product-title -->
												</div><!-- End .product -->
											</td>
											<td class="price-col">PKR {{ $product["price"] }}</td>
											<td class="quantity-col">
                                                <div class="cart-product-quantity" wire:ignore>
                                                    <input type="number" class="form-control" wire:model.live="cart.{{$key}}.quantity" value="{{ $product["quantity"] }}" min="1" max="100" step="1" data-decimals="0" required>
                                                </div><!-- End .cart-product-quantity -->
                                            </td>
											<td class="total-col">PKR {{ ($product["new_price"] ?? $product["price"]) * $product["quantity"] }}</td>
											<td wire:click="removeFromCart('{{ $product['variant'] }}')" class="remove-col"><button class="btn-remove"><i class="icon-close"></i></button></td>
										</tr>
                                    @endforeach
                              		</tbody>
								</table><!-- End .table table-wishlist -->
                                @else
                                <div class="alert alert-danger" style="background: #c96;">No item in cart</div>
                                @endif

	                		</div><!-- End .col-lg-9 -->
	                		<aside class="col-lg-3">
	                			<div class="summary summary-cart">
	                				<h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->


	                				<table class="table table-summary">
	                					<tbody>
                                            @php
                                                $total_price = (new \App\Services\Cart())->totalPrice($cart);
                                            @endphp

                                            @foreach($cart as $product)
                                                    <tr>
                                                        <td><a href="#">{{ $product["title"] }}</a></td>
                                                        @php
                                                            $unit_price = $product["new_price"] ?? $product["price"];
                                                            $quantity = $product["quantity"];
                                                            $total = $unit_price * $quantity;
                                                        @endphp
                                                        <td>PKR {{ $unit_price }} x {{ $quantity }}</td>
                                                    </tr>
                                                @endforeach
	                						<tr class="summary-total">
	                							<td>Subtotal:</td>
	                							<td>PKR {{ $total_price }}</td>
	                						</tr><!-- End .summary-subtotal -->
                                            <tr>
                                                <td>Shipping</td>
                                                <td>PKR {{ $setting->shipping_charges }}</td>
                                            </tr>
	                						<tr class="summary-total">
	                							<td>Total:</td>
	                							<td>PKR {{ $total_price + $setting->shipping_charges }}</td>
	                						</tr><!-- End .summary-total -->
	                					</tbody>
	                				</table><!-- End .table table-summary -->

	                				<a href="{{ route('checkout') }}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>

	                			</div><!-- End .summary -->

		            			<a href="{{ route('products') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
	                		</aside><!-- End .col-lg-3 -->
	                	</div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .cart -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
