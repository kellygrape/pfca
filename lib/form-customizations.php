<?php
/**
 * Custom functions
 */

// *****************************************************
// Populate the select box for the member form
// with the current podcasts.
// *****************************************************

add_filter('frm_setup_new_fields_vars', 'frm_populate_posts', 20, 2);
add_filter('frm_setup_edit_fields_vars', 'frm_populate_posts', 20, 2); //use this function on edit too
function frm_populate_posts($values, $field){
  if($field->id == 121 || $field->id == 123 || $field->id == 169){ 
    $posts = get_posts( array(
      'post_type' => 'pfca_podcast', 
      'post_status' => 'any', 
      'numberposts' => 999, 
      'orderby' => 'title', 
      'order' => 'ASC'
    ));
    unset($values['options']);
    $values['options'] = array(''); //remove this line if you are using a checkbox or radio button field
    foreach($posts as $p){
     $values['options'][$p->ID] = $p->post_title;
    }
    if($field->id == 169){ 
      $values['options']['none'] = "My podcast is not listed."; 
    }
    $values['use_key'] = true; //this will set the field to save the post ID instead of post title
  }
  return $values;
}


// *****************************************************
// Create a redirect for the form 
// based on if the user has selected "Podcast not listed"
// *****************************************************

add_filter('frm_redirect_url', 'pfca_member_return_page', 9, 3);
function pfca_member_return_page($url, $form, $params){
  if($form->id == 13){ //change 5 to the ID of the form to redirect
    $field_id = 169; //change 125 the the ID of the radio or dropdown field
    if($_POST['item_meta'][$field_id] == 'none') 
      $url = 'http://www.podcastingfilmcritics.org/podcast-registration';
    else
      $url = 'http://www.podcastingfilmcritics.org/member-next-steps';
  }
  return $url;
}


// *****************************************************
// Use the combined First and Last names as the post title
// *****************************************************
add_filter('frm_validate_field_entry', 'my_custom_validation', 8, 3);
function my_custom_validation($errors, $posted_field, $posted_value){
  if($posted_field->id == 177){
    $_POST['item_meta'][177] = $_POST['item_meta'][176] .' '. $_POST['item_meta'][153];
    $_POST['frm_wp_post']['177=post_title'] = $_POST['item_meta'][177];
  }
  return $errors;
}