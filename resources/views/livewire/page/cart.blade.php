<main class="main">
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
                                        @foreach($cart as $key => $product)
                                       <tr wire:key="{{ $product['id'] }}">
											<td class="product-col">
												<div class="product">
													<figure class="product-media">
														<a href="#">
															<img src="/uploads/{{ $product["images"][0]["image"] }}" alt="Product image">
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
                                                    <input type="number" class="form-control" wire:model.live="cart.{{$key}}.quantity" value="{{ $product["quantity"] }}" min="1" max="10" step="1" data-decimals="0" required>
                                                </div><!-- End .cart-product-quantity -->
                                            </td>
											<td class="total-col">PKR {{ ($product["new_price"] ?? $product["price"]) * $product["quantity"] }}</td>
											<td wire:click="removeFromCart('{{ $product['id'] }}')" class="remove-col"><button class="btn-remove"><i class="icon-close"></i></button></td>
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
	                						<tr class="summary-total">
	                							<td>Subtotal:</td>
	                							<td>PKR {{ $total_price }}</td>
	                						</tr><!-- End .summary-subtotal -->
                                            <p></p>
	                						<tr class="summary-total">
	                							<td>Total:</td>
	                							<td>PKR {{ $total_price }}</td>
	                						</tr><!-- End .summary-total -->
	                					</tbody>
	                				</table><!-- End .table table-summary -->

	                				<a href="checkout.html" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>

	                			</div><!-- End .summary -->

		            			<a href="category.html" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
	                		</aside><!-- End .col-lg-3 -->
	                	</div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .cart -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
