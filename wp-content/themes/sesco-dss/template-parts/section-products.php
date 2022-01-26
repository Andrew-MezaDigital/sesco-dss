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
  ?>

  <?php if ($products->have_posts()) : ?>
    <section id="latest-equipment-for-sale" class="bg-secondary">
      <div class="row mb ha-between va-center">
        <div class="cell fill">
          <h2>
            <?php if ($link) : ?>
              <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target'] ? esc_attr($link['target']) : '_self'; ?>"><?php echo $title ? $title : 'Our Latest Work Samples'; ?></a>
            <?php else : ?>
              <?php echo $title ? $title : 'Latest Equipment for Sale'; ?>
            <?php endif; ?>
            <?php echo is_user_logged_in() ? '<a href="' . $edit_page_link . '" class="post-edit-link">Edit this</a>' : ''; ?>
          </h2>
        </div>
      </div>
      <ul class="grid up-4">
        <?php while ($products->have_posts()) : $products->the_post(); ?>
        <?php $products_item_url = $products_page_url . '#equipment-' . get_the_ID(); ?>
          <li id="equipment-<?php echo get_the_ID(); ?>" class="cell">
            <div class="card">
              <div class="img-w">
                <?php the_post_thumbnail(); ?>
              </div>
              <div class="card-copy">
                <h3 class="card-title">
                  <?php the_title(); ?>
                  <?php echo is_user_logged_in() ? edit_post_link() : ''; ?>
                </h3>
                <p>$<?php the_field('product_price'); ?></p>
              </div>
            </div>
          </li>
        <?php endwhile; ?>
      </ul>
      <?php if ($link) : ?>
        <div class="row ha-end">
          <div class="cell auto">
            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target'] ? esc_attr($link['target']) : '_self'; ?>"><?php echo $link['title'] ? $link['title'] : 'View more'; ?>&nbsp;&raquo;</a>
            <?php echo is_user_logged_in() ? '<a href="' . $edit_page_link . '" class="post-edit-link">Edit this</a>' : ''; ?>
          </div>
        </div>
      <?php endif; ?>
    </section>
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
    <section id="latest-equipment-for-sale" class="bg-secondary">
      <div class="row mb ha-between va-center">
        <div class="cell auto">
          <h2>
            <?php echo $title ? $title : 'Latest Equipment for Sale'; ?>
            <?php echo is_user_logged_in() ? '<a href="' . get_edit_term_link($term_id, $term_tax) . '" class="post-edit-link">Edit this</a>' : ''; ?>
          </h2>
        </div>
        <?php if ($stores->have_posts()) : ?>
          <div class="cell auto">
            <select class="filter">
              <option value="all">All Stores</option>
              <?php while ($stores->have_posts()) : $stores->the_post(); ?>
                <option value=".<?php echo classify(get_the_title()); ?>"><?php the_title(); ?></option>
              <?php endwhile; wp_reset_postdata(); ?>
            </select>
          </div>
        <?php endif; ?>
      </div>
      <ul class="filterable cards grid up-4">
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
            <div class="card no-hover">
              <a href="<?php echo get_the_post_thumbnail_url(); ?>" class="glightbox img-w" data-glightbox="<?php echo 'title: ' . get_the_title() . '; description: .custom-desc-' . get_the_ID() ?>">
                <?php // Setup srcset ?>
                <?php the_post_thumbnail('medium'); ?>
              </a>
              <div class="card-copy">
                <h3 class="card-title">
                  <?php the_title(); ?>
                  <?php echo is_user_logged_in() ? edit_post_link() : ''; ?>
                </h3>
                <p>$<?php the_field('product_price'); ?></p>
                <p><a href="tel:<?php echo $store_phone; ?>" title="Call the <?php echo $store_name; ?> to purchase" class="has-icon"><span class="fas fa-phone-alt"></span><?php echo $store_name; ?></a></p>
                <div class="glightbox-desc custom-desc-<?php echo get_the_ID() ?>">
                  <p>$<?php the_field('product_price'); ?></p>
                  <p><a href="tel:<?php echo $store_phone; ?>" title="Call the <?php echo $store_name; ?> to purchase" class="has-icon"><span class="fas fa-phone-alt"></span><?php echo $store_name; ?></a></p>
                  <?php the_field('product_description'); ?>
                </div>
              </div>
            </div> 
          </li>
        <?php endwhile; ?>
      </ul>
    </section>
  <?php endif; wp_reset_postdata(); ?>

<?php endif; ?>