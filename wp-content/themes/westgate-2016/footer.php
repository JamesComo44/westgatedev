					<footer class="footer" role="contentinfo">
						<?php /* if ( false ): // originally (is_home() || is_front_page()) ?>
							<?php $inner_footer_class = "" ?>
						<?php elseif (false):  // originally just else ?>
							<?php $inner_footer_class = " has-connect-bar" ?>
							<aside class="stay-connected">
								<h2>Stay Connected and Informed</h2>
							</aside>
						<?php endif; */ ?>
						<div id="inner-footer">
							<div class="footer-widgets">
								<div class="row">
									<div class="medium-10 medium-offset-1">
										<div class="medium-6 columns">
											<aside class="medium-6 columns">
												<address class="church-address">
													<strong>Westgate Church</strong><br>
													(678) 310-7141 <br>
													4010 Fambrough Dr. <br>
													Powder Springs, GA 30127 <br>
												</address>
												<a href="https://goo.gl/maps/2S29NcWtgVG2">Get Driving Directions</a>

												<h2 class="service-time">SUNDAYS at 10:30</h2>
											</aside>
											<aside class="medium-6 columns">
												<h2 class="footer-social-title">Follow Us</h2>
												<a class="footer-social-icon" href="https://www.facebook.com/mywgc" target="_blank">
													<img src="<?php bloginfo('template_directory'); ?>/assets/images/facebook.png" alt="Find us on Facebook">
												</a>
												<a class="footer-social-icon" href="https://twitter.com/westgate_church" target="_blank">
													<img src="<?php bloginfo('template_directory'); ?>/assets/images/twitter.png" alt="Follow us on Twitter">
												</a>
												<a class="footer-social-icon" href="mailto:admin@westgate.church">
													<img src="<?php bloginfo('template_directory'); ?>/assets/images/email.png" alt="Email us">
												</a>
											</aside>
										</div>
										<div class="medium-6 columns medium-collapse">
											<div class="medium-6 columns footer-feature-one">
												<a href="/kids/">
													<img src="<?php bloginfo('template_directory'); ?>/assets/images/kids.jpg" alt="">
												</a>
											</div>

											<div class="medium-6 columns footer-feature-two">
												<a href="/students/">
													<img src="<?php bloginfo('template_directory'); ?>/assets/images/pulse.jpg" alt="">
												</a>
											</div>
										</div>
									</div>
								</div>
							</div> <!-- end .footer-widgets -->
							<div class="row">
								<div class="medium-10 medium-offset-1 columns">
									<nav role="navigation">
										<?php joints_footer_links(); ?>
									</nav>
									<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</p>
								</div>
							</div>
						</div> <!-- end #inner-footer -->
					</footer> <!-- end .footer -->
				</div>  <!-- end .main-content -->
			</div> <!-- end .off-canvas-wrapper-inner -->
		</div> <!-- end .off-canvas-wrapper -->
		<?php wp_footer(); ?>
	</body>
</html> <!-- end page -->
