<?php
/*
Template Name: Board of Trustees Template
*/
?>

<?php get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates/content', 'page'); ?>
<?php
 
// check if the flexible content field has rows of data
if( have_rows('board_members') ):
 
     // loop through the rows of data
    while ( have_rows('board_members') ) : the_row();
 
        if( get_row_layout() == 'single_board_member' ):
        ?>
        <div class="row board-member">
        <div class="col-sm-12"><h2><span><?php the_sub_field('board_title'); ?></span></h2></div>
        <div class="col-sm-3">
          <?php 
          $attachment_id = get_sub_field('board_photo');
          $size = "medium"; // (thumbnail, medium, large, full or custom size)
           
          $image = wp_get_attachment_image_src( $attachment_id, $size );
          ?>
          <img src="<?php echo $image[0]; ?>" class="img-responsive" />
        </div>
        <div class="col-sm-9">
          <h3 class="board-member-name"><a href="<?php the_sub_field('board_name_link'); ?>"><?php the_sub_field('board_name'); ?></a></h3>
          <p class="member-podcast"><a href="<?php the_sub_field('board_podcast_link'); ?>"><?php the_sub_field('board_podcast'); ?></a></p>
          <p class="bot-email"><a href="<?php the_sub_field('board_email'); ?>"><i class="fa fa-envelope"></i> <?php the_sub_field('board_email'); ?></a></p>
        	<?php the_sub_field('position_responsibilities'); ?>
        

        </div>
        <?php
        endif;
 
    endwhile;
 
else :
 
    // no layouts found
 
endif;
 
?>
