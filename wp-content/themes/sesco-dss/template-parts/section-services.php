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
$services = new WP_Query($args); ?>

<?php if ($services->have_posts()) : ?>
  <section id="services">
    <div class="row mb ha-between va-center">
      <div class="cell">
        <h2>Our Services List</h2>
        <?php if (!is_front_page()) : ?>
          <?php the_content(); ?>
        <?php endif; ?>
      </div>
      <?php if (is_front_page()) : ?>
        <div class="cell">
          <a href="/services" class="btn secondary">See all services&nbsp;&raquo;</a>
        </div>
      <?php endif; ?>
    </div>
    <ul class="grid up-2">
      <?php while ($services->have_posts()) : $services->the_post(); ?>
        <li class="cell">
          <div class="row nowrap">
            <div class="cell lg-33">
              <div class="img-w"><?php the_post_thumbnail(); ?></div>
            </div>
            <div class="cell fill">
              <h3>
                <?php the_title(); ?>
                <?php echo is_user_logged_in() ? edit_post_link('Edit this content') : ''; ?>
              </h3>
              <?php the_field('service_description'); ?>
             </div>
          </div>
        </li>
      <?php endwhile; ?>
    </ul>
  </section>
<?php endif; wp_reset_postdata(); ?>