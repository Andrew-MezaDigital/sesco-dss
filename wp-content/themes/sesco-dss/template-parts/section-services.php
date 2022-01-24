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
    <div class="row mb ha-between va-center">
      <div class="cell">
        <h2>
          <?php echo $title ? $title : 'Our Services List'; ?>
          <?php echo is_user_logged_in() ? '<a href="' . get_edit_term_link($term_id, $term_tax) . '" class="post-edit-link">Edit this</a>' : ''; ?>
        </h2>
      </div>
    </div>
    <ul class="grid up-3">
      <?php while ($services->have_posts()) : $services->the_post(); ?>
        <?php $link = get_field('service_link'); ?>
        <li id="service-<?php echo get_the_ID(); ?>" class="cell">
          <div class="img-w">
            <?php the_post_thumbnail(); ?>
          </div>  
          <h3>
            <?php the_title(); ?>
            <?php echo is_user_logged_in() ? edit_post_link() : ''; ?>
          </h3>
          <?php the_field('service_description'); ?>
          <?php if ($link) : ?>
            <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>"><?php echo esc_html($link['title']); ?></a>
          <?php endif; ?>
        </li>
      <?php endwhile; ?>
    </ul>
  </section>
<?php endif; wp_reset_postdata(); ?>