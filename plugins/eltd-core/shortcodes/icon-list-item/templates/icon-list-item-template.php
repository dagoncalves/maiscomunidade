<?php $icon_html = findme_elated_icon_collections()->renderIcon($icon, $icon_pack, $params); ?>
<div class="eltd-icon-list-holder" <?php echo findme_elated_get_inline_style($holder_styles); ?>>
	<div class="eltd-il-icon-holder">
		<?php echo wp_kses_post($icon_html);	?>
	</div>
	<p class="eltd-il-text" <?php echo findme_elated_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></p>
</div>