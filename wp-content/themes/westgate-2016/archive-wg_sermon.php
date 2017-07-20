<?php get_header(); ?>

<?php
  // Callback function for PHP usort, used to sort sermons by their post_date
  function wg_sort_sermons_by_date( $a, $b ) {
    return strtotime( $b['post_date'] ) - strtotime( $a['post_date'] );
  }

  $args = array(
    'taxonomy'   => 'series',
    'order_by'   => 'term_id',
    'order'      => 'ASC',
    'hide_empty' => true,
  );

  // An array list of all our sermon series taxonomy terms
  $series_query = get_terms( $args );

  // Stores series & sermon meta data needed to format archive page
  $series_data = array();

  // Loop though each series and get the latest (by date) sermon post
  if ( $series_query ) {
    $args = array(
      'post_type'              => 'wg_sermon',
      'nopaging'               => false,
      'posts_per_page'         => 1,
      'order'                  => 'DESC',
      'orderby'                => 'date',
      'cache_results'          => false,
      'update_post_meta_cache' => false,
      'update_post_term_cache' => false,
      'tax_query'              => array(
          array(
              'taxonomy'         => 'series',
              'field'            => 'term_id',
              'terms'            => '',
              'include_children' => false,
          ),
      ),
    );

    foreach ( $series_query as $series )
    {
      $args['tax_query'][0]['terms'] = $series->term_id;

      $sermon_query = new WP_Query( $args );

      $series_data[] = array(
          'name'      => $series->name,
          'term_id'   => $series->term_id,
          'image_id'  => $series->term_image,
          'post_id'   => $sermon_query->posts[0]->ID,
          'post_date' => $sermon_query->posts[0]->post_date,
      );
    }

    // Sort the data to be ordered by sermon date using PHP usort
    usort( $series_data, 'wg_sort_sermons_by_date' );
  }
?>

  <div id="content">
    <header class="hero">
      <img src="<?php bloginfo('template_directory'); ?>/assets/images/inner_hero.jpg" alt="">
      <h1 class="hero-message sermons-archive">Sermons</h1>
      <p class="hero-description">Check out our archive of Westgate Church sermon series by Pastor Dwayne Terry and other speakers centered on different topics of God’s calling for our lives.</p>
    </header>

    <div id="inner-content" class="row">
      <main class="medium-10 medium-offset-1 sermons-page-content">
        <?php if ( $series_data ) : foreach( $series_data as $series ) : ?>
          <div class="medium-3 columns sermon-page-column">
            <a href="<?php echo get_permalink( $series['post_id'] ); ?>">
              <?php if ( ! empty( $series['image_id'] ) ) : ?>
                <?php echo wp_get_attachment_image( $series['image_id'], 'full' ); ?>
              <?php else : ?>
                <span class="series-placeholder-name"><?php echo $series['name']; ?></span>
                <img src="<?php bloginfo('template_directory'); ?>/assets/images/sermon_placeholder.jpg" alt="">
              <?php endif; ?>
            </a>
          </div>
        <?php endforeach; endif; ?>
      </main>
    </div><!-- end #inner-content -->

  </div> <!-- end #content -->

<?php get_footer(); ?>
