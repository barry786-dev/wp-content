<?php
echo 'I am a single-event';
get_header();
pageBanner();
?>

<div class="container container--narrow page-section">
  <div class="metabox metabox--position-up metabox--with-home-link">
    <p>
      <a class="metabox__blog-home-link" href="<?php
                                                $eventDate = new DateTime(get_field('event_date'));
                                                $today = new DateTime(date('Ymd'));
                                                if ($eventDate >= $today) {
                                                  echo  get_post_type_archive_link('event');
                                                } else {
                                                  echo site_url('/past-events');
                                                };  ?>"><i class="fa fa-home" aria-hidden="true"></i> <?php
                                                                                                      if ($eventDate >= $today) {
                                                                                                        echo "Events Home";
                                                                                                      } else {
                                                                                                        echo "Past Events";
                                                                                                      };
                                                                                                      ?> </a> <span class="metabox__main"> <?php the_title(); ?></span>
    </p>
  </div>
  <div class="generic-content">
    <?php the_content(); ?>
  </div>
  <?php
  $relatedPrograms = get_field('related_programs');
  if ($relatedPrograms) {
    echo '<hr class="section-break">';
    echo '<h2 class="headline headline--medium">Related Program(s)</h2>';
    echo '<ul class="link-list min-list">';
    foreach ($relatedPrograms as $program) { ?>
      <li><a href="<?php echo get_the_permalink($program) ?>"><?php echo get_the_title($program) ?></a></li>
  <?php }
    echo '</ul>';
  }
  ?>
</div>


<?php
get_footer();
?>