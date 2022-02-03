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
    <ul class="cards grid expand up-1 up-2-md up-3-xl ha-center">
      <?php foreach ($term_query->terms as $term) : ?>
        <?php
          $term_id = $term->term_id;
          $term_tax = get_term($term_id)->taxonomy;
          $term_link = get_term_link($term);
          $image_id = get_term_meta($term_id, 'category_image', true );
          $image = wp_get_attachment_image($image_id, 'medium');
        ?>
        <li class="cell">
          <a href="<?php echo $term_link; ?>"class="card card-lg">
            <div class="img-w">
              <?php echo $image ? $image : ''; ?>
            </div>
            <div class="card-copy">
              <h3 class="card-title"><?php echo $term->name; ?></h3>
              <?php echo term_description($term_id) ? '<p>' . term_description($term_id) . '</p>' : ''; ?>
            </div>
          </a>
          <?php echo is_user_logged_in() ? '<a href="' . get_edit_term_link($term_id, $term_tax) . '" class="post-edit-link">Edit ' . $term->name . ' category</a>' : ''; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>
<?php endif; ?>