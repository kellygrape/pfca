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
	<ul class="dpe-flexible-posts recent-posts-widget">
	<?php while( $flexible_posts->have_posts() ) : $flexible_posts->the_post(); global $post; ?>
		<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<?php
					if( $thumbnail == true ) {
						// If the post has a feature image, show it
						if( has_post_thumbnail() ) { ?>
						<a href="<?php echo the_permalink(); ?>">
						<?php the_post_thumbnail( $thumbsize ); ?>
						</a>
						<?php
						// Else if the post has a mime type that starts with "image/" then show the image directly.
						} elseif( 'image/' == substr( $post->post_mime_type, 0, 6 ) ) { ?>
						  <a href="<?php echo the_permalink(); ?>">
  						<?php echo wp_get_attachment_image( $post->ID, $thumbsize ); ?>
  						</a>
							<?php
						}
					}
				?>
				
				<h4 class="title"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<p class="byline"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="author"><?php echo get_the_author(); ?></a> / <time class="published" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(); ?></time>
</p>

			</a>
		</li>
	<?php endwhile; ?>
	</ul><!-- .dpe-flexible-posts -->
<?php else: // We have no posts ?>
	<div class="dpe-flexible-posts no-posts">
		<p><?php _e( 'No post found', 'flexible-posts-widget' ); ?></p>
	</div>
<?php	
endif; // End have_posts()
	
echo $after_widget;
