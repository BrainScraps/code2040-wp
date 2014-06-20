<?php
  add_action('init', 'press_register');
  function press_register() {
    $labels = array( 'name' => _x('CODE2040 Press', 'post type general name'),
      'singular_name' => _x('Press Article', 'post type singular name'),
      'add_new' => _x('Add New', 'press article'),
      'add_new_item' => __('Add New Press Article'),
      'edit_item' => __('Edit Press Article'),
      'new_item' => __('New Press Article'),
      'view_item' => __('View Press Article'),
      'search_items' => __('Search Press Article'),
      'not_found' => __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in Trash'),
      'parent_item_colon' => '' );

    $args = array( 'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'query_var' => true,
      'menu_icon' => get_stylesheet_directory_uri() . '/icons/newspapers.png',
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'menu_position' => null,
      'supports' => array('title','editor','thumbnail') );

    register_post_type( 'press' , $args );
  }

  add_action("admin_init", "admin_init_press");
  function admin_init_press() {
    add_meta_box("press-source-meta", "Source", "press_source", "press", "side", "low");
    add_meta_box("press-author-meta", "Author", "press_author", "press", "side", "low");
    add_meta_box("press-date-meta", "Date", "press_date", "press", "side", "low");
    add_meta_box("press-url-meta", "URL", "press_url", "press", "side", "low");
  }
  function press_source() {
    global $post;

    $custom = get_post_custom($post->ID);
    $press_source = $custom["press_source"][0];

    echo '<label>Source: </label>';
    echo '<input name="press_source" value="' . $press_source . '" />';
  }

   function press_author() {
    global $post;

    $custom = get_post_custom($post->ID);
    $press_author = $custom["press_author"][0];

    echo '<label>Author: </label>';
    echo '<input name="press_author" value="' . $press_author . '" />';
  }

  function press_date() {
    global $post;

    $custom = get_post_custom($post->ID);
    $press_date = $custom["press_date"][0];

    echo '<label>Date: </label>';
    echo '<input name="press_date" type="DATE" value="' . $press_date . '" />';
  }

  function press_url() {
    global $post;

    $custom = get_post_custom($post->ID);
    $press_url = $custom["press_url"][0];

    echo '<label>URL: </label>';
    echo '<input name="press_url" value="' . $press_url . '" />';
  }

  add_action('save_post', 'save_details_press');
  function save_details_press() {
    global $post;

    update_post_meta($post->ID, "press_source", $_POST["press_source"]);
    update_post_meta($post->ID, "press_url", $_POST["press_url"]);
    update_post_meta($post->ID, "press_author", $_POST["press_author"]);
    update_post_meta($post->ID, "press_date", $_POST["press_date"]);
  }

  add_filter("manage_edit-press_columns", "press_edit_columns");
  function press_edit_columns($columns) {
    $columns = array(
      "cb" => '<input type="checkbox" />',
      "title" => "Name",
      "description" => "Description",
      "press_source" => "Source",
      "press_url" => "URL",
      "press_date" => "Date"
    );
    return $columns;
  }

  add_action("manage_press_posts_custom_column",  "press_custom_columns");
  function press_custom_columns($column) {
    global $post;

    switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "press_date":
      $custom = get_post_custom();
      echo $custom["press_date"][0];
      break;
    case "press_source":
      $custom = get_post_custom();
      echo $custom["press_source"][0];
      break;
    case "press_url":
      $custom = get_post_custom();
      echo $custom["press_url"][0];
      break;
    }
  }

