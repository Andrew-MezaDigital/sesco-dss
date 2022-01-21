<?php if (is_front_page()) : ?>

  <?php $args = array(
    'post_type' => 'products',
    'orderby' => 'date',
    'order' => 'DESC'
  ); 
  $products = new WP_Query($args);
  $products_page_url = site_url() . get_field('section_products_url');
  $products_section_url = $products_page_url . '#latest-equipment-for-sale';
  $products_cta = get_field('section_products_cta');
  $products_title = get_field('section_products_header');
  $edit_homepage_link = get_edit_post_link(get_the_ID());
  ?>

  <?php if ($products->have_posts()) : ?>
    <section id="latest-equipment-for-sale">
      <div class="row mb ha-between va-center">
        <div class="cell auto">
          <h2>
            <a href="<?php echo $products_section_url; ?>"><?php echo $products_title ? $products_title : 'Latest Equipment for Sale'; ?></a>
            <?php echo is_user_logged_in() ? '<a href="' . $edit_homepage_link . '" class="post-edit-link">Edit this content</a>' : ''; ?>
          </h2>
        </div>
        <div class="cell auto">
          <a href="<?php echo $products_section_url; ?>" class="btn secondary"><?php echo $products_cta ? $products_cta : 'More for sale'; ?>&nbsp;&raquo;</a>
          <?php echo is_user_logged_in() ? '<a href="' . $edit_homepage_link . '" class="post-edit-link">Edit this content</a>' : ''; ?>
        </div>
      </div>
      <ul class="grid up-4">
        <?php while ($products->have_posts()) : $products->the_post(); ?>
        <?php $products_item_url = $products_page_url . '#equipment-' . get_the_ID(); ?>
          <li id="equipment-<?php echo get_the_ID(); ?>" class="cell">
            <a href="<?php echo $products_item_url; ?>" class="img-w"><?php the_post_thumbnail(); ?></a>
            <h3>
              <a href="<?php echo $products_item_url; ?>"><?php the_title(); ?></a>
              <?php echo is_user_logged_in() ? edit_post_link('Edit this content') : ''; ?>
            </h3>
            <p>$<?php the_field('product_price'); ?></p>
          </li>
        <?php endwhile; ?>
      </ul>
    </section>
  <?php endif; wp_reset_postdata(); ?>

<?php else : ?>

  <?php $args = array(
    'post_type' => 'products',
    'orderby' => 'date',
    'order' => 'DESC'
  ); 
  $products = new WP_Query($args);
  $products_page_url = site_url() . get_field('section_products_url');
  $products_section_url = $products_page_url . '#latest-equipment-for-sale';
  $products_cta = get_field('section_products_cta');
  $products_title = get_field('section_products_header');
  $edit_homepage_link = get_edit_post_link(get_the_ID());
  $stores = new WP_Query(array('post_type' => 'stores'));
  ?>

  <?php if ($products->have_posts()) : ?>
    <section id="latest-equipment-for-sale">
      <div class="row mb ha-between va-center">
        <div class="cell auto">
          <h2>
            <?php echo $products_title ? $products_title : 'Latest Equipment for Sale'; ?>
            <?php echo is_user_logged_in() ? '<a href="' . $edit_homepage_link . '" class="post-edit-link">Edit this content</a>' : ''; ?>
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
      <ul class="filterable grid up-4">
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
            <a href="<?php echo get_the_post_thumbnail_url(); ?>" class="glightbox img-w" data-glightbox="<?php echo 'title: ' . get_the_title() . '; description: .custom-desc-' . get_the_ID() ?>">
              <?php // Setup srcset ?>
              <?php the_post_thumbnail('medium'); ?>
            </a>
            <div class="glightbox-desc custom-desc-<?php echo get_the_ID() ?>">
              <p>$<?php the_field('product_price'); ?></p>
              <p><a href="tel:<?php echo $store_phone; ?>" title="Call the <?php echo $store_name; ?> to purchase"><span class="fas fa-phone-alt"></span><?php echo $store_name; ?></a></p>
              <?php the_field('product_description'); ?>
            </div>
            <h3>
              <?php the_title(); ?>
              <?php echo is_user_logged_in() ? edit_post_link('Edit this content') : ''; ?>
            </h3>
            <p>$<?php the_field('product_price'); ?></p>
            <p><a href="tel:<?php echo $store_phone; ?>" title="Call the <?php echo $store_name; ?> to purchase"><span class="fas fa-phone-alt"></span><?php echo $store_name; ?></a></p>
          </li>
        <?php endwhile; ?>
      </ul>
    </section>
  <?php endif; wp_reset_postdata(); ?>

<?php endif; ?>