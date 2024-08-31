
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

                				<div class="toolbox-right">
                					<div class="toolbox-sort">
                						<label for="sortby">Sort by:</label>
                						<div class="select-custom">
											<select name="sortby" id="sortby" class="form-control">
												<option value="popularity" selected="selected">Most Popular</option>
												<option value="rating">Most Rated</option>
												<option value="date">Date</option>
											</select>
										</div>
                					</div><!-- End .toolbox-sort -->
                					<div class="toolbox-layout">
                						<a href="category-list.html" class="btn-layout">
                							<svg width="16" height="10">
                								<rect x="0" y="0" width="4" height="4" />
                								<rect x="6" y="0" width="10" height="4" />
                								<rect x="0" y="6" width="4" height="4" />
                								<rect x="6" y="6" width="10" height="4" />
                							</svg>
                						</a>

                						<a href="category-2cols.html" class="btn-layout">
                							<svg width="10" height="10">
                								<rect x="0" y="0" width="4" height="4" />
                								<rect x="6" y="0" width="4" height="4" />
                								<rect x="0" y="6" width="4" height="4" />
                								<rect x="6" y="6" width="4" height="4" />
                							</svg>
                						</a>

                						<a href="category.html" class="btn-layout">
                							<svg width="16" height="10">
                								<rect x="0" y="0" width="4" height="4" />
                								<rect x="6" y="0" width="4" height="4" />
                								<rect x="12" y="0" width="4" height="4" />
                								<rect x="0" y="6" width="4" height="4" />
                								<rect x="6" y="6" width="4" height="4" />
                								<rect x="12" y="6" width="4" height="4" />
                							</svg>
                						</a>

                						<a href="category-4cols.html" class="btn-layout active">
                							<svg width="22" height="10">
                								<rect x="0" y="0" width="4" height="4" />
                								<rect x="6" y="0" width="4" height="4" />
                								<rect x="12" y="0" width="4" height="4" />
                								<rect x="18" y="0" width="4" height="4" />
                								<rect x="0" y="6" width="4" height="4" />
                								<rect x="6" y="6" width="4" height="4" />
                								<rect x="12" y="6" width="4" height="4" />
                								<rect x="18" y="6" width="4" height="4" />
                							</svg>
                						</a>
                					</div><!-- End .toolbox-layout -->
                				</div><!-- End .toolbox-right -->
                			</div><!-- End .toolbox -->

                            <div class="products mb-3">
                                <div class="row justify-content-center">
                                    @foreach ($products as $product)
                                        <div class="col-6 col-md-4 col-lg-4 col-xl-3" wire:key="product-{{ $product->id }}">
                                            <livewire:product :product="$product" wire:key="product-{{ $product->id }}" ></livewire:product>
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
                			<div class="sidebar sidebar-shop">
                				<div class="widget widget-clean">
                					<label>Filters:</label>
                					<a href="#" class="sidebar-filter-clear">Clean All</a>
                				</div><!-- End .widget widget-clean -->

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
