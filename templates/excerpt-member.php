<article <?php post_class('member-excerpt'); ?>>
  <div class="media">
    <a class="pull-left" href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail(array(100,100),array('class' => 'media-object')); ?>
    </a>
    <div class="media-body">
      <h3 class="media-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <?php the_content(); ?>
    </div>
  </div>
</article>