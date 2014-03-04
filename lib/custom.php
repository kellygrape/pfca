<?php
/**
 * Custom functions
 */
// Register Custom Post Type
function pfca_member() {

	$labels = array(
		'name'                => _x( 'Members', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Member', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Member', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All Items', 'text_domain' ),
		'view_item'           => __( 'View Item', 'text_domain' ),
		'add_new_item'        => __( 'Add New Item', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Item', 'text_domain' ),
		'update_item'         => __( 'Update Item', 'text_domain' ),
		'search_items'        => __( 'Search Item', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
    $rewrite = array(
		'slug'                => 'member',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'pfca_member', 'text_domain' ),
		'description'         => __( 'Voting members of the website.', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
        'rewrite'             => $rewrite,
	);
	register_post_type( 'pfca_member', $args );

}

// Hook into the 'init' action
add_action( 'init', 'pfca_member', 0 );

// Register Custom Post Type
function pfca_podcast() {

	$labels = array(
		'name'                => _x( 'Podcast', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Podcast', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Podcast', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All Items', 'text_domain' ),
		'view_item'           => __( 'View Item', 'text_domain' ),
		'add_new_item'        => __( 'Add New Item', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Item', 'text_domain' ),
		'update_item'         => __( 'Update Item', 'text_domain' ),
		'search_items'        => __( 'Search Item', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
    $rewrite = array(
		'slug'                => 'podcast',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'pfca_podcast', 'text_domain' ),
		'description'         => __( 'Podcasts that the members belong to', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
        'rewrite'             => $rewrite
	);
	register_post_type( 'pfca_podcast', $args );

}

// Hook into the 'init' action
add_action( 'init', 'pfca_podcast', 0 );




add_filter('frm_setup_new_fields_vars', 'frm_populate_posts', 20, 2);
add_filter('frm_setup_edit_fields_vars', 'frm_populate_posts', 20, 2); //use this function on edit too
function frm_populate_posts($values, $field){
if($field->id == 121 || $field->id == 123 || $field->id == 169){ //replace 125 with the ID of the field to populate
   $posts = get_posts( array('post_type' => 'pfca_podcast', 'post_status' => 'any', 'numberposts' => 999, 'orderby' => 'title', 'order' => 'ASC'));
   unset($values['options']);
   $values['options'] = array(''); //remove this line if you are using a checkbox or radio button field
   foreach($posts as $p){
     $values['options'][$p->ID] = $p->post_title;
   }
   if($field->id == 169){ $values['options']['none'] = "My podcast is not listed."; }
   $values['use_key'] = true; //this will set the field to save the post ID instead of post title
}
return $values;
}

// Create a redirect for the form based on if the user has selected "Podcast not listed"
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


add_action( 'personal_options', array ( 'pfca_hide_user_info_things', 'start' ) );

/**
 * Captures the part with the biobox in an output buffer and removes it.
 *
 * @author Thomas Scholz, <info@toscho.de>
 *
 */
class pfca_hide_user_info_things
{
    /**
     * Called on 'personal_options'.
     *
     * @return void
     */
    public static function start()
    {
        $action = ( IS_PROFILE_PAGE ? 'show' : 'edit' ) . '_user_profile';
        add_action( $action, array ( __CLASS__, 'stop' ) );
        ob_start();
    }

    /**
     * Strips the bio box from the buffered content.
     *
     * @return void
     */
    public static function stop()
    {
        $html = ob_get_contents();
        ob_end_clean();

        // remove the headline
        $headline = __( IS_PROFILE_PAGE ? 'About Yourself' : 'About the user' );
        $html = str_replace( '<h3>' . $headline . '</h3>', '', $html );

        // remove the table row
        $html = preg_replace( '~<tr>\s*<th><label for="description".*</tr>~imsUu', '', $html );
        print $html;
    }
}


/**
 * Redirects admin to the dashboard and others to the homepage
 *
 * @return void
 */
function my_login_redirect( $redirect_to, $request, $user ){
    //is there a user to check?
    global $user;
    if( isset( $user->roles ) && is_array( $user->roles ) ) {
        //check for admins
        if( in_array( "administrator", $user->roles ) ) {
            // redirect them to the default place
            return $redirect_to;
        } else {
            return home_url();
        }
    }
    else {
        return $redirect_to;
    }
}
add_filter("login_redirect", "my_login_redirect", 10, 3);