<?php
  add_action('init', 'partners_register');
  function partners_register() {
    $labels = array( 'name' => _x('CODE2040 Partners', 'post type general name'),
      'singular_name' => _x('Partner', 'post type singular name'),
      'add_new' => _x('Add New', 'partner'),
      'add_new_item' => __('Add New Partner'),
      'edit_item' => __('Edit Partner'),
      'new_item' => __('New Partner'),
      'view_item' => __('View Partner'),
      'search_items' => __('Search Partners'),
      'not_found' => __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in Trash'),
      'parent_item_colon' => '' );

    $args = array( 'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'query_var' => true,
      'menu_icon' => get_stylesheet_directory_uri() . '/icons/users.png',
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'menu_position' => null,
      'supports' => array('title','editor','thumbnail') );

    register_post_type( 'partners' , $args );

	register_taxonomy('involvements', 'partners', array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Involvement Levels', 'taxonomy general name' ),
			'singular_name' => _x( 'Involvement Level', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Involvements' ),
			'all_items' => __( 'All Involvements' ),
			'parent_item' => __( 'Parent Involvement' ),
			'parent_item_colon' => __( 'Parent Involvement:' ),
			'edit_item' => __( 'Edit Involvement' ),
			'update_item' => __( 'Update Involvement' ),
			'add_new_item' => __( 'Add New Involvement' ),
			'new_item_name' => __( 'New Involvement Name' ),
			'menu_name' => __( 'Involvement' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'involvements', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));

  //  register_taxonomy("involvements", array("partners"), array("label" => "Involvements (supporter, host or colleague)", "singular_label" => "Involvement", "rewrite" => true));
  }

  function partners_url() {
    global $post;

    $custom = get_post_custom($post->ID);
    $partners_url = $custom["partners_url"][0];

    echo '<label>URL: </label>';
    echo '<input name="partners_url" value="' . $partners_url . '" />';
  }


  add_action( 'admin_init', 'admin_init_partners' );
  function admin_init_partners() {
    add_meta_box("partners-url-meta", "URL", "partners_url", "partners", "side", "low");
  }


  add_filter("manage_edit-partners_columns", "partners_edit_columns");
  function partners_edit_columns($columns) {
    $columns = array(
      "cb" => '<input type="checkbox" />',
      "title" => "Name",
      "description" => "Description",
      "involvements" => "Involvement"
    );
    return $columns;
  }
  add_action('save_post', 'save_details_partners');
  function save_details_partners() {
    global $post;

    update_post_meta($post->ID, "partners_url", $_POST["partners_url"]);
  }

  add_action("manage_partners_posts_custom_column",  "partners_custom_columns");
  function partners_custom_columns($column) {
    global $post;

    switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "involvements":
      echo get_the_term_list($post->ID, 'involvements', '', ', ','');
      break;
    case "partners_url":
      $custom = get_post_custom();
      echo $custom["partners_url"][0];
      break;  }
  }

