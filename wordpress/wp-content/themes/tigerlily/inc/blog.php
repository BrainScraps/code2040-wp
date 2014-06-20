<?php
  add_action('init', 'blog_register');
  function blog_register() {
    $labels = array( 'name' => _x('CODE2040 Blog', 'post type general name'),
      'singular_name' => _x('Blog Article', 'post type singular name'),
      'add_new' => _x('Add New', 'Blog article'),
      'add_new_item' => __('Add New Blog Article'),
      'edit_item' => __('Edit Blog Article'),
      'new_item' => __('New Blog Article'),
      'view_item' => __('View Blog Article'),
      'search_items' => __('Search Blog Article'),
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
      'supports' => array('title','editor','thumbnail', 'comments') );

    register_post_type( 'blog' , $args );
  }

  

