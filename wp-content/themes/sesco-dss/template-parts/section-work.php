<?php $args = array(
  'post_type' => 'work',
); 
$work = new WP_Query($args); ?>

<?php if ($work->have_posts()) : ?>
  <section class="section-work">
    <div class="grid">
      <div class="grid-cell">
        <h2>Our Latest Work Samples</h2>
      </div>
    </div>
    <ul class="grid 4-up">
      <?php while ($work->have_posts()) : $work->the_post(); ?>
        <li class="grid-cell">
          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <?php the_excerpt(); ?>
        </li>
      <?php endwhile; ?>
    </ul>
  </section>
<?php endif; wp_reset_postdata(); ?>