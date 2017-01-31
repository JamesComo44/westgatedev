<!-- By default, this menu will use off-canvas for small
	 and a topbar for medium-up -->

<div class="row top-bar-menu mediu" id="top-bar-menu">
	<div class="container">
		<div class="large-10 large-offset-1">
			<div class="large-3 columns top-bar-left">
				<ul class="menu">
					<li class="logo-list-item">
						<a class="logo" href="<?php echo home_url(); ?>">
							<img src="<?php bloginfo('template_directory'); ?>/assets/images/wg_logo.jpg" alt="<?php bloginfo('name'); ?>">
						</a>
					</li>
				</ul>
			</div>
			<div class="top-bar-right large-9 columns show-for-medium">
				<?php joints_top_nav(); ?>	
			</div>
			<div class="show-for-small-only">
				<ul class="mobile-menu">
					<!-- <li><button class="menu-icon" type="button" data-toggle="off-canvas"></button></li> -->
					<li><a class="mobile-menu-button" href="#" data-toggle="off-canvas"><?php _e( 'Menu', 'jointswp' ); ?></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>