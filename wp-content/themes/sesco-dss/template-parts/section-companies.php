<?php if (is_tax()) : ?>

  <?php $term = get_queried_object(); ?>
  <?php if (get_field('section_companies_show', $term)) : ?>
    <?php $companies = get_field('section_companies_companies', $term); ?>
    <?php $term_id = $term->term_id; ?>
    <?php $term_tax = get_term($term_id)->taxonomy; ?>

    <section class="companies">
      <div class="row expand ha-center">
        <div class="cell lg-100 ta-center">
          <h2 class="alt ba-center">
            <?php the_field('section_companies_headline', $term); ?>
            <?php echo is_user_logged_in() ? '<a href="' . get_edit_term_link($term_id, $term_tax) . '" class="post-edit-link">Edit ' . get_the_archive_title()  . ' category</a>' : ''; ?>
          </h2>
          <?php if (have_rows('section_companies_companies', $term)) : ?>
            <div class="logos">
              <div class="splide__track">
                <ul class="splide__list">
                  <?php while (have_rows('section_companies_companies', $term)) : the_row(); ?>
                    <?php $logo = get_sub_field('company_logo', $term); ?>
                    <?php if (!empty($logo)) : ?>
                      <li class="splide__slide">
                        <div class="img-w has-logo">
                          <img src="<?php echo esc_url($logo['sizes']['medium']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" class="logo" />
                        </div>
                        <h3 class="screen-reader-text"><?php echo get_sub_field('company_name', $term); ?></h3>
                      </li>
                    <?php endif; ?>
                  <?php endwhile; ?>
                </ul>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

  <?php endif; ?>

<?php else : ?>

  <?php if (get_field('section_companies_show')) : ?>
    <?php
      $edit_page_link = get_edit_post_link(get_the_ID());
      $field_groups = acf_get_field_groups($filter);
      $title_field_group_id = get_field_object('section_companies_headline')['parent'];
      if ($field_groups) :
        foreach ($field_groups as $field_group) :
          if ($field_group['ID'] == $title_field_group_id) :
            $edit_page_link = $edit_page_link . '#acf-' . $field_group['key'];
            break;
          endif;
        endforeach;
      endif;
    ?>

    <section class="companies">
      <div class="row expand ha-center">
        <div class="cell lg-100 ta-center">
          <h2 class="alt ba-center">
            <?php the_field('section_companies_headline'); ?>
            <?php echo is_user_logged_in() ? '<a href="' . $edit_page_link . '" class="post-edit-link">Edit homepage "Logo Slider" section</a>' : ''; ?>
          </h2>
          <?php if (have_rows('section_companies_companies')) : ?>
            <div class="logos">
              <div class="splide__track">
                <ul class="splide__list">
                  <?php while (have_rows('section_companies_companies')) : the_row(); ?>
                    <?php $logo = get_sub_field('company_logo'); ?>
                    <?php if (!empty($logo)) : ?>
                      <li class="splide__slide">
                        <div class="img-w has-logo">
                          <img src="<?php echo esc_url($logo['sizes']['medium']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" class="logo" />
                        </div>
                        <h3 class="screen-reader-text"><?php echo get_sub_field('company_name'); ?></h3>
                      </li>
                    <?php endif; ?>
                  <?php endwhile; ?>
                </ul>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

  <?php endif; ?>

<?php endif; ?>