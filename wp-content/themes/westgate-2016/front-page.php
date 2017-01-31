<?php get_header(); ?>
  <?php
    $feat_url_1 = rwmb_meta( 'wg_url1');
    $feat_img_1 = rwmb_meta( 'wg_img1', array('size=large'));
    foreach ( $feat_img_1 as $img ) {
      $feat_img_1 = $img;
    }
    $feat_url_2 = rwmb_meta( 'wg_url2');
    $feat_img_2 = rwmb_meta( 'wg_img2');
    foreach ( $feat_img_2 as $img ) {
      $feat_img_2 = $img;
    }

    $args = array(
      'post_type' => 'wg_sermon',
      'posts_per_page' => 1
    );

    $sermon_query = new WP_Query($args);
  ?>
  
  <div id="content">
    <div class="hero">
      <img src="<?php bloginfo('template_directory'); ?>/assets/images/home_hero.jpg" alt="">
      <h1 class="hero-message">Love God, Love People, Be Transparent</h1>
    </div>
    <div id="inner-content" class="row">
      <main id="main" role="main">

        <div class="triple-feature medium-10 medium-offset-1">
          <div class="medium-4 columns">
            <a href="<?php echo $feat_url_1 ?>">
              <img src="<?php echo $feat_img_1['full_url'] ?>">
            </a>
          </div>

          <div class="medium-4 columns">  
            <?php if ( $sermon_query->have_posts() ) : while ( $sermon_query->have_posts() )  : $sermon_query->the_post(); ?>
              <a href="<?php the_permalink(); ?>">
                <img class="series-banner" src="<?php bloginfo('template_directory'); ?>/assets/images/latest_series_banner.png" alt="">
                <?php the_post_thumbnail('full'); ?>
              </a>
            <?php endwhile; endif; ?>
          </div>

          <div class="medium-4 columns">
            <a href="<?php echo $feat_url_2 ?>">
              <img src="<?php echo $feat_img_2['full_url'] ?>">
            </a>
          </div>
        </div>

        <div class="double-feature medium-10 medium-offset-1">
          <div class="medium-6 columns">
            <div class="double-feature-section">
              <img src="<?php bloginfo('template_directory'); ?>/assets/images/pastors.jpg" alt="">
              <a href="/about/pastors/" class="btn btn-alt double-feature-btn">Meet the Pastors</a>
            </div>
          </div>
          <div class="medium-6 columns">
            <div class="double-feature-section">
              <img src="<?php bloginfo('template_directory'); ?>/assets/images/sermons.jpg" alt="">
              <a href="/sermons/" class="btn double-feature-btn">Listen to Past Sermons</a>
            </div>
          </div>
        </div>
                    
      </main> <!-- end #main -->
        
    </div> <!-- end #inner-content -->

  </div> <!-- end #content -->

<?php get_footer(); ?>