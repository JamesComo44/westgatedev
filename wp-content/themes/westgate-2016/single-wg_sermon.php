<?php get_header(); ?>

  <div id="content">
    <header class="hero">
      <img src="<?php bloginfo('template_directory'); ?>/assets/images/inner_hero.jpg" alt="">
      <h1 class="hero-message"><?php echo get_the_title(get_the_id()); ?></h1>
    </header>

    <div id="inner-content" class="row">

        <main id="main" role="main" class="medium-12">
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="medium-7 columns sermon-content">
                  <?php get_template_part( 'parts/loop', 'sermon' ); ?>
            </div>
            <div class="medium-5 columns sermon-sidebar">
              <aside class="current-series">
                <?php
                  $tax = wg_first_term( 'series', false, $post->ID );
                  $slug = $tax->slug;
                  $current_sermon = get_the_id();

                  $args = array(
                    'post_type' => 'wg_sermon',
                    'order' => 'ASC',
                    'tax_query' => array(
                      array(
                        'taxonomy' => 'series',
                        'field'    => 'slug',
                        'terms'    => $slug,
                      ),
                    )
                  );

                  $series_query = new WP_Query( $args );
                  $series_description = term_description( $tax->term_id, 'series' );
                ?>

                <header>
                  <h3 class="current-series-heading">Currently listening to this series:</h3>
                  <?php if (rwmb_meta( 'wg_override_series_img' ) && has_post_thumbnail()) : ?>
                    <?php echo the_post_thumbnail('full'); ?>
                  <?php elseif ($tax->term_image) : ?>
                    <?php echo wp_get_attachment_image($tax->term_image, 'full'); ?>
                  <?php elseif (has_post_thumbnail()) : ?>
                    <?php echo the_post_thumbnail('full'); ?>
                  <?php else : ?>
                    <h4 class="current-series-head-text-fallback"><?php echo $tax->name; ?></h4>
                  <?php endif; ?>
                </header>

                <?php if ( $series_query->have_posts() && ! empty( $series_description ) ): ?>
                  <div class="current-series-description"><?php echo $series_description; ?></div>
                <?php endif; ?>

                <ol class="related-sermons-list">
                  <?php while ( $series_query->have_posts() ) :  $series_query->the_post(); ?>

                      <?php
                        if ($current_sermon === get_the_id()) {
                           $extra_class=" currently-playing";
                         } else {
                          $extra_class="";
                         }
                      ?>

                      <li class="related-sermons-item<?php echo $extra_class ?>">
                        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                      </li>

                  <?php endwhile; ?>
                </ol>

                <a href="/sermons/" class="btn more-series-btn">More Series</a>
              </aside>
            </div>
        <?php endwhile; endif; ?>
      </main> <!-- end #main -->

    </div> <!-- end #inner-content -->

  </div> <!-- end #content -->

<?php get_footer(); ?>
