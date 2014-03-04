<?php get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates/content', 'page'); ?>


<?php
 global $post;
 $myposts = get_posts('numberposts=10');
 foreach($myposts as $post) :
 ?>
 <?php get_template_part('templates', 'content'); ?>

 <?php endforeach; ?>