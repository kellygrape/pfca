<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php
    do_action('get_header');
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
      get_template_part('templates/header-top-navbar');
    } else {
      get_template_part('templates/header');
    }
  ?>

  <div class="wrap container" role="document">
    <div class="content row">
      <main class="main <?php echo roots_main_class(); ?>" role="main">
        <?php include roots_template_path(); ?>
        <h3>Posts</h3>
        <?php 
        // the query
        $the_query = new WP_Query( array('post_type' => 'post') ); ?>
        
        <?php if ( $the_query->have_posts() ) : ?>
        
          <!-- pagination here -->
        
          <!-- the loop -->
          <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <h2><?php the_title(); ?></h2>
          <?php endwhile; ?>
          <!-- end of the loop -->
          <?php if ($wp_query->max_num_pages > 1) : ?>
            <nav class="post-nav">
              <ul class="pager">
                <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
                <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
              </ul>
            </nav>
          <?php endif; ?>
        
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>
        
        
      </main><!-- /.main -->
      <?php if (roots_display_sidebar()) : ?>
        <aside class="sidebar <?php echo roots_sidebar_class(); ?>" role="complementary">
          <?php include roots_sidebar_path(); ?>
        </aside><!-- /.sidebar -->
      <?php endif; ?>
    </div><!-- /.content -->
  </div><!-- /.wrap -->

  <?php get_template_part('templates/footer'); ?>

</body>
</html>
