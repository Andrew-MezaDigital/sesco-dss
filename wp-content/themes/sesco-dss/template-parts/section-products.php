<?php if (is_front_page()) : ?>
  <?php
    $link = get_field('section_products_link');
    $title = get_field('section_products_headline');
    $edit_page_link = get_edit_post_link(get_the_ID());
    $args = array(
      'post_type' => 'products',
      'meta_key' => 'product_featured',
	    'meta_value' => true,
      'orderby' => 'date',
      'order' => 'DESC',
      'posts_per_page' => 4
    ); 
    $products = new WP_Query($args);
    $field_groups = acf_get_field_groups();
    $title_field_group = get_field_object('section_work_headline')['parent'];
    if ($field_groups) :
      foreach ($field_groups as $field_group) :
        if ($field_group['ID'] == $title_field_group) :
          $edit_page_link = $edit_page_link . '#acf-' . $field_group['key'];
          break;
        endif;
      endforeach;
    endif;
  ?>

  <?php if ($products->have_posts()) : ?>
      <div class="row expand mb ha-between va-center mt">
        <div class="cell fill">
          <h2>
            <?php if ($link) : ?>
              <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target'] ? esc_attr($link['target']) : '_self'; ?>"><?php echo $title ? $title : 'Our Latest Work Samples'; ?></a>
            <?php else : ?>
              <?php echo $title ? $title : 'Latest Equipment for Sale'; ?>
            <?php endif; ?>
            <?php echo is_user_logged_in() ? '<a href="' . $edit_page_link . '" class="post-edit-link">Edit homepage "Latest Equipment" section</a>' : ''; ?>
          </h2>
        </div>
      </div>
      <ul class="cards grid up-1 up-2-sm up-3-lg up-4-xl expand">
        <?php while ($products->have_posts()) : $products->the_post(); ?>
          <?php $products_item_url = $products_page_url . '#equipment-' . get_the_ID(); ?>
          <li id="equipment-<?php echo get_the_ID(); ?>" class="cell">
            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target'] ? esc_attr($link['target']) : '_self'; ?>" class="card">
              <div class="img-w">
                <?php the_post_thumbnail(); ?>
              </div>
              <div class="card-copy">
                <h3 class="card-title"><?php the_title(); ?></h3>
                <p>$<?php the_field('product_price'); ?></p>
              </div>
            </a>
            <?php echo is_user_logged_in() ? edit_post_link('Edit this equipment') : ''; ?>
          </li>
        <?php endwhile; ?>
      </ul>
      <?php if ($link) : ?>
        <div class="row expand ha-end">
          <div class="cell auto">
            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target'] ? esc_attr($link['target']) : '_self'; ?>"><?php echo $link['title'] ? $link['title'] : 'View more'; ?>&nbsp;&raquo;</a>
            <?php echo is_user_logged_in() ? '<a href="' . $edit_page_link . '" class="post-edit-link">Edit homepage "Latest Equipment" section</a>' : ''; ?>
          </div>
        </div>
      <?php endif; ?>
  <?php endif; wp_reset_postdata(); ?>

<?php else : ?>

  <?php $args = array(
    'post_type' => 'products',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => -1
  ); 
  $products = new WP_Query($args);
  $stores = new WP_Query(array('post_type' => 'stores'));
  $term = get_queried_object();
  $title = get_field('section_products_headline', $term);
  $term_id = $term->term_id;
  $term_tax = get_term($term_id)->taxonomy;
  ?>
  <?php if ($products->have_posts()) : ?>
    <section class="bg-secondary">
      <div id="latest-equipment-for-sale" class="anchor"></div>
      <div class="row expand mb ha-between va-center">
        <div class="cell auto">
          <h2>
            <?php echo $title ? $title : 'Latest Equipment for Sale'; ?>
            <?php echo is_user_logged_in() ? '<a href="' . get_edit_term_link($term_id, $term_tax) . '" class="post-edit-link">Edit ' . get_the_archive_title() . ' category</a>' : ''; ?>
          </h2>
        </div>
        <?php if ($stores->have_posts()) : ?>
          <div class="cell auto pad-y">
            <select class="filter">
              <option value="all">All Stores</option>
              <?php while ($stores->have_posts()) : $stores->the_post(); ?>
                <option value=".<?php echo classify(get_the_title()); ?>"><?php the_title(); ?></option>
              <?php endwhile; wp_reset_postdata(); ?>
            </select>
          </div>
        <?php endif; ?>
      </div>
      <ul class="filterable cards grid up-1 up-2-sm up-3-lg up-4-xl expand">
        <?php while ($products->have_posts()) : $products->the_post(); ?>
          <?php $products_item_url = $products_page_url . '#equipment-' . get_the_ID(); ?>
          <?php $stores = get_field('product_store'); ?>
          <?php if ($stores) : ?>
            <?php foreach ($stores as $store) : ?>
              <?php $store_class = classify(get_the_title($store->ID)); ?>
              <?php $store_name = get_the_title($store->ID); ?>
              <?php $store_phone = get_field('store_phone', $store->ID); ?>
            <?php endforeach; ?>
          <?php endif; ?>
          <li id="equipment-<?php echo get_the_ID(); ?>" class="mix <?php echo $store_class; ?> cell">
            <a href="<?php echo get_the_post_thumbnail_url(); ?>" class="glightbox card" data-glightbox="<?php echo 'title: ' . get_the_title() . '; description: .custom-desc-' . get_the_ID() ?>">
              <div class="img-w">
                <?php // Setup srcset ?>
                <?php the_post_thumbnail('medium'); ?>
              </div>
              <div class="card-copy">
                <h3 class="card-title"><?php the_title(); ?></h3>
                <p>$<?php the_field('product_price'); ?></p>
              </div>
            </a>
            <div class="glightbox-desc custom-desc-<?php echo get_the_ID() ?>">
              <p>$<?php the_field('product_price'); ?></p>
              <p><a href="tel:<?php echo $store_phone; ?>" title="Call the <?php echo $store_name; ?> to purchase" class="has-icon"><span class="fas fa-phone-alt"></span><?php echo $store_name; ?></a></p>
              <?php the_field('product_description'); ?>
            </div>
            <?php echo is_user_logged_in() ? edit_post_link('Edit this equipment') : ''; ?>
          </li>
        <?php endwhile; ?>
      </ul>
    </section>
  <?php endif; wp_reset_postdata(); ?>

<?php endif; ?>