
<main class="main">


<div class="mb-5"></div><!-- End .mb-5 -->
<div class="container">
    <div class="heading heading-center mb-3">
        <h2 class="title">Trending</h2><!-- End .title -->

    </div><!-- End .heading -->

    <div class="tab-content tab-content-carousel">
        <div class="tab-pane p-0 fade show active" id="trending-all-tab" role="tabpanel" aria-labelledby="trending-all-link">
            <div class="col-6 col-md-4 col-lg-3">

                @foreach($products as $product)
                    <livewire:product :product="$product"></livewire:product>
                @endforeach
            </div><!-- End .owl-carousel -->
        </div><!-- .End .tab-pane -->
    </div><!-- End .tab-content -->
</div><!-- End .container -->

<div class="mb-5"></div><!-- End .mb-5 -->

<livewire:deal></livewire:deal>


<div class="mb-6"></div><!-- End .mb-5 -->

<div class="container">
    <h2 class="title text-center mb-4">New Arrivals</h2><!-- End .title text-center -->

    <div class="products">
        <div class="row justify-content-center">
            @foreach($new_arrivals as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <livewire:product :product="$product"></livewire:product>
                </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
            @endforeach
        </div><!-- End .row -->
    </div><!-- End .products -->

    <div class="more-container text-center mt-2">
        <a href="{{ route("products") }}" class="btn btn-outline-dark-2 btn-more"><span>show more</span></a>
    </div><!-- End .more-container -->
</div><!-- End .container -->


<div class="mb-2"></div><!-- End .mb-5 -->

<div class="container">
</div><!-- End .container -->

</main><!-- End .main -->
