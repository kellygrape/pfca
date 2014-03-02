<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class('podcast'); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content clearfix">
      <figure class="podcast-logo pull-right">
        <?php if(get_field('podcast_website')): ?><a href="<?php the_field('podcast_website'); ?>"><?php endif; ?>
        <?php the_post_thumbnail(array(250,250)); ?>
        <?php if(get_field('podcast_website')): ?></a><?php endif; ?>
      </figure>
      <?php the_content(); ?>
      <h3>Podcast Information</h3>
      <ul>
        <?php if(get_field('podcast_website')): ?><li><a href="<?php the_field('podcast_website'); ?>"><i class="fa fa-globe"></i> <?php the_field('podcast_website'); ?></a></li><?php endif; ?>
        <?php if(get_field('podcast_email')): ?><li><a href="<?php the_field('podcast_email');?>"><i class="fa fa-envelope"></i><?php the_field('podcast_email'); ?></a></li><?php endif; ?>
        <?php if(get_field('podcast_first_broadcast')): ?><li><strong>Year of First Broadcast:</strong> <?php the_field('podcast_first_broadcast'); ?></li><?php endif; ?>
      </ul>
      <h3>Podcast Links</h3>
      <div class="podcast-social-icons">
      <?php if(get_field('podcast_twitter')): ?><a class="zocial twitter icon" href="http://www.twitter.com/<?php the_field('podcast_twitter');?>">Twitter</a><?php endif; ?>
      <?php if(get_field('podcast_facebook')): ?><a class="zocial facebook icon" href="<?php the_field('podcast_facebook');?>">Facebook Link</a><?php endif; ?>
      <?php if(get_field('podcast_itunes')): ?><a class="zocial itunes icon" href="<?php the_field('podcast_itunes');?>">iTunes Link</a><?php endif; ?>
      <?php if(get_field('podcast_rss_feed')): ?><a class="zocial rss icon" href="<?php the_field('podcast_rss_feed');?>">RSS Feed</a><?php endif; ?>
      </div>
      <h3>Podcast Members of PFCA</h3>
      <ul class="member_list">
      <?php $args = array(
              'post_type' => 'pfca_member',
              'meta_query'		=> array(
                  array(
                      'key' => 'member_podcast',
                      'value' =>  get_the_ID(),
                      'compare' => 'LIKE'
                      )
                )
            );
            
            $postslist = get_posts( $args );
            foreach($postslist as $member){
              ?><li><a href="<?php echo get_permalink($member->ID) ?>"><?php echo get_the_title($member->ID);?></a></li><?php
            }
      ?>
      </ul>
    </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
