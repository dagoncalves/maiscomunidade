<div class="eltd-eh-item <?php echo esc_attr($elements_holder_item_class); ?>" <?php echo findme_elated_get_inline_style($elements_holder_item_style); ?> <?php echo findme_elated_get_inline_attrs($elements_holder_item_responsive_data); ?>>
	<div class="eltd-eh-item-inner">
		<div class="eltd-eh-item-content <?php echo esc_attr($elements_holder_item_content_class); ?>" <?php echo findme_elated_get_inline_style($elements_holder_item_content_style); ?>>
			<?php echo do_shortcode($content); ?>
		</div>
	</div>
</div>