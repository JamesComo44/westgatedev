<?php get_header(); ?>

<?php
  $args = array(
    'post_type' => 'wg_sermon',
    'order' => 'DESC',
    'posts_per_page' => -1
  );

  $series_query = new WP_Query( $args );

  $current_series = "";
  $prev_series = "";
?>

  <div id="content">
    <header class="hero">
      <img src="<?php bloginfo('template_directory'); ?>/assets/images/inner_hero.jpg" alt="">
      <h1 class="hero-message">Sermons</h1>
    </header>

    <div id="inner-content" class="row">
      <main class="medium-10 medium-offset-1 sermons-page-content">
        <?php if ( $series_query->have_posts() ) : while ( $series_query->have_posts() ) : $series_query->the_post(); ?>
          <?php
            $current_series = get_the_terms(get_the_ID(), 'series');
            $current_series = $current_series[0]->slug;
          ?>
          <?php if ($current_series !== $prev_series): ?>
            <div class="medium-3 columns sermon-page-column">
              <a href="<?php the_permalink() ?>">
                <?php the_post_thumbnail('full') ?>
              </a>
            </div>
          <?php endif ?>

          <?php  $prev_series = $current_series; ?>
        <?php endwhile; endif; ?>
      </main>
    </div><!-- end #inner-content -->

  </div> <!-- end #content -->

<?php get_footer(); ?>
