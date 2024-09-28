<?php
function university_files()
{
  // wp_enqueue_style('university_main_style', get_stylesheet_uri());
  wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'),  array('jquery'), '1.0', true);
  wp_enqueue_style('custom-google-font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('university_main_style', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('university_extra_style', get_theme_file_uri('/build/index.css'));
}
add_action('wp_enqueue_scripts', 'university_files');

function university_features()
{
  // register_nav_menu('headerMenuLocation', 'Header Menu Location');
  // register_nav_menu('footerLocationOne', 'Footer Location one');
  // register_nav_menu('footerLocationTwo', 'Footer Location Two');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_image_size('professorLandscape', 400, 260, true); //array('left' , 'right')
  add_image_size('professorPortrait', 480, 650, true);
};

add_action('after_setup_theme', 'university_features');
//+++++++++++++++++++
// function university_post_types (){ // we will build it in mu-plugins
//   register_post_type('event' , array(
//   ));
// }
// add_action('init', 'university_post_types');
//+++++++++++++++
function university_adjust_queries($query)
{
  // $query->set('posts_per_page', 1); // universal it will effect all the post types
  if (!is_admin() and is_post_type_archive('event') and is_main_query()) {
    $today = date('Ymd');
    $query->set('meta_key', 'event_date',);
    $query->set('orderby', 'meta_value_num',);
    $query->set('order', 'ASC',);
    $query->set('meta_query', array( // filtering/ordering the query
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
      )
    ),);
  } else if (!is_admin() and is_post_type_archive('program') and is_main_query()) {
    $query->set('posts_per_page', -1);
    // $query->set('meta_key', 'event_date',);
    $query->set('orderby', 'title');
    $query->set('order', 'ASC',);
  }
}
add_action('pre_get_posts', 'university_adjust_queries');
