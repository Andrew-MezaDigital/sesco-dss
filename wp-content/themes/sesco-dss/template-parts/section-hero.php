<?php if (is_front_page()) : ?>

<section class="page-hero">
  <div class="row">
    <div class="cell">
      <h1 class="page-title screen-reader-text"><?php the_title(); ?></h1>
      <p class="page-excerpt screen-reader-text"><?php echo get_the_excerpt(); ?></p>
      <?php if (have_rows('carousel_slides')) : ?>
        <div class="splide">
          <div class="splide__track">
        <ul class="splide__list">
          <?php while (have_rows('carousel_slides')) : the_row(); ?>
            <li class="splide__slide">
              <?php $slide_reference = get_sub_field('carousel_slide_reference'); ?>
              <?php if ($slide_reference) : ?>
                <?php foreach($slide_reference as $post) : ?>
                  <?php setup_postdata($post); ?>
                  <?php $title = get_sub_field('carousel_slide_heading') ? get_sub_field('carousel_slide_heading') : get_the_title(); ?>
                  <?php $subhead = get_sub_field('carousel_slide_subheading') ? get_sub_field('carousel_slide_subheading') : get_the_excerpt(); ?>
                  <?php $custom_img = get_sub_field('carousel_slide_image'); ?>
                  <?php $cta_text = get_sub_field('carousel_slide_cta'); ?>
                  <h2><?php echo $title; ?></h2>
                  <?php echo $subhead ? '<p>' . $subhead . '</p>' : ''; ?>
                  <?php if ($custom_img) : ?>
                    <?php $src = $custom_img['sizes']['banner']; ?>
                    <?php $alt = $custom_img['alt']; ?>
                    <!-- Need to generate srcset for custom images -->
                    <img src="<?php echo esc_url($src); ?>" class="attachment-banner size-banner wp-post-image" alt="<?php echo esc_attr($alt); ?>" loading="lazy" srcset="" sizes="" />
                  <?php elseif (get_the_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('banner'); ?>
                  <?php else : ?>
                    <p class="help-text">Please add an image to this homepage slide through the content reference's featured image or using the custom image field for the slide.</p>
                  <?php endif; ?>
                  <?php if ($cta_text) : ?>
                    <?php $custom_link = get_sub_field('carousel_slide_link'); ?>
                      <?php if ($custom_link) : ?>
                        <?php $link_url = $custom_link['url']; ?>
                        <?php $link_title = $custom_link['title']; ?>
                        <?php $link_target = $custom_link['target'] ? $custom_link['target'] : '_self'; ?>
	                      <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" title="<?php echo esc_html( $link_title ); ?>"><?php echo $cta_text; ?></a>
                      <?php else : ?>
	                      <a href="<?php echo get_the_permalink(); ?>" target="_self" title="<?php echo esc_html( $link_title ); ?>"><?php echo $cta_text; ?></a>
                      <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
              <?php endif; wp_reset_postdata(); ?>
            </li>
          <?php endwhile; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php else : ?>

<section class="page-hero" style="background-image:url('<?php echo 'the image'; ?>');">
  <div class="row">
      <div class="cell">
          <h1 class="page-title"><?php the_title(); ?></h1>
      </div>
  </div>
</section>

<?php endif; ?>