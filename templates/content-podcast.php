<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class('podcast'); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content clearfix">
      <figure class="podcast-logo pull-right">
        <?php the_post_thumbnail(array(250,250)); ?>
      </figure>
      <p><?php the_field('podcast_tagline'); ?></p>
      <h3>Podcast Information</h3>
      <ul>
        <?php if(get_field('podcast_first_broadcast'): ?><li><strong>Year of First Broadcast</strong> <?php the_field('podcast_first_broadcast'); ?></li><?php endif; ?>
        <?php if(get_field('podcast_email'): ?><li><strong>Email Address</strong> <?php the_field('podcast_email'); ?></li><?php endif; ?>
      </ul>
      <h3>Podcast Links</h3>
      <?php if(get_field('podcast_itunes'): ?><a class="zocial itunes" href="<?php the_field('podcast_itunes');?>">iTunes Link</a><br /><?php endif; ?>
      <?php if(get_field('podcast_twitter'): ?><a class="zocial twitter" href="http://www.twitter.com/<?php the_field('podcast_twitter');?>">Twitter</a><br /><?php endif; ?>
      <?php if(get_field('podcast_facebook'): ?><a class="zocial facebook" href="<?php the_field('podcast_facebook');?>">Facebook Link</a><br /><?php endif; ?>
      <?php if(get_field('podcast_rss_feed'): ?><a class="zocial rss" href="<?php the_field('podcast_rss_feed');?>">RSS Feed</a><br /><?php endif; ?>
      <?php the_content(); ?>
      <?php $my_post_meta = get_post_meta($post->ID); 
            print_r($my_post_meta);
      ?>
    </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>