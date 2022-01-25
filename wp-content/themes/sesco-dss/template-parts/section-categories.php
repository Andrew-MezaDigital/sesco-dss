<?php $term_query = new WP_Term_Query( array( 
    'taxonomy' => 'services',
    'orderby' => 'date',
    'order' => 'DESC',
    'fields' => 'all',
    'hide_empty' => false,
) ); ?>
<?php if (!empty($term_query) && !is_wp_error($term_query)) : ?>
  <section id="services">
    <h2 class="screen-reader-text">Services</h2>
    <ul class="cards grid up-3">
      <?php foreach ($term_query->terms as $term) : ?>
        <?php
          $term_id = $term->term_id;
          $term_tax = get_term($term_id)->taxonomy;
          $term_link = get_term_link($term);
          $excerpt = get_term_meta($term_id, 'category_excerpt', true );
          $image_id = get_term_meta($term_id, 'category_image', true );
          $image = wp_get_attachment_image($image_id, 'medium');
        ?>
        <li class="cell">
          <div class="card card-lg">
            <a href="<?php echo $term_link; ?>" class="img-w">
              <?php echo $image ? $image : ''; ?>
            </a>
            <div class="card-copy">
              <h3 class="card-title">
                <a href="<?php echo $term_link; ?>"><?php echo $term->name; ?></a>
                <?php echo is_user_logged_in() ? '<a href="' . get_edit_term_link($term_id, $term_tax) . '" class="post-edit-link">Edit this</a>' : ''; ?>
              </h3>
              <?php echo $excerpt ? '<p>' . $excerpt . '</p>' : ''; ?>
            </div>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>
<?php endif; ?>