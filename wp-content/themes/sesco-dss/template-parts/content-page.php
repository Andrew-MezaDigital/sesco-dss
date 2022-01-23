<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sesco-dss
 */

?>

<?php get_template_part( 'template-parts/section', 'hero'); ?>

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
				<div class="cell fill">
					<h3><?php the_title(); ?></h3>
					<ul class="store-info">
						<li><?php the_field('store_phone'); ?></li>
						<li><?php the_field('store_email'); ?></li>
						<li>
					</ul>
					<iframe width="600" height="450" style="border:0" loading="lazy" allowfullscreen src="https://www.google.com/maps/embed/v1/place?q=<?php echo urlencode(get_field('store_address')); ?>&key=AIzaSyDx4NdBfDH3awgzkVFLMEAPbE5Gge3IgtU"></iframe>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</section>
<?php endif; ?>
