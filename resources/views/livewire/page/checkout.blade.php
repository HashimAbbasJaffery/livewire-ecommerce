<main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Checkout<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="checkout">
	                <div class="container">
            			<!-- <div class="checkout-discount">
            				<form action="#">
        						<input type="text" class="form-control" required id="checkout-discount-input">
            					<label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
            				</form>
            			</div> -->
            			<form wire:submit.prevent="createOrder">
		                	<div class="row">
		                		<div class="col-lg-9">
		                			<h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
		                				<div class="row">
		                					<div class="col-sm-6">
		                						<label>First Name *</label>
		                						<input wire:model="first_name" type="text" class="form-control" required>
		                					</div><!-- End .col-sm-6 -->

		                					<div class="col-sm-6">
		                						<label>Last Name *</label>
		                						<input wire:model="last_name" type="text" class="form-control" required>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->


	            						<label>Country/Region</label>
	            						<!-- <input type="text" class="form-control" required> -->
                                        <p class="mb-2" style="font-weight: bold">Pakistan</p>

	            						<label>Street address *</label>
	            						<input type="text" wire:model="street_address" class="form-control" placeholder="House number and Street name" required>
	            						<input type="text" wire:model="apartment" class="form-control" placeholder="Appartments, suite, unit etc ..." required>

	            						<div class="row">
		                					<div class="col-sm-6">
		                						<label>Town / City *</label>
		                						<input wire:model="city" type="text" class="form-control" required>
		                					</div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
		                						<label>Email address *</label>
                                                <input wire:model="email" type="email" class="form-control" required>
                                            </div><!-- End .col-sm-6 -->


		                				</div><!-- End .row -->

		                				<div class="row">

		                					<div class="col-sm-6">
		                						<label>Phone *</label>
		                						<input wire:model="phone" type="tel" class="form-control" required>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->



	                					<label>Order notes (optional)</label>
	        							<textarea wire:model="order_notes" class="form-control" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
		                		</div><!-- End .col-lg-9 -->
		                		<aside class="col-lg-3">
		                			<div class="summary">
		                				<h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

		                				<table class="table table-summary">
		                					<thead>
		                						<tr>
		                							<th>Product</th>
		                							<th>Total</th>
		                						</tr>
		                					</thead>

		                					<tbody>
                                                @foreach($cart as $product)
                                                    <tr>
                                                        <td><a href="#">{{ $product["title"] }}</a></td>
                                                        <td>PKR {{ $product["new_price"] ?? $product["price"] }}</td>
                                                    </tr>
                                                @endforeach
		                						<tr class="summary-subtotal">
		                							<td>Subtotal:</td>
		                							<td>PKR {{ (new \App\Services\Cart())->totalPrice($cart) }}</td>
		                						</tr><!-- End .summary-subtotal -->
		                						<tr class="summary-total">
		                							<td>Total:</td>
		                							<td>PKR {{ (new \App\Services\Cart())->totalPrice($cart) }}</td>
		                						</tr><!-- End .summary-total -->
		                					</tbody>
		                				</table><!-- End .table table-summary -->

		                				<div class="accordion-summary" id="accordion-payment">
										    <div class="card">
										        <div class="card-header" id="heading-1">
										            <h2 class="card-title">
										                <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
										                    Cash On Delivery
										                </a>
										            </h2>
										        </div><!-- End .card-header -->
										        <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#accordion-payment">
										            <div class="card-body">
                                                        Currently, We only accept Cash On Delivery. You have to pay the rider on your door
                                                    </div><!-- End .card-body -->
										        </div><!-- End .collapse -->
										    </div><!-- End .card -->

										</div><!-- End .accordion -->

		                				<button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
		                					<span class="btn-text">Place Order</span>
		                					<span class="btn-hover-text">Proceed to Checkout</span>
		                				</button>
		                			</div><!-- End .summary -->
		                		</aside><!-- End .col-lg-3 -->
		                	</div><!-- End .row -->
            			</form>
	                </div><!-- End .container -->
                </div><!-- End .checkout -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
