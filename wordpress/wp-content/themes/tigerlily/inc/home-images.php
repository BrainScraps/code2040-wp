<?php
  add_action('init', 'home_images_register');
  function home_images_register() {
    $labels = array( 'name' => _x('CODE2040 Home Images', 'post type general name'),
      'singular_name' => _x('Home Image', 'post type singular name'),
      'add_new' => _x('Add New', 'Home Image'),
      'add_new_item' => __('Add New Home Image'),
      'edit_item' => __('Edit Home Image'),
      'new_item' => __('New Home Image'),
      'view_item' => __('View Home Image'),
      'search_items' => __('Search Home Images'),
      'not_found' => __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in Trash'),
      'parent_item_colon' => '' );

    $args = array( 'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'query_var' => true,
      'menu_icon' => get_stylesheet_directory_uri() . '/icons/image--arrow.png',
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'menu_position' => null,
      'supports' => array('title','editor','thumbnail') );

    register_post_type( 'home_images' , $args );

  }

  add_action("admin_init", "admin_init_home_images");
  function admin_init_home_images() {
    add_meta_box("home_image-alt-meta", "Alt Text", "home_image_alt", "home_images", "normal", "low");
    add_meta_box("home_image-href-meta", "URL Link", "home_image_href", "home_images", "normal", "low");
  }
  function home_image_alt() {
    global $post;

    $custom = get_post_custom($post->ID);
    $home_alt = $custom["home_image_alt"][0];

    echo '<label>Alternate Text: </label>';
    echo '<input name="home_image_alt" value="' . $home_alt . '" />';
  }

   function home_image_href() {
    global $post;

    $custom = get_post_custom($post->ID);
    $home_href = $custom["home_image_href"][0];

    echo '<label>URL Link: </label>';
    echo '<input name="home_image_href" value="' . $home_href . '" />';
  }

  add_action('save_post', 'save_details_home_images');
  function save_details_home_images() {
    global $post;

    update_post_meta($post->ID, "home_image_alt", $_POST["home_image_alt"]);
    update_post_meta($post->ID, "home_image_href", $_POST["home_image_href"]);
  }

  add_filter("manage_edit-home_images_columns", "home_images_edit_columns");
  function home_images_edit_columns($columns) {
    $columns = array(
      "cb" => '<input type="checkbox" />',
      "title" => "Title",
      "description" => "Description"
    );
    return $columns;
  }

  add_action("manage_home_images_posts_custom_column",  "home_images_custom_columns");
  function home_images_custom_columns($column) {
    global $post;

    switch ($column) {
    case "description":
      the_excerpt();
      break;
    }
  }

