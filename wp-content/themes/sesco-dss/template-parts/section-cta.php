<?php if (is_tax()) : ?>

  <?php $term = get_queried_object(); ?>
  <?php if (get_field('section_cta_show', $term)) : ?>
    <?php $link = get_field('section_cta_link', $term);?>
    <?php $term_id = $term->term_id; ?>
    <?php $term_tax = get_term($term_id)->taxonomy; ?>

    <section class="page-cta">
      <div class="row ha-center">
        <div class="cell auto ta-center">
          <h2 class="alt ba-center">
            <?php the_field('section_cta_headline', $term); ?>
            <?php echo is_user_logged_in() ? '<a href="' . get_edit_term_link($term_id, $term_tax) . '" class="post-edit-link">Edit ' . $term->name . ' category</a>' : ''; ?>
          </h2>
          <?php if ($link): ?>
            <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo $link['target'] ? esc_attr($link['target']) : '_self'; ?>" class="btn primary ba-center"><?php echo esc_html($link['title']); ?></a>
          <?php endif; ?>
        </div>
      </div>
    </section>

  <?php endif; ?>

<?php else : ?>

  <?php if (get_field('section_cta_show')) : ?>
    <?php
      $link = get_field('section_cta_link');
      $edit_page_link = get_edit_post_link(get_the_ID());
      $field_groups = acf_get_field_groups($filter);
      $link_field_group_id = get_field_object('section_cta_link')['parent'];
      if ($field_groups) :
        foreach ($field_groups as $field_group) :
          if ($field_group['ID'] == $link_field_group_id) :
            $edit_page_link = $edit_page_link . '#acf-' . $field_group['key'];
            break;
          endif;
        endforeach;
      endif;
    ?>

    <section class="page-cta">
      <div class="row ha-center">
        <div class="cell auto ta-center">
          <h2 class="alt ba-center">
            <?php the_field('section_cta_headline'); ?>
            <?php echo is_user_logged_in() ? '<a href="' . $edit_page_link . '" class="post-edit-link">Edit homepage "Page CTA" section</a>' : ''; ?>
          </h2>
          <?php if ($link): ?>
            <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo $link['target'] ? esc_attr($link['target']) : '_self'; ?>" class="btn primary ba-center"><?php echo esc_html($link['title']); ?></a>
          <?php endif; ?>
        </div>
      </div>
    </section>

  <?php endif; ?>

<?php endif; ?>