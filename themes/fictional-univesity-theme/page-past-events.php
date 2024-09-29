<?php
echo 'I am page past event';
get_header();
pageBanner(array(
  'title' => 'Past Events',
  'subtitle' => 'See what was going on our world'
));
?>
<div class="container container--narrow page-section">
  <?php
  $today = date('Ymd');
  $pastEvents = new WP_Query(array(
    'paged' => get_query_var('paged', 1), //tell the customs query which page worth of result should be on.
    //'posts_per_page' => 1, // -1 give all the posts
    'post_type' => 'event',
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num', // 'title' or 'rand' default is 'post_date'
    'order' => 'DESC',
    'meta_query' => array( // filtering/ordering the query
      array(
        'key' => 'event_date',
        'compare' => '<=',
        'value' => $today,
        'type' => 'numeric'
      )
    )
  ));
  while ($pastEvents->have_posts()) {
    $pastEvents->the_post();
    get_template_part('template-parts/content', 'event');
  }
  echo paginate_links(array(
    'total' => $pastEvents->max_num_pages,
  )); // wp pagination only work out of the box with the default queries that wp make by its own
  ?>
</div>

<?php
get_footer()
?>