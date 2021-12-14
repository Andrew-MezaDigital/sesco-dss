<?php $args = array(
  'post_type' => 'products',
); 
$products = new WP_Query($args); ?>

<?php if ($products->have_posts()) : ?>
  <section class="section-work">
    <div class="grid">
      <div class="grid-cell">
        <h2>Our Latest Equipment for Sale</h2>
      </div>
    </div>
    <ul class="grid 4-up">
      <?php while ($products->have_posts()) : $products->the_post(); ?>
        <li class="grid-cell">
          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <p>$<?php the_field('product_price'); ?></p>
        </li>
      <?php endwhile; ?>
    </ul>
  </section>
<?php endif; wp_reset_postdata(); ?>