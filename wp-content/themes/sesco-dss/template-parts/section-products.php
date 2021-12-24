<?php $args = array(
  'post_type' => 'products',
); 
$products = new WP_Query($args); ?>

<?php if ($products->have_posts()) : ?>
  <section id="latest-equipment-for-sale">
  <div class="row mb ha-between va-center">
      <div class="cell">
        <h2>Latest Equipment for Sale</h2>
      </div>
      <div class="cell">
        <a href="/equipment#for-sale" class="btn secondary">More for sale&nbsp;&raquo;</a>
      </div>
    </div>
    <ul class="grid up-4">
      <?php while ($products->have_posts()) : $products->the_post(); ?>
        <li class="cell">
          <a href="<?php the_permalink(); ?>" class="img-w"><?php the_post_thumbnail(); ?></a>
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <p>$<?php the_field('product_price'); ?></p>
        </li>
      <?php endwhile; ?>
    </ul>
  </section>
<?php endif; wp_reset_postdata(); ?>