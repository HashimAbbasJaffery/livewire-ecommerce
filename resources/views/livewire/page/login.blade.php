@section("title", "Login")
<main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('assets/images/backgrounds/login-bg.jpg')">
            	<div class="container">
            		<div class="form-box">
            			<div class="form-tab">
	            			<ul class="nav nav-pills nav-fill" role="tablist">
							</ul>
                            @if($error_message)
                                <p class="alert alert-danger rounded">{{ $error_message }}</p>
                            @endif
							<div class="tab-content">
							    <div class="tab-pane fade show active" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
							    	<form wire:submit.prevent="login">
							    		<div class="form-group">
							    			<label for="singin-email-2">Username or email address *</label>
                                            @error("email")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
							    			<input type="text" wire:model.blur="email" class="form-control @error('email') border border-danger @enderror" id="singin-email-2" name="singin-email" required>
							    		</div><!-- End .form-group -->

							    		<div class="form-group">
                                            <label for="singin-password-2">Password *</label>
                                            @error("password")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
							    			<input type="password" wire:model.blur="password" class="form-control @error('password') border border-danger @enderror" id="singin-password-2" name="singin-password" required>
							    		</div><!-- End .form-group -->

							    		<div class="form-footer">
							    			<button type="submit" class="btn btn-outline-primary-2">
			                					<span>LOG IN</span>
			            						<i class="icon-long-arrow-right"></i>
			                				</button>

			                				<div class="custom-control custom-checkbox">
												<input type="checkbox" wire:model="remember_me" class="custom-control-input" id="signin-remember-2">
												<label class="custom-control-label" for="signin-remember-2">Remember Me</label>
											</div><!-- End .custom-checkbox -->

											<!-- <a href="#" class="forgot-link">Forgot Your Password?</a> -->
							    		</div><!-- End .form-footer -->
							    	</form>
							    </div><!-- .End .tab-pane -->
							</div><!-- End .tab-content -->
						</div><!-- End .form-tab -->
            		</div><!-- End .form-box -->
            	</div><!-- End .container -->
            </div><!-- End .login-page section-bg -->
        </main><!-- End .main -->
