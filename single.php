<h1><?php echo get_post_type();?></h1>

<?php if ( 'pfca_podcast' == get_post_type() ): ?>
<?php get_template_part('templates/content', 'podcast'); ?>

<?php elseif ( 'pfca_member' == get_post_type() ): ?>
<?php get_template_part('templates/content', 'member'); ?>

<?php else: ?>
<?php get_template_part('templates/content', 'single'); ?>

<?php endif; ?>