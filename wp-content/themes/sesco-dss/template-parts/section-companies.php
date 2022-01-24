<?php if (is_tax()) : ?>

  <?php $term = get_queried_object(); ?>
  <?php if (get_field('section_companies_show', $term)) : ?>
    <?php $companies = get_field('section_companies_companies', $term); ?>
    <?php $term_id = $term->term_id; ?>
    <?php $term_tax = get_term($term_id)->taxonomy; ?>

    <section class="companies">
      <div class="row ha-center">
        <div class="cell lg-100 ta-center">
          <h2 class="ba-center">
            <?php the_field('section_companies_headline', $term); ?>
            <?php echo is_user_logged_in() ? '<a href="' . get_edit_term_link($term_id, $term_tax) . '" class="post-edit-link">Edit this</a>' : ''; ?>
          </h2>
          <?php echo get_field('section_companies_subheadline', $term) ? '<p class="subhead ba-center">' . get_field('section_companies_subheadline', $term) . '</p>' : ''; ?>
          <?php if (have_rows('section_companies_companies', $term)) : ?>
            <div class="logos">
              <div class="splide__track">
                <ul class="splide__list">
                  <?php while (have_rows('section_companies_companies', $term)) : the_row(); ?>
                    <?php $logo = get_sub_field('company_logo', $term); ?>
                    <?php if (!empty($logo)) : ?>
                      <li class="splide__slide">
                        <div class="img-w">
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

    <section class="companies">
      <div class="row ha-center">
        <div class="cell lg-100 ta-center">
          <h2 class="ba-center">
            <?php the_field('section_companies_headline'); ?>
            <?php echo is_user_logged_in() ? edit_post_link() : ''; ?>
          </h2>
          <?php echo get_field('section_companies_subheadline') ? '<p class="subhead ba-center">' . get_field('section_companies_subheadline') . '</p>' : ''; ?>
          <?php if (have_rows('section_companies_companies')) : ?>
            <div class="logos">
              <div class="splide__track">
                <ul class="splide__list">
                  <?php while (have_rows('section_companies_companies')) : the_row(); ?>
                    <?php $logo = get_sub_field('company_logo'); ?>
                    <?php if (!empty($logo)) : ?>
                      <li class="splide__slide">
                        <div class="img-w">
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