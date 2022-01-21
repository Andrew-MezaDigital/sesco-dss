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
  $services = new WP_Query(array('post_type' => 'service'));
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
        <?php if ($services->have_posts()) : ?>
          <div class="cell auto">
            <select class="filter">
              <option value="all">All Services</option>
              <?php while ($services->have_posts()) : $services->the_post(); ?>
                <?php if (wp_count_posts('service')) : ?>
                  <option value=".<?php echo classify(get_the_title()); ?>"><?php the_title(); ?></option>
                <?php endif; ?>
              <?php endwhile; wp_reset_postdata(); ?>
            </select>
          </div>
        <?php endif; ?>
      </div>
      <ul class="filterable grid up-4">
        <?php while ($work->have_posts()) : $work->the_post(); ?>
          <?php $services = get_field('work_services'); ?>
          <?php if ($services) : ?>
            <?php foreach ($services as $service) : ?>
              <?php $service_classes .= ' ' . classify(get_the_title($service->ID)); ?>
            <?php endforeach; ?>
          <?php endif; ?>
          <li id="work-<?php echo get_the_ID(); ?>" class="mix<?php echo $service_classes; ?> cell">
            <?php $work_item_url = $work_url . '#work-' . get_the_ID(); ?>
            <a href="<?php echo get_the_post_thumbnail_url(); ?>" class="glightbox img-w" data-glightbox="<?php echo 'title: ' . get_the_title() . '; description: .custom-desc-' . get_the_ID() ?>">
              <?php // Setup srcset ?>
              <?php the_post_thumbnail('medium'); ?>
            </a>
            <div class="glightbox-desc custom-desc-<?php echo get_the_ID() ?>">
              <?php if ($services) : ?>
                <ul class="work-services">
                  <?php foreach ($services as $service) : ?>
                    <?php $service_url = '#service-' . $service->ID; ?>
                    <li><?php echo get_the_title($service->ID) ?></li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
              <?php the_excerpt(); ?>
            </div>
            <h3 class="line-break">
              <?php the_title(); ?>
              <?php echo is_user_logged_in() ? edit_post_link('Edit this content') : ''; ?>
            </h3>
          </li>
          <?php $service_classes = ''; ?>
        <?php endwhile; ?>
      </ul>
    </section>
  <?php endif; wp_reset_postdata(); ?>

<?php endif; ?>