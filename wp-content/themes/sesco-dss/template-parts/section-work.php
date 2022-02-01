<?php if (is_front_page()) : ?>

  <?php $args = array(
    'post_type' => 'work',
    'meta_key' => 'work_featured',
	  'meta_value' => true,
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => 4
  ); 
  $work = new WP_Query($args);
  $link = get_field('section_work_link');
  $title = get_field('section_work_headline');
  $edit_page_link = get_edit_post_link(get_the_ID());
  $field_groups = acf_get_field_groups();
  $title_field_group_id = get_field_object('section_work_headline')['parent'];
  if ($field_groups) :
    foreach ($field_groups as $field_group) :
      if ($field_group['ID'] == $title_field_group_id) :
        $edit_page_link = $edit_page_link . '#acf-' . $field_group['key'];
        break;
      endif;
    endforeach;
  endif;
  ?>

  <?php if ($work->have_posts()) : ?>
      <div class="row expand mb ha-between va-center">
        <div class="cell fill">
          <h2>
            <?php if ($link) : ?>
              <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target'] ? esc_attr($link['target']) : '_self'; ?>"><?php echo $title ? $title : 'Our Latest Work Samples'; ?></a>
            <?php else : ?>
              <?php echo $title ? $title : 'Our Latest Work Samples'; ?>
            <?php endif; ?>
            <?php echo is_user_logged_in() ? '<a href="' . $edit_page_link . '" class="post-edit-link">Edit homepage "Latest Work" section</a>' : ''; ?>
          </h2>
        </div>
      </div>
      <ul class="cards grid up-1 up-2-sm up-3-lg up-4-xl expand">
        <?php while ($work->have_posts()) : $work->the_post(); ?>
          <li id="work-<?php echo get_the_ID(); ?>" class="cell">
            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target'] ? esc_attr($link['target']) : '_self'; ?>" class="card">
              <div class="img-w">
                <?php the_post_thumbnail(); ?>
              </div>
              <div class="card-copy">
                <h3 class="card-title"><?php the_title(); ?></h3>
              </div>
            </a>
            <?php echo is_user_logged_in() ? edit_post_link('Edit this work') : ''; ?>
          </li>
        <?php endwhile; ?>
      </ul>
      <?php if ($link) : ?>
        <div class="row expand ha-end">
          <div class="cell auto">
            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target'] ? esc_attr($link['target']) : '_self'; ?>"><?php echo $link['title'] ? $link['title'] : 'View more'; ?>&nbsp;&raquo;</a>
            <?php echo is_user_logged_in() ? '<a href="' . $edit_page_link . '" class="post-edit-link">Edit homepage "Latest Work" section</a>' : ''; ?>
          </div>
        </div>
      <?php endif; ?>
  <?php endif; wp_reset_postdata(); ?>

<?php else : ?>

  <?php $args = array(
    'post_type' => 'work',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => -1
  ); 
  $work = new WP_Query($args);
  $services = new WP_Query(array('post_type' => 'service'));
  $term = get_queried_object();
  $title = get_field('section_work_headline', $term);
  $term_id = $term->term_id;
  $term_tax = get_term($term_id)->taxonomy;
  ?>

  <?php if ($work->have_posts()) : ?>
    <section id="latest-work" class="bg-secondary">
      <div class="row expand mb ha-between va-center">
        <div class="cell auto">
          <h2>
            <?php echo $title ? $title : 'Our Latest Work Samples'; ?>
            <?php echo is_user_logged_in() ? '<a href="' . get_edit_term_link($term_id, $term_tax) . '" class="post-edit-link">Edit ' . get_the_archive_title() . ' category</a>' : ''; ?>
          </h2>
        </div>
        <?php if ($services->have_posts()) : ?>
          <div class="cell auto pad-y">
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
      <ul class="filterable cards grid up-1 up-2-sm up-3-lg up-4-xl expand">
        <?php while ($work->have_posts()) : $work->the_post(); ?>
          <?php $services = get_field('work_services'); ?>
          <?php if ($services) : ?>
            <?php foreach ($services as $service) : ?>
              <?php $service_classes .= ' ' . classify(get_the_title($service->ID)); ?>
            <?php endforeach; ?>
          <?php endif; ?>
          <li id="work-<?php echo get_the_ID(); ?>" class="mix<?php echo $service_classes; ?> cell">
            <a href="<?php echo get_the_post_thumbnail_url(); ?>" class="glightbox card" data-glightbox="<?php echo 'title: ' . get_the_title() . '; description: .custom-desc-' . get_the_ID() ?>">
              <div class="img-w">
                <?php // Setup srcset ?>
                <?php the_post_thumbnail('medium'); ?>
              </div>
              <div class="card-copy">
                <h3 class="card-title"><?php the_title(); ?></h3>
                <div class="glightbox-desc custom-desc-<?php echo get_the_ID() ?>">
                  <?php if ($services) : ?>
                    <ul class="work-services">
                      <?php foreach ($services as $service) : ?>
                        <?php $service_url = '#service-' . $service->ID; ?>
                        <li><?php echo get_the_title($service->ID) ?></li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>
                </div>
              </div>
            </a>
            <?php echo is_user_logged_in() ? edit_post_link('Edit this work') : ''; ?>
          </li>
          <?php $service_classes = ''; ?>
        <?php endwhile; ?>
      </ul>
    </section>
  <?php endif; wp_reset_postdata(); ?>

<?php endif; ?>