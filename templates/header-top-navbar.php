<header class="banner navbar navbar-inverse container" role="banner">
  <div class="row">
    <div class="logo col-sm-4">
    <a href="/"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/pfca-logo4-black.png"></a>
    </div>
    <div class="header-widget col-sm-8">
      <div class="col-md-4"><?php dynamic_sidebar('header-widget'); ?></div>
    </div>
  </div>
  <div class="navbar-area row">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand visible-xs" href="#">Menu</a>
    </div>

    <nav class="collapse navbar-collapse" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
        endif;
      ?>
    </nav>
  </div>
</header>
