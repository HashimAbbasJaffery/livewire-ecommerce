<div class="row justify-content-center">
    @foreach ($products as $product)
        <div class="col-6 col-md-4 col-lg-4 col-xl-3" wire:key="product-{{ $product->id }}">
            <livewire:product :product="$product" wire:key="product-{{ $product->id }}"></livewire:product>
        </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
    @endforeach
</div>
