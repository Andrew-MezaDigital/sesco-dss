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
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-D49Y7KRY3M"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-D49Y7KRY3M');
	</script>
	<?php wp_head(); ?>
	<script src="https://kit.fontawesome.com/c6c193bd70.js" crossorigin="anonymous"></script>
</head>

<body <?php body_class('preload'); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PCV5TWK"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'sesco-dss' ); ?></a>
	<?php
	$args = array(
		'post_type' => 'stores',
	); 
	$stores = new WP_Query($args);
	?>
	<?php if ($stores->have_posts()) : ?>
		<div class="top-bar">
			<div class="row expand ha-center va-center ac-center">
				<?php while ($stores->have_posts()) : $stores->the_post() ?>
					<div class="store cell auto">
					
						<p><?php the_title(); ?></p>
						<nav>
							<ul class="menu menu-x">
								<li class="menu-item">
									<a href="tel:<?php echo urlencode(the_field('store_phone')); ?>" class="fas fa-phone-alt">
										<span class="screen-reader-text">Phone</span>
										<span class="show-md"><?php the_field('store_phone'); ?></span>
									</a>
								</li>
								<li class="menu-item">
									<a href="mailto:<?php urlencode(the_field('store_email')); ?>" class="fas fa-envelope">
										<span class="screen-reader-text">Email</span>
										<span class="show-lg"><?php the_field('store_email'); ?></span>
									</a>
								</li>
								<li class="menu-item">
									<a href="<?php the_field('store_google_maps_url'); ?>" target="_blank" class="fas fa-map-marker">
										<span class="screen-reader-text">Address</span>
										<span class="show-lg"><?php the_field('store_address'); ?></span>
									</a>
								</li>
							</ul>
						</nav>					
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	<?php endif; wp_reset_postdata(); ?>

	<header id="masthead" class="site-header">
		<div class="row expand ha-between va-center no-pad">
			<div class="logo cell fill">
				<?php the_custom_logo(); ?>
				<?php echo is_user_logged_in() ? '<a href="' . site_url() . '/wp-admin/customize.php" class="post-edit-link">Edit logo</a>' : ''; ?>
			</div>
			<div class="nav cell auto sm-fill">
				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle btn has-icon" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'sesco-dss' ); ?><span class="fas fa-bars"></span></button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
				</nav>
				<?php echo is_user_logged_in() ? '<a href="' . site_url() . '/wp-admin/nav-menus.php?action=edit&menu=8" class="post-edit-link">Edit menu</a>' : ''; ?>
			</div>
		</div>
	</header>
