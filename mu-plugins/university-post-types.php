<?php
function university_post_types()
{
  // Campus post type
  register_post_type('campus', array(
    'show_in_rest' => 'true', // to use the modern block editor in wp
    'supports' => array(
      'title',
      'editor',
      'excerpt', //'custom-fields'
    ),
    'rewrite' => array('slug' => 'campuses'),
    'has_archive' => true, // tell wp that this type of posts has archive url post
    'public' => true, // this will make the post type visible
    'menu_icon' => 'dashicons-location-alt', // add icon to this post type
    'labels' => array( // add info about this post type
      'name' => 'Campuses', // give the new post type a name
      'add_new' => 'Add New Campus',
      'add_new_item' => 'Add New Campus', // give name to add new Item
      'edit_item' => 'Edit Campuses', // add the name of our post type to the edit
      'all_items' => 'All Campuses',
      'singular_name' => 'Campuses',
      'new_item' => 'New Campus',
      'view_item' => 'View Campus',
      'search_items' => 'Search in Campuses',
      'not_found' => 'No Campus found',
      'not_found_in_trash' => 'No Campus found in Trash',
      'parent_item_colon' => ''
    )
  ));
  // event post type
  register_post_type('event', array(
    'show_in_rest' => 'true', // to use the modern block editor in wp
    'supports' => array(
      'title',
      'editor',
      'excerpt', //'custom-fields'
    ),
    'rewrite' => array('slug' => 'events'),
    'has_archive' => true, // tell wp that this type of posts has archive url post
    'public' => true, // this will make the post type visible
    'menu_icon' => 'dashicons-calendar', // add icon to this post type
    'labels' => array( // add info about this post type
      'name' => 'Events', // give the new post type a name
      'add_new' => 'Add New Event',
      'add_new_item' => 'Add New Event', // give name to add new Item
      'edit_item' => 'Edit Event', // add the name of our post type to the edit
      'all_items' => 'All Events',
      'singular_name' => 'Event'
    )
  ));

  // program post type 
  register_post_type(
    'program',
    array(
      'show_in_rest' => 'true', // to use the modern block editor in wp
      'supports' => array(
        'title',
        'editor', //'custom-fields'
      ),
      'rewrite' => array('slug' => 'programs'),
      'has_archive' => true, // tell wp that this type of posts has archive url post
      'public' => true, // this will make the post type visible
      'menu_icon' => 'dashicons-awards', // add icon to this post type
      'labels' => array( // add info about this post type
        'name' => 'Programs', // give the new post type a name
        'add_new' => 'Add New Program',
        'add_new_item' => 'Add New Program', // give name to add new Item
        'edit_item' => 'Edit Program', // add the name of our post type to the edit
        'all_items' => 'All Programs',
        'singular_name' => 'Program'
      )
    )
  );
  // Professor post type
  register_post_type(
    'professor',
    array(
      'show_in_rest' => 'true', // to use the modern block editor in wp
      'supports' => array(
        'title',
        'editor', 'thumbnail' //'custom-fields'
      ),
      //'rewrite' => array('slug' => 'professors'),
      // 'has_archive' => true, // tell wp that this type of posts has archive url post
      'public' => true, // this will make the post type visible
      'menu_icon' => 'dashicons-welcome-learn-more', // add icon to this post type
      'labels' => array( // add info about this post type
        'name' => 'Professors', // give the new post type a name
        'add_new' => 'Add New Professor',
        'add_new_item' => 'Add New Professor', // give name to add new Item
        'edit_item' => 'Edit Professor', // add the name of our post type to the edit
        'new_item' => 'New Professor',
        'view_item' => 'View Professor',
        'all_items' => 'All Professors',
        'singular_name' => 'Professor',
        'search_items' => 'Search in Professors',
        'not_found' => 'No Professor found',
        'not_found_in_trash' => 'No Professor found in Trash',
        'parent_item_colon' => ''
      )
    )
  );
};
add_action('init', 'university_post_types');
