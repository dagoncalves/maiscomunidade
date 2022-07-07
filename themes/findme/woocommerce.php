<?php 
/*
Template Name: WooCommerce
*/ 
?>
<?php
$eltd_sidebar_layout  = findme_elated_sidebar_layout();

get_header();
findme_elated_get_title();
get_template_part('slider');

//Woocommerce content
if ( ! is_singular('product') ) { ?>
	<div class="eltd-container">
		<div class="eltd-container-inner clearfix">
			<div class="eltd-grid-row">
				<div <?php echo findme_elated_get_content_sidebar_class(); ?>>
					<?php findme_elated_woocommerce_content(); ?>
				</div>
				<?php if($eltd_sidebar_layout !== 'no-sidebar') { ?>
					<div <?php echo findme_elated_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>			
<?php } else { ?>
	<div class="eltd-full-width">
		<div class="eltd-full-width-inner clearfix">
			<?php findme_elated_woocommerce_content(); ?>
		</div>
	</div>
<?php } ?>
<?php get_footer(); ?>