<?php
  add_action('init', 'fellows_register');
  function fellows_register() {
    $labels = array( 'name' => _x('CODE2040 Fellows', 'post type general name'),
      'singular_name' => _x('Fellow', 'post type singular name'),
      'add_new' => _x('Add New', 'fellows member'),
      'add_new_item' => __('Add New Fellow'),
      'edit_item' => __('Edit Fellow'),
      'new_item' => __('New Fellow'),
      'view_item' => __('View Fellow'),
      'search_items' => __('Search Fellows'),
      'not_found' => __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in Trash'),
      'parent_item_colon' => '' );

    $args = array( 'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'query_var' => true,
      'menu_icon' => get_stylesheet_directory_uri() . '/icons/xfn-friend.png',
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'menu_position' => null,
      'supports' => array('title','editor','thumbnail') );

    register_post_type( 'fellows' , $args );
    register_taxonomy("classes", array("fellows"), array("label" => "Classes (e.g. 2012, 2013...)", "singular_label" => "Class", "rewrite" => true));

    if( class_exists( 'kdMultipleFeaturedImages' ) ) {
      $args = array(
        'id' => 'company_logo',
        'post_type' => 'fellows',
        'labels' => array(
          'name'      => 'Company Logo',
          'set'       => 'Set Company Logo',
          'remove'    => 'Remove Company Logo',
          'use'       => 'Use as Company Logo',
        )
      );

      new kdMultipleFeaturedImages( $args );
    }
  }

  add_action("admin_init", "admin_init_fellows");
  function admin_init_fellows() {
    add_meta_box("fellow-company-meta", "Company", "fellow_company", "fellows", "normal", "low");
    add_meta_box("fellow-university-meta", "University", "fellow_university", "fellows", "normal", "low");
    add_meta_box("fellow-major-meta", "Major", "fellow_major", "fellows", "normal", "low");
  }
  function fellow_company() {
    global $post;

    $custom = get_post_custom($post->ID);
    $fellow_company = $custom["fellow_company"][0];

    echo '<label>Company: </label>';
    echo '<input name="fellow_company" value="' . $fellow_company . '" />';
  }

   function fellow_major() {
    global $post;

    $custom = get_post_custom($post->ID);
    $fellow_major = $custom["fellow_major"][0];

    echo '<label>Major: </label>';
    echo '<input name="fellow_major" value="' . $fellow_major . '" />';
  }

  function fellow_university() {
    global $post;

    $custom = get_post_custom($post->ID);
    $fellow_university = $custom["fellow_university"][0];

    echo '<label>University: </label>';
    echo '<input name="fellow_university" value="' . $fellow_university . '" />';
  }

  add_action('save_post', 'save_details_fellows');
  function save_details_fellows() {
    global $post;

    update_post_meta($post->ID, "fellow_company", $_POST["fellow_company"]);
    update_post_meta($post->ID, "fellow_major", $_POST["fellow_major"]);
    update_post_meta($post->ID, "fellow_university", $_POST["fellow_university"]);
  }

  add_filter("manage_edit-fellows_columns", "fellows_edit_columns");
  function fellows_edit_columns($columns) {
    $columns = array(
      "cb" => '<input type="checkbox" />',
      "title" => "Name",
      "description" => "Description",
      "classes" => "Class"
    );
    return $columns;
  }

  add_action("manage_fellows_posts_custom_column",  "fellows_custom_columns");
  function fellows_custom_columns($column) {
    global $post;

    switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "classes":
      echo get_the_term_list($post->ID, 'classes', '', ', ','');
      break;
    }
  }

