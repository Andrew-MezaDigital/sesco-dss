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
	<script src="https://kit.fontawesome.com/c6c193bd70.js" crossorigin="anonymous"></script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'sesco-dss' ); ?></a>
	<div class="top-bar">
		<div class="row expand no-pad va-center">
			<div class="cell fill">
				<?php $args = array(
					'post_type' => 'stores',
				); 
				$stores = new WP_Query($args); ?>
				<?php if ($stores->have_posts()) : ?>
					<div class="row expand ha-end va-center">
						<?php while ($stores->have_posts()) : $stores->the_post() ?>
							<div class="store cell auto">
								<p><?php the_title(); ?></p>
								<nav>
									<ul class="menu">
										<li class="menu-item"><a href="tel:<?php urlencode(the_field('store_phone')); ?>" class="fas fa-phone-alt"></a></li>
										<li class="menu-item"><a href="mailto:<?php urlencode(the_field('store_email')); ?>" class="fas fa-envelope"></a></li>
										<li class="menu-item"><a href="<?php urlencode(the_field('store_google_maps_url')); ?>" target="_blank" class="fas fa-map-marker-alt"></a></li>
									</ul>
								</nav>					
							</div>
						<?php endwhile; ?>
						<div class="cell auto">
							<a href="<?php echo site_url() . '/upload-files'; ?>" title="Submit a Project">Upload Files</a>
						</div>
					</div>
				<?php endif; wp_reset_postdata(); ?>
			</div>
		</div>
	</div>

	<header id="masthead" class="site-header">
		<div class="row expand ha-between va-center no-pad">
			<div class="logo cell auto">
				<?php the_custom_logo(); ?>
				<?php echo is_user_logged_in() ? '<a href="' . site_url() . '/wp-admin/customize.php" class="post-edit-link">Edit this</a>' : ''; ?>
			</div>
			<div class="nav cell auto">
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
				<?php echo is_user_logged_in() ? '<a href="' . site_url() . '/wp-admin/nav-menus.php?action=edit&menu=8" class="post-edit-link">Edit this</a>' : ''; ?>
			</div>
		</div>
	</header>
