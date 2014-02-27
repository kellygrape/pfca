<?php if ( 'podcast' == get_post_type() ): ?>
<?php get_template_part('templates/content', 'podcast'); ?>

<?php elseif ( 'member' == get_post_type() ):: ?>
<?php get_template_part('templates/content', 'podcast'); ?>

<?php else: ?>
<?php get_template_part('templates/content', 'single'); ?>

<?php endif; ?>