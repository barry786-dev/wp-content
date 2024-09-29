<?php
echo 'I am archive event';
get_header();
pageBanner(array(
  'title' => 'All Events',
  'subtitle' => 'See what is going around in our worlds'));
?>
<div class="container container--narrow page-section">
  <?php
  while (have_posts()) {
    the_post();
    get_template_part('template-parts/content', 'event');
    }
  echo paginate_links();
  ?>
  <hr class="section-break">
  <p>Looking for recap of past events? <a href="<?php echo site_url('/past-events'); ?>">Click here</a></p>
</div>

<?php
get_footer()
?>