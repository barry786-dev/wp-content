<?php
echo 'I am a single-program';
get_header();
?>

<!-- <h2> <?php the_title(); ?> </h2>
<?php the_content(); ?> -->
<?php
$eventDate = new DateTime(get_field('event_date'));
$today = new DateTime(date('Ymd'));
?>
<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>)"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title"><?php the_title(); ?></h1>
    <div class="page-banner__intro">
      <p>Do not forget to replace me later.</p>
    </div>
  </div>
</div>

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
    'post_type' => 'event',
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
  ?>
      <div class="event-summary">
        <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
          <span class="event-summary__month"><?php
                                              $eventDate = new DateTime(get_field('event_date'));
                                              echo $eventDate->format('M')
                                              ?></span>
          <span class="event-summary__day"><?php
                                            echo $eventDate->format('d')
                                            ?></span>
        </a>
        <div class="event-summary__content">
          <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>">
              <?php
              the_title()
              ?>
            </a></h5>
          <p><?php
              if (has_excerpt()) {
                echo get_the_excerpt();
              } else {
                echo wp_trim_words(get_the_content(), 18);
              }
              ?> <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
        </div>
      </div>
  <?php };
    wp_reset_postdata();
  }
  ?>
  <!-- ending listing the related events -->
  <!-- +++++++++++++++++++++ Start -->
  <!-- <?php
        $events = get_posts(array(
          'post_type' => 'event',  //use actual post type
          'meta_query' => array(
            'relation' => 'or',
            array(
              'key' => 'related_programs', // name of custom field
              'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
              'compare' => 'LIKE'
            ),
            array(
              'key' => 'related_programs', // name of custom field
              'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
              'compare' => 'LIKE'
            )
          )
        ));

        ?>
  <?php if ($events) { ?>
    <ul>
      <?php foreach ($events as $event) { ?>
        <li>
          <?php echo get_the_title($event->ID); ?>
        </li>
      <?php }; ?>
    </ul>
  <?php }; ?> -->
  <!-- ++++++++++++++++++++++++++ End -->
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
      // array(
      //   'key' => 'related_programs',
      //   'compare' => '=',
      //   'value' => the_post(),
      //   'type' => 'numeric'
      // )
    )
  ));

  if ($relatedProfessors->have_posts()) {
    echo '<hr class="section-break">';
    echo '<h2 class="headline headline--medium">' . get_the_title() . ' Professor(s)</h2>';
    while ($relatedProfessors->have_posts()) {
      $relatedProfessors->the_post();
  ?>
      <div class="event-summary">
        <div class="event-summary__content">
          <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>">
              <?php
              the_title()
              ?>
            </a></h5>
          <p><?php
              if (has_excerpt()) {
                echo get_the_excerpt();
              } else {
                echo wp_trim_words(get_the_content(), 18);
              }
              ?> <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
        </div>
      </div>
  <?php };
    wp_reset_postdata();
  }
  ?>
  <!-- ending listing the related professors -->

</div>

<?php
get_footer();
?>