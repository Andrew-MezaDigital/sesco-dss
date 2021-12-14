<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sesco-dss
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="footer-content">
			<div class="grid up-3">
				<div class="grid-cell">
					<h2>Connect with us</h2>
				</div>
				<div class="grid-cell">
					<h2>Our business hours</h2>
				</div>
				<div class="grid-cell">
					<h2>About us</h2>
				</div>
			</div>
		</div>
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'sesco-dss' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'sesco-dss' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'sesco-dss' ), 'sesco-dss', '<a href="https://mezadigital.io">Andrew Meza (Meza LLC)</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
