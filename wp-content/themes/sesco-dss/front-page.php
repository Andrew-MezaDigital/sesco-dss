<?php
/**
 * The homepage template
 */

get_header();
?>

	<main id="primary" class="site-main">

        <?php
			get_template_part( 'template-parts/section', 'hero');
			get_template_part( 'template-parts/section', 'categories');
			get_template_part( 'template-parts/section', 'companies');
		?>
		<section id="latest" class="bg-secondary">
			<?php
				get_template_part( 'template-parts/section', 'work');
				get_template_part( 'template-parts/section', 'products');
			?>
		</section>
		<?php 
			get_template_part( 'template-parts/section', 'cta');
		?>

	</main>

<?php
get_footer();
