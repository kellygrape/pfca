<?php if ( 'pfca_podcast' == get_post_type() ): ?>
<h1>Podcast!</h1>
<?php get_template_part('templates/content', 'podcast'); ?>

<?php elseif ( 'pfca_member' == get_post_type() ): ?>
<h1>Member!</h1>
<?php get_template_part('templates/content', 'member'); ?>

<?php else: ?>
<h1>Single</h1>
<?php get_template_part('templates/content', 'single'); ?>

<?php endif; ?>