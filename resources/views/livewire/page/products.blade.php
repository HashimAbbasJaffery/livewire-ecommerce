
<main class="main">
            <div class="page-content mt-3">
                <div class="container">
                	<div class="row">
                		<div class="col-lg-9">
                			<div class="toolbox">
                				<div class="toolbox-left">
                					<div class="toolbox-info">
                                        @php
                                            $start = ($products->currentPage() - 1) * $products->perPage();
                                            $end = min($start + $products->count() - 1, $products->total());
                                        @endphp
                                        Showing <span>{{ $start + 1 }} to {{ $start + $products->count() }} of {{ $products->total() }}</span> Products
                					</div><!-- End .toolbox-info -->
                				</div><!-- End .toolbox-left -->

                			</div><!-- End .toolbox -->

                            <div class="products mb-3">
                                <div class="row justify-content-center">
                                    @foreach ($products as $product)
                                        <div class="col-6 col-md-4 col-lg-4 col-xl-3" wire:key="product-{{ $product->id }}" lazy>
                                            <livewire:product :product="$product" wire:key="product-{{ $product->id }}"></livewire:product>
                                        </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                                    @endforeach

                                    </div><!-- End .row -->
                            </div><!-- End .products -->

                            {{ $products->links('pagination.pagination') }}
                			<!-- <nav aria-label="Page navigation">
							    <ul class="pagination justify-content-center">
							        <li class="page-item disabled">
							            <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
							                <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
							            </a>
							        </li>
							        <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
							        <li class="page-item"><a class="page-link" href="#">2</a></li>
							        <li class="page-item"><a class="page-link" href="#">3</a></li>
							        <li class="page-item-total">of 6</li>
							        <li class="page-item">
							            <a class="page-link page-link-next" href="#" aria-label="Next">
							                Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
							            </a>
							        </li>
							    </ul>
							</nav> -->
                		</div><!-- End .col-lg-9 -->
                		<aside class="col-lg-3 order-lg-first">
                			<div class="sidebar sidebar-shop"><!-- End .widget widget-clean -->

                				<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
									        Category
									    </a>
									</h3><!-- End .widget-title -->
                                  	<div class="collapse show" id="widget-1">
										<div class="widget-body">
											<div class="filter-items filter-items-count">
                                                @foreach($categories as $category)
                                                    <div class="filter-item" wire:key="category-{{ $category->id }}">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" wire:model.live="categoriesList" value="{{ $category->id }}" class="custom-control-input" id="cat-{{ $category->id }}">
                                                            <label class="custom-control-label" for="cat-{{ $category->id }}">{{ $category->category }}</label>
                                                        </div><!-- End .custom-checkbox -->
                                                    </div><!-- End .filter-item -->
                                                @endforeach

											</div><!-- End .filter-items -->
										</div><!-- End .widget-body -->
                                 	</div><!-- End .collapse -->
                                    <h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
									        Colors
									    </a>
									</h3><!-- End .widget-title -->
                                    <div class="collapse show" id="widget-1">
										<div class="widget-body">
											<div class="filter-items filter-items-count" style="max-height: 350px; overflow-y: auto;">

                                                  @foreach($colors as $color)
                                                    <div class="filter-item" wire:key="color-{{ $color->id }}">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" wire:key="color-{{ $color->id }}" wire:model.live="colorsList" value="{{ $color->id }}" class="custom-control-input" id="color-{{ $color->id }}">
                                                            <label class="custom-control-label" for="color-{{ $color->id }}">{{ $color->color }}</label>
                                                        </div><!-- End .custom-checkbox -->
                                                    </div><!-- End .filter-item -->
                                                @endforeach

											</div><!-- End .filter-items -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->




        						<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
									        Price
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-5" wire:ignore>
										<div class="widget-body">
                                            <div class="filter-price">
                                                <div class="filter-price-text">
                                                    Price Range:
                                                    <span id="filter-price-range"></span>
                                                </div><!-- End .filter-price-text -->

                                                <div id="price-slider"></div>
                                            </div><!-- End .filter-price -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->
                			</div><!-- End .sidebar sidebar-shop -->
                		</aside><!-- End .col-lg-3 -->
                	</div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
