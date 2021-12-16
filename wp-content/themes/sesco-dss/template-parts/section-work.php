<?php $args = array(
  'post_type' => 'work',
); 
$work = new WP_Query($args); ?>

<?php if ($work->have_posts()) : ?>
  <section id="latest-work">
    <div class="row">
      <div class="cell">
        <h2>Our Latest Work Samples</h2>
      </div>
    </div>
    <ul class="grid up-4">
      <?php while ($work->have_posts()) : $work->the_post(); ?>
        <li class="cell">
          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <?php the_excerpt(); ?>
        </li>
      <?php endwhile; ?>
    </ul>
  </section>
<?php endif; wp_reset_postdata(); ?>