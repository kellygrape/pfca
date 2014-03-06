<article <?php post_class('member-excerpt'); ?>>
  <div class="media">
    <?php $podcast = get_post_meta( get_the_ID(), 'member_podcast', true ); ?>
    <a class="pull-left" href="<?php the_permalink(); ?>">
      <?php echo get_the_post_thumbnail($podcast, array(100,100),array('class' => 'media-object')); ?>
    </a>
    <div class="media-body">
      <h3 class="media-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <p>     
        <?php the_field('member_title'); ?>, <a href="<?php echo get_permalink($podcast) ?>"><?php echo get_the_title($podcast);?></a></p>
    </div>
  </div>
</article>