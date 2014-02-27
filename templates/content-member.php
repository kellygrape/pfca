<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class('member'); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content clearfix">
      <figure class="podcast-logo pull-right">
        <?php the_post_thumbnail(array(250,250)); ?>
      </figure>
      <p><?php the_field('podcast_tagline'); ?></p>
      <h3>Member Information</h3>
      <ul>
        <?php if(get_field('member_journalism_alias')): ?><li><strong>Journalism Alias</strong> <?php the_field('member_journalism_alias'); ?></li><?php endif; ?>
        <li><strong>Podcast</strong> ________</li>
        <?php if(get_field('member_title')): ?><li><strong>Title</strong> <?php the_field('member_title'); ?></li><?php endif; ?>
      </ul>
      <h3>Member Links</h3>
      <?php if(get_field('member_twitter')): ?>
        <a class="zocial twitter" href="http://www.twitter.com/<?php the_field('member_twitter');?>">Twitter</a>
      <?php endif; ?>
      <?php if(get_field('member_facebook')): ?>
        <a class="zocial facebook" href="<?php the_field('member_facebook');?>">Facebook Link</a>
      <?php endif; ?>
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
