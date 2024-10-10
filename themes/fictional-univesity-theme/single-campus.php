<?php
echo 'I am a single-campus';
get_header();
pageBanner();
?>
<div class="container container--narrow page-section">
  <div class="metabox metabox--position-up metabox--with-home-link">
    <p>
      <a class="metabox__blog-home-link" href=" <?php echo  get_post_type_archive_link('campus'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Campuses </a> <span class="metabox__main"> <?php the_title(); ?></span>
    </p>
  </div>
  <div class="generic-content">
    <?php the_content(); ?>
  </div>
  <div class="acf-map">
    <?php
    $mapLocation = get_field('map_location');
    ?>
    <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng'] ?>">
      <h3><?php the_title(); ?></h3>
      <?php echo $mapLocation['address']; ?>
    </div>
  </div>

  <!-- starting listing the related Programs -->
  <?php
  $relatedPrograms = new wp_query(array(
    'posts_per_page' => -1, // -1 give all the posts
    'post_type' => 'program',
    //'meta_key' => 'event_date',
    'orderby' => 'title', // 'title' or 'rand' default is 'post_date'
    'order' => 'ASC',
    'meta_query' => array( // filtering/ordering the query
      array(
        'key' => 'related_campuses',
        'compare' => 'LIKE',
        'value' => '"' . get_the_ID() . '"',
      ),
      // array(
      //   'key' => 'related_programs',
      //   'compare' => '=',
      //   'value' => the_post(),
      //   'type' => 'numeric'
      // )
    )
  ));

  if ($relatedPrograms->have_posts()) {
    echo '<hr class="section-break">';
    echo '<h2 class="headline headline--medium">Programs available in this Capmus</h2>';
    echo '<ul class="min-list link-list" ';

    while ($relatedPrograms->have_posts()) {
      $relatedPrograms->the_post();
  ?>
      <li><a href="<?php the_permalink() ?>">
          <?php
          the_title();
          ?>
        </a></li>
  <?php };
    echo '</ul>';
  }
  wp_reset_postdata();
  ?>
  <!-- ending listing the related Programs -->

</div>

<?php
get_footer();
?>