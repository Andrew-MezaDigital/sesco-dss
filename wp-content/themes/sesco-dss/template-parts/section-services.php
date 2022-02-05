<?php $term = get_queried_object(); ?>
<?php $args = array(
  'post_type' => 'service',
  'orderby' => 'name',
  'order' => 'ASC',
  'tax_query' => array(
    array (
        'taxonomy' => 'services',
        'field' => 'slug',
        'terms' => $term->slug,
    )
  ),
); 
$services = new WP_Query($args);
$term = get_queried_object();
$title = get_field('section_services_headline', $term);
$term_id = $term->term_id;
$term_tax = get_term($term_id)->taxonomy;
?>

<?php if ($services->have_posts()) : ?>
  <section id="services">
    <div class="row expand mb ha-between va-center">
      <div class="cell">
        <h2 class="alt">
          <?php echo $title ? $title : 'Our Services List'; ?>
          <?php echo is_user_logged_in() ? '<a href="' . get_edit_term_link($term_id, $term_tax) . '" class="post-edit-link">Edit ' . get_the_archive_title($term) . ' category</a>' : ''; ?>
        </h2>
      </div>
    </div>
    <ul class="cards grid expand up-1 up-2-sm up-3-lg up-4-xxl">
      <?php while ($services->have_posts()) : $services->the_post(); ?>
        <?php $link = get_field('service_link'); ?>
        <li id="service-<?php echo get_the_ID(); ?>" class="cell">
          <div class="card card-service no-hover">
            <div class="img-w">
              <?php the_post_thumbnail('medium'); ?>
            </div>
            <h3 class="card-title"><?php the_title(); ?></h3>
            <div class="card-copy">
              <?php the_field('service_description'); ?>
              <?php if ($link) : ?>
                <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>"><?php echo esc_html($link['title']); ?></a>
              <?php endif; ?>
            </div>
          </div>
          <?php echo is_user_logged_in() ? edit_post_link('Edit this service') : ''; ?>
        </li>
      <?php endwhile; ?>
    </ul>
  </section>
<?php endif; wp_reset_postdata(); ?>