<div class="footer-widgets container">
    <div class="row">
      <div class="col-md-4"><?php dynamic_sidebar('footer-left'); ?></div>
      <div class="col-md-4"><?php dynamic_sidebar('footer-center'); ?></div>
      <div class="col-md-4"><?php dynamic_sidebar('footer-right'); ?></div>
    </div>
</div>
<footer role="contentinfo">
  <div class="content-info container">
  <div class="row">
    <div class="col-lg-12">
      <?php dynamic_sidebar('sidebar-footer'); ?>
      <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
    </div>
  </div>
  </div>
</footer>

<?php wp_footer(); ?>
