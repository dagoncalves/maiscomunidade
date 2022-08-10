<?php echo eltd_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/image', $item_style, $params); ?>

<div class="eltd-pli-text-holder">
	<div class="eltd-pli-text-wrapper">
		<div class="eltd-pli-text">
			<?php echo eltd_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/title', $item_style, $params); ?>
			
			<?php echo eltd_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/category', $item_style, $params); ?>
			
			<?php echo eltd_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/excerpt', $item_style, $params); ?>
		</div>
	</div>
</div>