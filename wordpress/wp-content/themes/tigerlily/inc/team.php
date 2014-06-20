<?php
  add_action('init', 'team_register');
  function team_register() {
    $labels = array( 'name' => _x('CODE2040 Team', 'post type general name'),
      'singular_name' => _x('Team Member', 'post type singular name'),
      'add_new' => _x('Add New', 'team member'),
      'add_new_item' => __('Add New Team Member'),
      'edit_item' => __('Edit Team Member'),
      'new_item' => __('New Team Member'),
      'view_item' => __('View Team Member'),
      'search_items' => __('Search Team Members'),
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

    register_post_type( 'team' , $args );
    register_taxonomy("positions", array("team"), array("label" => "Positions", "singular_label" => "Position", "rewrite" => true));
  }

  add_action("admin_init", "admin_init_team");
  function admin_init_team() {
    add_meta_box("team-member-title-meta", "Title", "team_member_title", "team", "side", "low");
  }
  function team_member_title() {
    global $post;

    $custom = get_post_custom($post->ID);
    $team_member_title = $custom["team_member_title"][0];

    echo '<label>Title: </label>';
    echo '<input name="team_member_title" value="' . $team_member_title . '" />';
  }

  add_action('save_post', 'save_details_team');
  function save_details_team() {
    global $post;

    update_post_meta($post->ID, "team_member_title", $_POST["team_member_title"]);
  }

  add_filter("manage_edit-team_columns", "team_edit_columns");
  function team_edit_columns($columns) {
    $columns = array(
      "cb" => '<input type="checkbox" />',
      "title" => "Name",
      "description" => "Description",
      "team_member_title" => "Title",
      "positions" => "Position"
    );
    return $columns;
  }

  add_action("manage_team_posts_custom_column",  "team_custom_columns");
  function team_custom_columns($column) {
    global $post;

    switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "team_member_title":
      $custom = get_post_custom();
      echo $custom["team_member_title"][0];
      break;
    case "positions":
      echo get_the_term_list($post->ID, 'positions', '', ', ','');
      break;
    }
  }

