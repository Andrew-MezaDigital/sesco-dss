<?php $args = array(
  'post_type' => 'work',
  'orderby' => 'date',
  'order' => 'DESC'
); 
$work = new WP_Query($args);
$work_url = site_url() . get_field('section_work_url');
$work_cta = get_field('section_work_cta');
$work_title = get_field('section_work_header');
$edit_homepage_link = get_edit_post_link(get_the_ID());
?>

<?php if ($work->have_posts()) : ?>
  <section id="latest-work">
    <div class="row mb ha-between va-center">
      <div class="cell auto">
        <h2>
          <a href="<?php echo $work_url . '#latest-work'; ?>"><?php echo $work_title ? $work_title : 'Our Latest Work Samples'; ?></a>
          <?php echo is_user_logged_in() ? '<a href="' . $edit_homepage_link . '" class="post-edit-link">Edit this content</a>' : ''; ?>
        </h2>
      </div>
      <div class="cell auto">
        <a href="<?php echo $work_url . '#latest-work'; ?>" class="btn secondary"><?php echo $work_cta ? $work_cta : 'Our Latest Work Samples'; ?>&nbsp;&raquo;</a>
        <?php echo is_user_logged_in() ? '<a href="' . $edit_homepage_link . '" class="post-edit-link">Edit this content</a>' : ''; ?>
      </div>
    </div>
    <ul class="grid up-4">
      <?php while ($work->have_posts()) : $work->the_post(); ?>
        <li id="work-<?php echo get_the_ID(); ?>" class="cell">
          <?php $work_item_url = $work_url . '#work-' . get_the_ID(); ?>
          <a href="<?php echo $work_url_url; ?>" class="img-w"><?php the_post_thumbnail(); ?></a>
          <h3 class="line-break">
            <a href="<?php echo $work_url_url; ?>"><?php the_title(); ?></a>
            <?php echo is_user_logged_in() ? edit_post_link('Edit this content') : ''; ?>
          </h3>
          <?php the_excerpt(); ?>
        </li>
      <?php endwhile; ?>
    </ul>
  </section>
<?php endif; wp_reset_postdata(); ?>