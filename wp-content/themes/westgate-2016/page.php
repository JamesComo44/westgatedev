<?php get_header(); ?>

	<div id="content">
		<header class="hero">
	    <img src="<?php bloginfo('template_directory'); ?>/assets/images/inner_hero.jpg" alt="">
	    <h1 class="hero-message"><?php echo get_the_title(get_the_id()); ?></h1>
	  </header>

		<div id="inner-content" class="row">
			<div class="medium-10 medium-offset-1">
		    <main id="main" role="main" class="medium-12 columns main-page-content">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			    	<?php get_template_part( 'parts/loop', 'page' ); ?>

			    <?php endwhile; endif; ?>

			</main> <!-- end #main -->
		</div>

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
