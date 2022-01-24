<?php if (is_front_page()) : ?>

  <?php $edit_homepage_link = get_edit_post_link($post->ID); ?>
  <section class="page-hero no-pt no-pb">
    <div class="row">
      <div class="cell fill">
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
                        <?php $custom_link = get_sub_field('carousel_slide_link'); ?>
                        <?php $link_url = $custom_link ? $custom_link['url'] : get_the_permalink(); ?>
                        <?php $link_title = $custom_link ? $custom_link['title'] : get_the_title(); ?>
                        <?php $link_target = $custom_link ? $custom_link['target'] : '_self'; ?>
                        <div class="bar-w">
                          <div class="bar">
                            <div class="copy">
                              <h2>
                                <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo $title; ?></a>
                                <?php echo is_user_logged_in() ? edit_post_link('Edit this content') : ''; ?>
                              </h2>
                              <?php echo $subhead ? '<p>' . $subhead . '</p>' : ''; ?>
                            </div>
                            <?php if ($cta_text) : ?>
                              <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" title="<?php echo esc_html( $link_title ); ?>" class="btn"><?php echo $cta_text; ?></a>
                              <!-- Need to update to on-page link to repeater content -->
                              <?php echo is_user_logged_in() ? '<a href="' . $edit_homepage_link . '" class="post-edit-link">Edit this slide</a>' : ''; ?>
                            <?php endif; ?>
                          </div>
                        </div>
                        <?php if ($custom_img) : ?>
                          <?php $src = $custom_img['sizes']['banner']; ?>
                          <?php $alt = $custom_img['alt']; ?>
                          <!-- Need to generate srcset for custom images -->
                          <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="img-w">
                            <img src="<?php echo esc_url($src); ?>" class="attachment-banner size-banner wp-post-image" alt="<?php echo esc_attr($alt); ?>" loading="lazy" srcset="" sizes="" />
                          </a>
                        <?php elseif (get_the_post_thumbnail()) : ?>
                          <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="img-w">
                            <?php the_post_thumbnail('banner'); ?>
                          </a>
                        <?php else : ?>
                          <p class="help-text">Please add an image to this homepage slide through the content reference's featured image or using the custom image field for the slide.</p>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    <?php endif; wp_reset_postdata(); ?>
                  </li>
                <?php endwhile; ?>
              </ul>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

<?php elseif (is_tax()) : ?>

  <?php $term = get_queried_object(); ?>
  <?php $image = get_field('category_image', $term); ?>
  <?php $excerpt = get_field('category_excerpt', $term); ?>
  <section class="page-hero" style="background-image:url('<?php echo $image['url']; ?>');">
    <div class="row">
        <div class="cell lg-50">
            <div class="bar">
              <h1 class="page-title">
                <?php echo $term->name . '&nbsp;Services'; ?>
                <?php echo is_user_logged_in() ? '<a href="' . site_url() . '/wp-admin/term.php?taxonomy=' . $term->taxonomy .'&tag_ID=' . $term->term_id . '" class="post-edit-link">Edit this content</a>' : ''; ?>
              </h1>
              <?php echo $excerpt ? '<p class="subhead">' . $excerpt . '</p>' : '' ?>
            </div>
        </div>
    </div>
  </section>

<?php else : ?>

  <section class="page-hero" style="background-image:url('<?php echo get_the_post_thumbnail_url($post, 'banner'); ?>');">
    <div class="row">
        <div class="cell lg-50">
            <div class="bar">
              <h1 class="page-title">
                <?php the_title(); ?>
                <?php echo is_user_logged_in() ? edit_post_link('Edit this content') : ''; ?>
              </h1>
              <?php echo has_excerpt() ? '<p class="subhead">' . get_the_excerpt() . '</p>' : '' ?>
            </div>
        </div>
    </div>
  </section>

<?php endif; ?>