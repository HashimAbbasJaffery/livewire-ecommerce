@section("title", "Orders")

<div class="container mx-auto my-5">
    @if(count($orders) > 0)
        <div class="orders">
            <div class="order">
                <table class="table table-cart table-mobile" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--[if BLOCK]><![endif]-->
                        @foreach($orders as $order)
                            @foreach($order->products as $product)
                                <tr wire:key="{{ $product->id }}">
                                    <td class="product-col">
                                        <div class="product">
                                            <figure class="product-media">
                                                <a href="#">
                                                    <img src="/storage/{{ $product?->pivot?->variant ?? "dummy.jpg" }}" alt="Product image">
                                                </a>
                                            </figure>

                                            <h3 class="product-title">
                                                <a href="#">{{ $product->title }}</a>
                                            </h3><!-- End .product-title -->
                                        </div><!-- End .product -->
                                    </td>
                                    <td class="price-col">PKR {{ $product->price }}</td>
                                    <td class="price-col">{{ $product?->pivot?->quantity ?? "none" }}</td>
                                    <td>
                                        <a href="{{ route('track', [ 'tracking_number' => $order->tracking_number ]) }}" style="color: white;" type="button" class="btn btn-info">Track</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    <!--[if ENDBLOCK]><![endif]-->
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-dark">You haven't Order any Product yet... Explore our <a href="{{ route("products") }}">Shop</a></div>
    @endif
</div>
