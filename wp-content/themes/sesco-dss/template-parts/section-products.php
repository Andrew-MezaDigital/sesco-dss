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