<?php
/**
 * Default services page
 */

get_header();
?>

	<main id="primary" class="site-main">

        <?php
			get_template_part( 'template-parts/section', 'hero');
			get_template_part( 'template-parts/section', 'services');
		?>

	</main>

<?php
get_footer();
