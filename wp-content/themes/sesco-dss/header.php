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
	<div class="top-bar">
		<div class="row">
			<div class="cell fill">
				<?php $args = array(
					'post_type' => 'stores',
				); 
				$stores = new WP_Query($args); ?>
				<?php if ($stores->have_posts()) : ?>
					<div class="row ha-end">
						<?php while ($stores->have_posts()) : $stores->the_post() ?>
							<div class="cell">
								<div class="row compact va-center">
									<div class="cell">
										<p><?php the_title(); ?></p>
									</div>
									<nav class="cell">
										<ul class="menu">
											<li class="menu-item"><a href="tel:<?php urlencode(the_field('store_phone')); ?>" class="icon">C</a></li>
											<li class="menu-item"><a href="mailto:<?php urlencode(the_field('store_email')); ?>" class="icon">M</a></li>
											<li class="menu-item"><a href="<?php urlencode(the_field('store_google_maps_url')); ?>" target="_blank" class="icon">V</a></li>
										</ul>
									</nav>
								</div>						
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
	<header id="masthead" class="site-header">
		<div class="row">
			<div class="cell">
				<?php the_custom_logo(); ?>
			</div>
			<div class="cell">
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
			</div>
		</div>

		
	</header>
