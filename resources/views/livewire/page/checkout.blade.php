@section("title", "Checkout")
<main class="main">

<div class="loading" wire:loading wire:target="save" style="border-radius: 0px; width: 100px; border-radius: 0px; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 20;">
    <span class="loader"></span>
</div>
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
            			<form wire:submit.prevent="save" wire:target="save" wire:loading.attr="disabled">
		                	<div class="row">
		                		<div class="col-lg-9">
		                			<h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
		                				<div class="row">
		                					<div class="col-sm-6">
                                                <label>First Name *</label>
                                                <div class="text-danger">@error('form.first_name') {{ $message }} @enderror</div>
		                						<input wire:model.blur="form.first_name" type="text" class="form-control @error('form.first_name') border border-danger @enderror" required>
                                            </div><!-- End .col-sm-6 -->

		                					<div class="col-sm-6">
		                						<label>Last Name *</label>
                                                <div class="text-danger">@error('form.last_name') {{ $message }} @enderror</div>
		                						<input wire:model.blur="form.last_name" type="text" class="form-control @error('form.last_name') border border-danger @enderror" required>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->


	            						<label>Country/Region</label>
	            						<!-- <input type="text" class="form-control" required> -->
                                        <p class="mb-2" style="font-weight: bold">Pakistan</p>


	            						<label>Street address *</label>
                                        <div class="text-danger">@error('form.street_address') {{ $message }} @enderror</div>
	            						<input type="text" wire:model.blur="form.street_address" class="form-control @error('form.street_address') border border-danger @enderror" placeholder="House number and Street name" required>
                                        <div class="text-danger">@error('form.apartment') {{ $message }} @enderror</div>
	            						<input type="text" wire:model.blur="form.apartment" class="form-control @error('form.apartment') border border-danger @enderror" placeholder="Appartments, suite, unit etc ..." required>

                                       <div class="row">
		                					<div class="col-sm-6 mb-3 rounded" style="border: 1px solid #d7d7d7; padding: 10px; height: 350px; overflow-x:auto;">
		                						<label>Town / City *</label>
                                                <div class="text-danger">@error('form.city') {{ $message }} @enderror</div>
	            				                <!-- <input wire:model.blur="form.city" type="text" class="form-control @error('form.city') border border-danger @enderror" required> -->
                                                <div class="cities"
                                                    x-data="{
                                                        items: @entangle('cities'),
                                                        search: '',
														selectedCity: '',
                                                        get filteredCities() {
                                                            return this.items.filter(item => item.operationalCityName.toLowerCase().includes(this.search.toLowerCase()))
                                                        }
                                                    }"
                                                >
                                                <input x-model="search" type="text" class="form-control @error('form.city') border border-danger @enderror" required>
                                                    <template x-for="(city, index) in filteredCities">
                                                        <div class="city mb-2 d-flex justify-content-between align-items-center">
                                                            <p x-text="city.operationalCityName"></p>
                                                            <button
                                                                wire:click="changeCity(city)"
																x-on:click="selectedCity = city.operationalCityName"
																type="button"
                                                                class="rounded btn btn-secondary"
																:disabled="selectedCity === city.operationalCityName"
                                                                x-text="selectedCity === city.operationalCityName ? 'Selected' : 'Select'"
                                                            >
                                                            </button>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
		                						<label>Email address *</label>
                                                <div class="text-danger">@error('form.email') {{ $message }} @enderror</div>
                                                <input wire:model.blur="form.email" type="email" class="form-control @error('form.email') border border-danger @enderror" required>
                                            </div><!-- End .col-sm-6 -->


		                				</div><!-- End .row -->

		                				<div class="row">

		                					<div class="col-sm-6">
		                						<label>Phone *</label>
                                                <div class="text-danger">@error('form.phone') {{ $message }} @enderror</div>
                                                <input wire:model.blur="form.phone" type="tel" class="form-control @error('form.phone') border border-danger @enderror" required>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->



	                					<label>Order notes (optional)</label>
	        							<textarea wire:model.blur="form.order_notes" class="form-control" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                                        <button wire:target="save" type="submit" wire:loading.attr="disabled" class="btn btn-outline-primary-2">
		                					Place Order <div wire:loading wire:target="save" class="spinner-black ml-3"></div>
		                				</button>
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
                                                        @php
                                                            $unit_price = $product["new_price"] ?? $product["price"];
                                                            $quantity = $product["quantity"];
                                                            $total = $unit_price * $quantity;
                                                        @endphp
                                                        <td>PKR {{ $unit_price }} x {{ $quantity }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr class="summary-subtotal">
		                							<td>Subtotal:</td>
		                							<td>PKR {{ (new \App\Services\Cart())->totalPrice($cart) }}</td>
		                						</tr><!-- End .summary-subtotal -->
                                                <tr>
                                                    <td>Shipping</td>
                                                    <td>PKR {{ $setting->shipping_charges }}</td>
                                                </tr>
		                						<tr class="summary-total">
		                							<td>Total:</td>
		                							<td>PKR {{ (new \App\Services\Cart())->totalPrice($cart) + $setting->shipping_charges }}</td>
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
