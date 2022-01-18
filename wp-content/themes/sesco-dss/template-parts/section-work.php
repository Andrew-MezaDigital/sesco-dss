<?php if (is_front_page()) : ?>

  <?php $args = array(
    'post_type' => 'work',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => 4
  ); 
  $work = new WP_Query($args);
  $work_url = site_url() . get_field('section_work_url');
  $work_cta = get_field('section_work_cta');
  $work_title = get_field('section_work_header');
  $edit_homepage_link = get_edit_post_link(get_the_ID());
  ?>

  <?php if ($work->have_posts()) : ?>
    <section id="latest-work">
      <div class="row mb ha-between va-center">
        <div class="cell auto">
          <h2>
            <a href="<?php echo $work_url . '#latest-work'; ?>"><?php echo $work_title ? $work_title : 'Our Latest Work Samples'; ?></a>
            <?php echo is_user_logged_in() ? '<a href="' . $edit_homepage_link . '" class="post-edit-link">Edit this content</a>' : ''; ?>
          </h2>
        </div>
        <div class="cell auto">
          <a href="<?php echo $work_url . '#latest-work'; ?>" class="btn secondary"><?php echo $work_cta ? $work_cta : 'More of our work'; ?>&nbsp;&raquo;</a>
          <?php echo is_user_logged_in() ? '<a href="' . $edit_homepage_link . '" class="post-edit-link">Edit this content</a>' : ''; ?>
        </div>
      </div>
      <ul class="list-work grid up-4">
        <?php while ($work->have_posts()) : $work->the_post(); ?>
          <li id="work-<?php echo get_the_ID(); ?>" class="cell">
            <?php $work_item_url = $work_url . '#work-' . get_the_ID(); ?>
            <a href="<?php echo $work_item_url; ?>" class="img-w"><?php the_post_thumbnail(); ?></a>
            <h3 class="line-break">
              <a href="<?php echo $work_item_url; ?>"><?php the_title(); ?></a>
              <?php echo is_user_logged_in() ? edit_post_link('Edit this content') : ''; ?>
            </h3>
            <?php the_excerpt(); ?>
          </li>
        <?php endwhile; ?>
      </ul>
    </section>
  <?php endif; wp_reset_postdata(); ?>

<?php else : ?>

  <?php $args = array(
    'post_type' => 'work',
    'orderby' => 'date',
    'order' => 'DESC'
  ); 
  $work = new WP_Query($args);
  $work_title = get_field('section_work_header');
  $edit_page_link = get_edit_post_link(get_the_ID());
  ?>

  <?php if ($work->have_posts()) : ?>
    <section id="latest-work">
      <div class="row mb ha-between va-center">
        <div class="cell auto">
          <h2>
            <?php echo $work_title ? $work_title : 'Our Latest Work Samples'; ?>
            <?php echo is_user_logged_in() ? '<a href="' . $edit_page_link . '" class="post-edit-link">Edit this content</a>' : ''; ?>
          </h2>
        </div>
        <div class="cell auto">
          <!-- Make buttons dynamic -->
          <button type="button" data-filter="all">All</button>
          <button type="button" data-filter=".fredericksburg-store">Fredericksburg Store</button>
          <button type="button" data-filter=".fairfax-store">Fairfax Store</button>
        </div>
      </div>
      <ul class="list-work grid up-4">
        <?php while ($work->have_posts()) : $work->the_post(); ?>
          <?php $stores = get_field('work_store'); ?>
          <?php if ($stores) : ?>
            <?php foreach($stores as $store) : ?>
              <?php $store_class = classify(get_the_title($store->ID)); ?>
            <?php endforeach; ?>
          <?php endif; ?>
          <li id="work-<?php echo get_the_ID(); ?>" class="mix <?php echo $store_class; ?> cell">
            <?php $work_item_url = $work_url . '#work-' . get_the_ID(); ?>
            <!-- Add lightbox functionality -->
            <div class="img-w"><?php the_post_thumbnail(); ?></div>
            <h3 class="line-break">
              <?php the_title(); ?>
              <?php echo is_user_logged_in() ? edit_post_link('Edit this content') : ''; ?>
            </h3>
            <?php the_excerpt(); ?>
          </li>
        <?php endwhile; ?>
      </ul>
    </section>
  <?php endif; wp_reset_postdata(); ?>

<?php endif; ?>