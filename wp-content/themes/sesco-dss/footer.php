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
			<div class="grid ha-around up-1 up-2-sm up-4-lg">
				<?php $args = array(
					'post_type' => 'stores',
				); 
				$stores = new WP_Query($args); ?>
				<?php if ($stores->have_posts()) : ?>
					<?php while ($stores->have_posts()) : $stores->the_post() ?>
						<div class="store cell">
							<h2>
								<?php the_title(); ?>
								<?php echo is_user_logged_in() ? edit_post_link('Edit store') : ''; ?>
							</h2>
							<?php if (have_rows('store_hours')) : ?>
								<table class="store-hours">
									<tbody>
										<?php while (have_rows('store_hours')) : the_row(); ?>
											<?php $curr_open_time = get_sub_field('store_hours_open'); ?>
											<?php $curr_close_time = get_sub_field('store_hours_close'); ?>
											<tr>
												<th><?php the_sub_field('store_hours_day'); ?></th>
												<td><?php echo $curr_open_time . " - " . $curr_close_time; ?></td>
											</tr>
										<?php endwhile; ?>
									</tbody>
								</table>
							<?php endif; wp_reset_postdata(); ?>
						</div>
					<?php endwhile; ?>
				<?php endif; wp_reset_postdata(); ?>
				<div class="cell">
					<h2>
						Connect with Us
						<?php echo is_user_logged_in() ? '<a href="' . site_url() . '/wp-admin/nav-menus.php?action=edit&menu=10" class="post-edit-link">Edit social media links</a>' : ''; ?>
					</h2>
					<?php wp_nav_menu( array( 'menu' => 'Social Menu' )); ?>
				</div>
				<div class="cell">
					<h2>
						About Us
						<?php echo is_user_logged_in() ? '<a href="' . site_url() . '/wp-admin/customize.php" class="post-edit-link">Edit company description</a>' : ''; ?>
					</h2>
					<p class="site-description"><?php bloginfo('description', 'display'); ?></p>
				</div>
			</div>
		</div>
		<div class="site-info">
			<div class="row">
				<div class="cell fill">
					<p class="copyright">Copyright&nbsp;©&nbsp;<?php echo date("Y"); ?> SESCO-DSS. All rights reserved.</p>
					<p class="credit">This custom Wordpress theme was designed and built by <a href="https://mezadigital.io" target="_blank" rel="nofollow">Meza</a>.</p>
				</div>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
