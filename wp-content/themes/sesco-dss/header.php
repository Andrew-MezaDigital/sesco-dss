<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sesco-dss
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'sesco-dss' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="grid">
			<div class="grid-cell">
				<?php the_custom_logo(); ?>
			</div>
			<div class="grid-cell">
				<?php $args = array(
					'post_type' => 'stores',
				); 
				$stores = new WP_Query($args); ?>
				<?php if ($stores->have_posts()) : ?>
					<div class="grid up-2">
						<?php while ($stores->have_posts()) : $stores->the_post() ?>
							<div class="grid-cell">
								<p><?php the_title(); ?></p>
								<p><?php the_field('store_address'); ?><br>
								<?php the_field('store_email'); ?><br>
								<?php the_field('store_phone'); ?></p>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; wp_reset_postdata(); ?>
			</div>
		</div>

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'sesco-dss' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav>
	</header>
