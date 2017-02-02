<div id="post-not-found" class="hentry">

	<?php if ( is_search() ) : ?>

		<header class="article-header">
			<h2><?php _e( 'Sorry, No Results Found.', 'jointswp' );?></h2>
		</header>

		<section class="entry-content">
			<p><?php _e( 'Try your search again.', 'jointswp' );?></p>
		</section>

		<section class="search">
		    <p><?php get_search_form(); ?></p>
		</section> <!-- end search section -->

	<?php else: ?>

		<header class="article-header">
			<h2><?php _e( '404 - Page Not Found', 'jointswp' ); ?></h2>
		</header>

		<section class="entry-content">
			<p><?php _e( 'The page you were looking for was not found.', 'jointswp' ); ?></p>
		</section>

		<section class="search">
		    <p><?php get_search_form(); ?></p>
		</section> <!-- end search section -->

	<?php endif; ?>

</div>
