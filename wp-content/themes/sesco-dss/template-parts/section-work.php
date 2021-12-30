<?php $args = array(
  'post_type' => 'work',
); 
$work = new WP_Query($args); ?>

<?php if ($work->have_posts()) : ?>
  <section id="latest-work">
    <div class="row mb ha-between va-center">
      <div class="cell">
        <h2>Our Latest Work Samples</h2>
      </div>
      <div class="cell">
        <a href="/work" class="btn secondary">More of our work&nbsp;&raquo;</a>
      </div>
    </div>
    <ul class="grid up-4">
      <?php while ($work->have_posts()) : $work->the_post(); ?>
        <li class="cell">
          <a href="<?php the_permalink(); ?>" class="img-w"><?php the_post_thumbnail(); ?></a>
          <h3 class="line-break">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <?php echo is_user_logged_in() ? edit_post_link('Edit this content') : ''; ?>
          </h3>
          <?php the_excerpt(); ?>
        </li>
      <?php endwhile; ?>
    </ul>
  </section>
<?php endif; wp_reset_postdata(); ?>