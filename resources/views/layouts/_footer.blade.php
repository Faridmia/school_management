<footer class="footer footer-dark">
	<div class="footer-newsletter" style="background-color: #2b2b2b; border-bottom: 1px solid #3d3d3d; padding: 4rem 0;">
		<div class="container text-center">
			<div class="heading text-center mb-3">
				<h3 class="title" style="color: #fff; font-weight: 600; margin-bottom: 0.5rem; font-size: 2.2rem;">Get The Latest Deals</h3>
				<p class="title-desc" style="color: #ccc; font-size: 1.4rem; margin-bottom: 2rem;">Subscribe to our newsletter to receive timely updates and promotions.</p>
			</div>

			<div class="row justify-content-center">
				<div class="col-sm-10 col-md-8 col-lg-6">
					<form id="newsletter-form" action="{{ route('subscribe') }}" method="POST">
						@csrf
						<div class="input-group input-group-round">
							<input name="email" type="email" class="form-control" placeholder="Enter your Email Address" aria-label="Email Address" required style="background: #fff; color: #333; border: none; font-size: 1.4rem; height: 46px; border-radius: 30px 0 0 30px; padding-left: 20px;">
							<div class="input-group-append">
								<button class="btn btn-primary" type="submit" style="min-width: 120px; background: #c96; border-color: #c96; color: #fff; border-radius: 0 30px 30px 0; font-size: 1.4rem; text-transform: uppercase; font-weight: 600;">Subscribe</button>
							</div>
						</div>
						<div id="newsletter-message" class="text-center mt-3" style="font-size: 1.4rem; display: none; font-weight: 500;"></div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="footer-middle">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-3">
					<div class="widget widget-about">
						<img src="{{ $systemSettings->getLogoUrl() }}" class="footer-logo" alt="{{ $systemSettings->website_name ?? 'Molla' }} Logo" width="105" height="25" style="filter: brightness(0) invert(1);">
						<p>{{ $systemSettings->footer_description ?? 'Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, eu vulputate magna eros eu erat.' }}</p>

						<div class="social-icons">
							@if(!empty($systemSettings->facebook_link))
								<a href="{{ $systemSettings->facebook_link }}" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
							@endif
							@if(!empty($systemSettings->twitter_link))
								<a href="{{ $systemSettings->twitter_link }}" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
							@endif
							@if(!empty($systemSettings->instagram_link))
								<a href="{{ $systemSettings->instagram_link }}" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
							@endif
							@if(!empty($systemSettings->youtube_link))
								<a href="{{ $systemSettings->youtube_link }}" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
							@endif
							@if(!empty($systemSettings->pinterest_link))
								<a href="{{ $systemSettings->pinterest_link }}" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
							@endif
						</div><!-- End .soial-icons -->
					</div><!-- End .widget about-widget -->
				</div><!-- End .col-sm-6 col-lg-3 -->

				<div class="col-sm-6 col-lg-3">
					<div class="widget">
						<h4 class="widget-title">Useful Links</h4><!-- End .widget-title -->

						<ul class="widget-list">
							<li><a href="{{ route('about') }}">About Molla</a></li>
							<li><a href="{{ route('terms') }}">How to shop on Molla</a></li>
							<li><a href="{{ route('contact') }}">FAQ</a></li>
							<li><a href="{{ route('contact') }}">Contact us</a></li>
							<li><a href="#signin-modal" data-toggle="modal">Log in</a></li>
						</ul><!-- End .widget-list -->
					</div><!-- End .widget -->
				</div><!-- End .col-sm-6 col-lg-3 -->

				<div class="col-sm-6 col-lg-3">
					<div class="widget">
						<h4 class="widget-title">Customer Service</h4><!-- End .widget-title -->

						<ul class="widget-list">
							<li><a href="{{ route('terms') }}">Payment Methods</a></li>
							<li><a href="{{ route('terms') }}">Money-back guarantee!</a></li>
							<li><a href="{{ route('user.dashboard') }}#tab-orders">Returns</a></li>
							<li><a href="{{ route('terms') }}">Shipping</a></li>
							<li><a href="{{ route('terms') }}">Terms and conditions</a></li>
							<li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
						</ul><!-- End .widget-list -->
					</div><!-- End .widget -->
				</div><!-- End .col-sm-6 col-lg-3 -->

				
				<div class="col-sm-6 col-lg-3">
					<div class="widget">
						<h4 class="widget-title">My Account</h4><!-- End .widget-title -->

						<ul class="widget-list">
							<li><a href="#signin-modal" data-toggle="modal">Sign In</a></li>
							<li><a href="{{ route('cart') }}">View Cart</a></li>
							<li><a href="{{ route('wishlist') }}">My Wishlist</a></li>
							<li><a href="{{ route('order.tracking') }}">Track My Order</a></li>
							<li><a href="#">Help</a></li>
						</ul><!-- End .widget-list -->
					</div><!-- End .widget -->
				</div><!-- End .col-sm-6 col-lg-3 -->
			</div><!-- End .row -->
		</div><!-- End .container -->
	</div><!-- End .footer-middle -->

	<div class="footer-bottom">
		<div class="container">
			<p class="footer-copyright">Copyright © {{ date('Y') }} {{ $systemSettings->website_name ?? 'Molla' }} Store. All Rights Reserved.</p><!-- End .footer-copyright -->
			<figure class="footer-payments">
				<img src="{{ $systemSettings->getPaymentIconUrl() }}" alt="Payment methods" width="272" height="20">
			</figure><!-- End .footer-payments -->
		</div><!-- End .container -->
	</div><!-- End .footer-bottom -->
</footer><!-- End .footer -->