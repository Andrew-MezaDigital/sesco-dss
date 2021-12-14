<?php
/**
 * The homepage template
 */

get_header();
?>

	<main id="primary" class="site-main">

        <?php get_template_part( 'template-parts/section', 'hero') ?>

		<?php get_template_part( 'template-parts/section', 'categories') ?>

	</main>

<?php
get_footer();
