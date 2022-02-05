<?php if (is_front_page()) : ?>

  <?php
    $edit_page_link = get_edit_post_link(get_the_ID());
  ?>
  <section class="page-hero no-pt no-pb">
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
                    <?php $link = get_sub_field('carousel_slide_link'); ?>
                    <?php $link_url = $link['url']; ?>
                    <?php $link_title = $link['title'] ? $link['title'] : get_the_title(); ?>
                    <?php $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                    <div class="cnt">
                      <?php if ($custom_img) : ?>
                        <?php $src = $custom_img['sizes']['banner']; ?>
                        <?php $alt = $custom_img['alt']; ?>
                        <?php // Need to generate srcset for custom images ?>
                        <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="img-w square-xs-only slim-sm video-lg">
                          <img src="<?php echo esc_url($src); ?>" class="attachment-banner size-banner wp-post-image" alt="<?php echo esc_attr($alt); ?>" loading="lazy" srcset="" sizes="" />
                        </a>
                      <?php else : ?>
                        <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="img-w square-xs-only slim-sm video-lg">
                          <?php the_post_thumbnail('banner'); ?>
                        </a>
                      <?php endif; ?>
                      <div class="callout">
                        <div class="copy">
                          <h2>
                            <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo $title; ?></a>
                            <?php echo is_user_logged_in() ? '<a href="' . $edit_page_link . '" class="post-edit-link">Edit homepage "Content Slider" section</a>' : ''; ?>
                            <?php echo is_user_logged_in() ? '<a href="' . get_edit_post_link() . '" class="post-edit-link">Edit "' . get_the_title() . '" content</a>' : ''; ?>
                          </h2>
                          <?php echo $subhead ? '<p>' . $subhead . '</p>' : ''; ?>
                        </div>
                        <?php if ($link_title) : ?>
                          <div class="btn-group">
                            <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" title="<?php echo esc_html( $link_title ); ?>" class="btn"><?php echo $link_title; ?></a>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; wp_reset_postdata(); ?>
              </li>
            <?php endwhile; ?>
          </ul>
        </div>
      </div>
    <?php endif; ?>
  </section>

<?php elseif (is_tax()) : ?>

  <?php 
    $term = get_queried_object();
    $term_id = $term->term_id;
    $term_tax = get_term($term_id)->taxonomy;
    $image = get_field('category_image', $term);
    $excerpt = get_field('category_excerpt', $term);
  ?>
  <section class="page-hero">
    <div class="cnt">
      <div class="callout ta-center ta-left-md">
        <h1 class="page-title">
          <?php echo $term->name . '&nbsp;Services'; ?>
          <?php echo is_user_logged_in() ? '<a href="' . get_edit_term_link($term_id, $term_tax) . '" class="post-edit-link">Edit ' . get_the_archive_title($term) . ' category</a>' : ''; ?>
        </h1>
        <?php echo term_description($term_id) ? '<p class="subhead">' . term_description($term_id) . '</p>' : '' ?>
      </div>
      <div class="img-cnt">
        <div class="img-w slim square-md-only video-lg">
          <?php echo wp_get_attachment_image( $image, 'banner' ); ?>
        </div>
      </div>
    </div>
  </section>

<?php else : ?>

  <section class="page-hero">
    <div class="cnt">
      <div class="callout ta-center ta-left-md">
        <h1 class="page-title">
          <?php the_title(); ?>
          <?php echo is_user_logged_in() ? edit_post_link('Edit this page') : ''; ?>
        </h1>
        <?php echo has_excerpt() ? '<p class="subhead">' . get_the_excerpt() . '</p>' : '' ?>
      </div>
      <div class="img-cnt">
        <div class="img-w slim square-md-only video-lg">
          <?php the_post_thumbnail('banner'); ?>
        </div>
      </div>
    </div>
  </section>

<?php endif; ?>