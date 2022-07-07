<?php
$masonry_image_size = get_post_meta(get_the_ID(), 'eltd_product_featured_image_size', true);
if(empty($masonry_image_size)) {
	$masonry_image_size = '';
}
?>
<div class="eltd-pli <?php echo esc_html($masonry_image_size); ?>">
	<div class="eltd-pli-inner">
		<div class="eltd-pli-image">
			<?php findme_elated_get_module_template_part('templates/parts/image', 'woocommerce', '', $params); ?>
		</div>
		<div class="eltd-pli-text" <?php echo findme_elated_get_inline_style($shader_styles); ?>>
			<div class="eltd-pli-text-outer">
				<div class="eltd-pli-text-inner">
					<?php findme_elated_get_module_template_part('templates/parts/title', 'woocommerce', '', $params); ?>
					
					<?php findme_elated_get_module_template_part('templates/parts/category', 'woocommerce', '', $params); ?>
					
					<?php findme_elated_get_module_template_part('templates/parts/excerpt', 'woocommerce', '', $params); ?>
					
					<?php findme_elated_get_module_template_part('templates/parts/rating', 'woocommerce', '', $params); ?>
					
					<?php findme_elated_get_module_template_part('templates/parts/price', 'woocommerce', '', $params); ?>
					
					<?php findme_elated_get_module_template_part('templates/parts/add-to-cart', 'woocommerce', '', $params); ?>
				</div>
			</div>
		</div>
		<a class="eltd-pli-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
</div>