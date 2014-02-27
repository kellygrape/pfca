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
        <li><strong>Year of First Broadcast</strong></li>
        <li><strong>Email Address</strong></li>
      </ul>
      <h3>Podcast Links</h3>
      <a class="zocial itunes" href="<?php the_field('podcast_itunes');?>">iTunes Link</a>
      <a class="zocial twitter" href="http://www.twitter.com/<?php the_field('podcast_twitter');?>">Twitter</a>
      <a class="zocial facebook" href="<?php the_field('podcast_facebook');?>">Facebook Link</a>
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
