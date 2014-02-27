<header class="banner container" role="banner">
  <div class="row">
    <div class="col-lg-12">
      <nav role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
        endif;
      ?>
      </nav>
    </div>
  </div>
</header>
