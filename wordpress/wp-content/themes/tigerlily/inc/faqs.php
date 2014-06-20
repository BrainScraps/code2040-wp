<?php
  add_action('init', 'faqs_register');
  function faqs_register() {
    $labels = array( 'name' => _x('CODE2040 FAQS', 'post type general name'),
      'singular_name' => _x('FAQ', 'post type singular name'),
      'add_new' => _x('Add New', 'FAQ'),
      'add_new_item' => __('Add New FAQ'),
      'edit_item' => __('Edit FAQ'),
      'new_item' => __('New FAQ'),
      'view_item' => __('View FAQ'),
      'search_items' => __('Search FAQs'),
      'not_found' => __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in Trash'),
      'parent_item_colon' => '' );

    $args = array( 'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'query_var' => true,
      'menu_icon' => get_stylesheet_directory_uri() . '/icons/question-small.png',
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'menu_position' => null,
      'supports' => array('title','editor','thumbnail') );

    register_post_type( 'faq' , $args );
  }


