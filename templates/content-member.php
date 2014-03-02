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
        <?php $podcast = get_field('member_podcast'); ?>
        <li><strong>Podcast</strong> <a href="<?php echo get_permalink($podcast->ID) ?>"><?php echo get_the_title($podcast->ID);?></a></li>
        <?php if(get_field('member_title')): ?><li><strong>Title</strong> <?php the_field('member_title'); ?></li><?php endif; ?>
      </ul>
      <?php the_content(); ?>
      <h3>Member Links</h3>
      <?php if(get_field('member_twitter')): ?>
        <a class="zocial twitter" href="http://www.twitter.com/<?php the_field('member_twitter');?>">Twitter</a>
      <?php endif; ?>
      <?php if(get_field('member_facebook')): ?>
        <a class="zocial facebook" href="<?php the_field('member_facebook');?>">Facebook Link</a>
      <?php endif; ?>
      <?php if(get_field('member_email')): ?>
        <a class="zocial email" href="<?php the_field('member_email');?>">Email</a>
      <?php endif; ?>
    </div>
    <footer>
      <?php
        global $current_user;
        $current_user = get_currentuserinfo();
        if ($post->post_author == $current_user->ID): ?>
        <a class="btn btn-info" href="/member-edit-profile/"><i class="fa fa-pencil"></i> Submit a change for this profile</a>
      <?php endif; ?>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
