<?php if (is_tax()) : ?>

  <?php $term = get_queried_object(); ?>
  <?php if (get_field('section_cta_show', $term)) : ?>
    <?php $link = get_field('section_cta_link', $term);?>
    <?php $term_id = $term->term_id; ?>
    <?php $term_tax = get_term($term_id)->taxonomy; ?>

    <section class="page-cta bg-primary">
      <div class="row ha-center">
        <div class="cell auto ta-center">
          <h2 class="ba-center">
            <?php the_field('section_cta_headline', $term); ?>
            <?php echo is_user_logged_in() ? '<a href="' . get_edit_term_link($term_id, $term_tax) . '" class="post-edit-link">Edit this</a>' : ''; ?>
          </h2>
          <?php if ($link): ?>
            <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo $link['target'] ? esc_attr($link['target']) : '_self'; ?>" class="btn secondary ba-center"><?php echo esc_html($link['title']); ?></a>
          <?php endif; ?>
        </div>
      </div>
    </section>

  <?php endif; ?>

<?php else : ?>

  <?php if (get_field('section_cta_show')) : ?>
    <?php $link = get_field('section_cta_link');?>

    <section class="page-cta bg-primary">
      <div class="row ha-center">
        <div class="cell auto ta-center">
          <h2 class="ba-center">
            <?php the_field('section_cta_headline'); ?>
            <?php echo is_user_logged_in() ? edit_post_link() : ''; ?>
          </h2>
          <?php if ($link): ?>
            <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo $link['target'] ? esc_attr($link['target']) : '_self'; ?>" class="btn secondary ba-center"><?php echo esc_html($link['title']); ?></a>
          <?php endif; ?>
        </div>
      </div>
    </section>

  <?php endif; ?>

<?php endif; ?>