<?php
echo 'I am a single-program';
get_header();
pageBanner();
?>
<div class="container container--narrow page-section">
  <div class="metabox metabox--position-up metabox--with-home-link">
    <p>
      <a class="metabox__blog-home-link" href=" <?php echo  get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Programs Home </a> <span class="metabox__main"> <?php the_title(); ?></span>
    </p>
  </div>
  <div class="generic-content">
    <?php the_content(); ?>
  </div>
  <!-- starting listing the related events -->
  <?php
  $today = date('Ymd');
  $homepageEvents = new wp_query(array(
    'posts_per_page' => 2, // -1 give all the posts
    'post_type' => 'event', //use actual post type
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num', // 'title' or 'rand' default is 'post_date'
    'order' => 'ASC',
    'meta_query' => array( // filtering/ordering the query
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
      ),
      array(
        'key' => 'related_programs',
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

  if ($homepageEvents->have_posts()) {
    echo '<hr class="section-break">';
    echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Events</h2>';
    while ($homepageEvents->have_posts()) {
      $homepageEvents->the_post();
      get_template_part('template-parts/content', 'event');
    };
    wp_reset_postdata();
  }
  ?>
  <!-- ending listing the related events -->
  <!-- starting listing the related professors -->
  <?php
  $relatedProfessors = new wp_query(array(
    'posts_per_page' => -1, // -1 give all the posts
    'post_type' => 'professor',
    //'meta_key' => 'event_date',
    'orderby' => 'title', // 'title' or 'rand' default is 'post_date'
    'order' => 'ASC',
    'meta_query' => array( // filtering/ordering the query
      array(
        'key' => 'related_programs',
        'compare' => 'LIKE',
        'value' => '"' . get_the_ID() . '"',
      ),
    )
  ));

  if ($relatedProfessors->have_posts()) {
    echo '<hr class="section-break">';
    echo '<h2 class="headline headline--medium">' . get_the_title() . ' Professor(s)</h2>';
    echo '<ul class="professor-cards">';

    while ($relatedProfessors->have_posts()) {
      $relatedProfessors->the_post();
  ?>
      <li class="professor-card__list-item "><a class="professor-card" href="<?php the_permalink() ?>">
          <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape') ?>" alt="DR.Barks a lot">
          <span class="professor-card__name"><?php
                                              the_title();
                                              ?></span>
        </a></li>
  <?php };
    echo '</ul>';
  }
  wp_reset_postdata();
  ?>
  <!-- ending listing the related professors -->
  <!-- start listing related campuses -->
  <?php
  $relatedCampuses = get_field('related_campuses');
  if ($relatedCampuses) {
    echo '<hr class="section-break">';
    echo '<h2 class="headline headline--medium">' . get_the_title() . ' is Available in these Campuses</h2>';
    echo '<ul class="min-list link-list"';
    foreach ($relatedCampuses as $campus) { ?>
      <li>
        <a href="<?php echo the_permalink($campus) ?>"><?php echo get_the_title($campus); ?></a>
      </li>
  <?php };
    echo '</ul';
  } ?>
</div>
<?php
get_footer();
?>

<!-- <div>
  <h1>
    <?php
    foreach ($campuses as $campus) { ?>
      <li>
        <?php echo get_the_title($campus->ID); ?>
      </li>
    <?php }
    ?>
  </h1>
</div> -->