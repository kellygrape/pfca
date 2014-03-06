<?php
/**
 * Custom functions
 */

// *****************************************************
// Populate the select box for the member form
// with the current podcasts.
// *****************************************************
add_filter('frm_add_entry_meta', 'add_podcast_title');
function add_podcast_title($new_values) {
   if($new_values['field_id'] == 206) { // 776 is the Due Date field on the form - note that this field must have a value in it on form submit or this code will not work
		$daystoadd = '5 weekdays'; // 3 business days is our standard turnaround
    $new_values['meta_value'] = date( 'm/d/Y' , strtotime ( $daystoadd ));
   }
return $new_values;
}


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
    if($field->id == 169){ 
      $values['options']['none'] = "My podcast is not listed."; 
    }    
    foreach($posts as $p){
     $values['options'][$p->ID] = $p->post_title;
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
    if($_POST['item_meta'][$field_id] == 'none'){
      if($_POST['item_meta'][201] !== ''){
        $url = 'http://www.podcastingfilmcritics.org/podcast-registration?quickpost='.$_POST['item_meta'][201];
      }
      else{
        $url = 'http://www.podcastingfilmcritics.org/podcast-registration';
      }
    }  
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



// *****************************************************
// based on http://formidablepro.com/knowledgebase/frm_after_update_entry/
// Use this code to make sure two fields from two different forms always have the same value stored. For example, when a user updates their Email address in an “Edit Profile” form, then the email address stored in all of that user's entries in a second form will be automatically updated to match the new email address.
// *****************************************************
add_action('frm_after_update_entry', 'link_fields', 10, 2);
add_filter('frm_after_create_entry', 'link_fields', 50, 2);
function link_fields($entry_id, $form_id){
  if($form_id == 13) { // for the member form
    global $wpdb, $frmdb;
    if($_POST['item_meta'][169] !== 'none'){ // if the post meta is not 'none'
      $the_podcast_id = $_POST['item_meta'][169];
      $wpdb->insert($frmdb->entry_metas, array('meta_value' => get_the_title($the_podcast_id), 'item_id' => $entry_id, 'field_id' => 206, 'created_at' => date('Y-m-d h:i:s')));
    }
    if($_POST['item_meta'][206] == ''){ // if the post meta is not 'none'
      $the_podcast_id = $_POST['item_meta'][169];
      $wpdb->insert($frmdb->entry_metas, array('meta_value' => get_the_title($the_podcast_id), 'item_id' => $entry_id, 'field_id' => 206, 'created_at' => date('Y-m-d h:i:s')));
    }
  }
  if($form_id == 10){//Change 113 to the ID of the first form
    global $wpdb, $frmdb;
    $user = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM $frmdb->entries WHERE id=%d", $entry_id));
    
    // get the post ID of the podcast that was just selected
    $podcast_post_id = $wpdb->get_var($wpdb->prepare("SELECT post_id FROM $frmdb->entries WHERE id=%d", $entry_id));
    // get all the entries from the Member entries that the same person has created
    $entry_ids = $wpdb->get_col("Select id from $frmdb->entries where form_id='13' and user_id=". $user);
    // get the post ID of the MEMBER PROFILE that the entry created
    $post_to_update = $wpdb->get_col("Select post_id from $frmdb->entries where form_id='13' and user_id=". $user);
    foreach ($post_to_update as $pid){
      // get the post ID of the MEMBER PROFILE that the entry created
      update_field('field_530fb397c4ca2', $podcast_post_id, $pid);
    }
    foreach ($entry_ids as $e){
      $wpdb->insert($frmdb->entry_metas, array('meta_value' => get_the_title($podcast_post_id), 'item_id' => $e, 'field_id' => 206, 'created_at' => date('Y-m-d h:i:s')));
    }
  }
}

// *****************************************************
// http://formidablepro.com/help-desk/sending-email-notification-only-once-on-update-from-a-custom-display/
// *****************************************************

/* FORMIDABLE PRO EMAIL NOTIFICATION FROM CUSTOM FIELD UPDATE */

add_action('frm_after_update_field', 'frm_trigger_entry_update');
function frm_trigger_entry_update($atts){
  $entry = FrmEntry::getOne($atts['entry_id']);
  do_action('frm_after_update_entry', $entry->id, $entry->form_id);
}