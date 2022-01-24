<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sesco-dss
 */

?>

<?php 
	get_template_part( 'template-parts/section', 'hero');
	get_template_part( 'template-parts/section', 'companies');
?>

<section class="entry-content">
	<div class="row ha-center">
		<div class="cell auto">
			<?php the_content(); ?>
		</div>
	</div>
</section>

<?php $stores = new WP_Query(array('post_type' => 'stores')); ?>
<?php if ($stores->have_posts()) : ?>
	<section class="stores-info">
		<div class="row">
			<h2 class="screen-reader-text">Our Stores</h2>
			<?php while ($stores->have_posts()) : $stores->the_post(); ?>
				<?php $store_photo = get_field('store_photo'); ?>
				<div class="cell lg-50">
					<h3><?php the_title(); ?></h3>
					<iframe width="600" height="250" style="border:0" loading="lazy" allowfullscreen src="https://www.google.com/maps/embed/v1/place?q=<?php echo urlencode(get_field('store_address')); ?>&key=AIzaSyDx4NdBfDH3awgzkVFLMEAPbE5Gge3IgtU"></iframe>
					<?php if (has_post_thumbnail()) : ?>
						<h4>Store Front</h4>
						<div class="img-w slim">
							<?php the_post_thumbnail(); ?>
						</div>
					<?php endif; ?>
					<div class="row">
						<div class="cell fill">
							<?php if (have_rows('store_hours')) : ?>
								<h4>Business Hours</h4>
								<table class="store-hours">
									<tbody>
										<?php while (have_rows('store_hours')) : the_row(); ?>
											<tr>
												<th><?php the_sub_field('store_hours_day'); ?></th>
												<td><?php echo get_sub_field('store_hours_open') . " - " . get_sub_field('store_hours_close'); ?></td>
											</tr>
										<?php endwhile; ?>
									</tbody>
								</table>
							<?php endif; ?>
						</div>
						<div class="cell auto">
							<h4>Phone</h4>
							<p class="line-break"><a href="tel:<?php the_field('store_phone'); ?>" title="Call the <?php echo get_the_title(); ?>"><span class="fas fa-phone-alt"></span>Call us</a></p>
						</div>
						<div class="cell auto">
							<h4>Email</h4>
							<p class="line-break"><a href="mailto:<?php the_field('store_email'); ?>" title="Email the <?php echo get_the_title(); ?>"><span class="fas fa-envelope"></span>Email us</a></p>
						</div>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</section>
<?php endif; ?>

<?php get_template_part( 'template-parts/section', 'cta'); ?>
