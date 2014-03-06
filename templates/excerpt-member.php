<article <?php post_class('member-excerpt'); ?>>
  <div class="media">
    <a class="pull-left" href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail(array(100,100),array('class' => 'media-object')); ?>
    </a>
    <div class="media-body">
      <h3 class="media-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <p>     
        <?php $podcast = get_field('member_podcast'); ?>
        <?php the_field('member_title'); ?>, <a href="<?php echo get_permalink($podcast->ID) ?>"><?php echo get_the_title($podcast->ID);?></a></p>
    </div>
  </div>
</article>