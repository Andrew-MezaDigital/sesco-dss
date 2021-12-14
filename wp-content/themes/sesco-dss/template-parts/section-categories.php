<?php $term_query = new WP_Term_Query( array( 
    'taxonomy' => 'services',
    'orderby' => 'name',
    'order' => 'ASC',
    'fields' => 'all',
    'hide_empty' => false,
) ); ?>
<?php if (!empty($term_query) && !is_wp_error($term_query)) : ?>
  <section class="service-categories">
    <h2 class="screen-reader-text">Services</h2>
    <ul class="grid 3-up">
      <?php foreach ($term_query->terms as $term) : ?>
        <?php $term_link = get_term_link($term); ?>
        <?php $excerpt = get_term_meta($term->term_id, 'category_excerpt', true ); ?>
        <?php $image_id = get_term_meta($term->term_id, 'category_image', true ); ?>
        <?php $image = wp_get_attachment_image($image_id, 'large'); ?>
        <li class="grid-cell">
          <?php echo $image ? $image : ''; ?>
          <h3><a href="<?php echo $term_link; ?>"><?php echo $term->name; ?></a></h3>
          <?php echo $excerpt ? '<p>' . $excerpt . '</p>' : ''; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>
<?php endif; ?>