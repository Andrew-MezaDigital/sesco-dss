<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package sesco-dss
 */

get_header();
?>

	<main id="primary" class="site-main">

		<div class="error-404">
			<header class="not-found">
				<h1 class="text-404"><?php esc_html_e( 'Uh-oh!', 'sesco-dss' ); ?></h1>
				<p class="text-error"><?php esc_html_e( '404 error. Page not found.', 'sesco-dss'); ?></p>
			</header>
			<section class="return-home">
				<p>We were unable to find the page you were looking for.</p>
				<a href="/" class="btn">Return to Homepage</a>
			</section>
		</div>

	</main>

<?php
get_footer();
