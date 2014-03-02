<?php
/**
 * Flexible Posts Widget: Default widget template
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

echo $before_widget;

if ( !empty($title) )
	echo $before_title . $title . $after_title;

if( $flexible_posts->have_posts() ):
?>
<ul class="media-list dpe-flexible-posts widget-podcasts">
  <?php while( $flexible_posts->have_posts() ) : $flexible_posts->the_post(); global $post; ?>
  <li id="post-<?php the_ID(); ?>" <?php post_class('media'); ?>>
    <?php if( $thumbnail == true ): if( has_post_thumbnail() ): ?>
    <a class="pull-left" href="<?php echo the_permalink(); ?>">
      <?php the_post_thumbnail('widget-thumb',array('class' => 'media-object'));?>
    </a>
    <?php endif; endif; ?>
    <div class="media-body">
      <h4 class="media-heading"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h4>
    </div>
  </li>
  <?php endwhile; ?>
</ul>
<?php else: // We have no posts ?>
	<div class="dpe-flexible-posts no-posts">
		<p><?php _e( 'No post found', 'flexible-posts-widget' ); ?></p>
	</div>
<?php	
endif; // End have_posts()
	
echo $after_widget;
