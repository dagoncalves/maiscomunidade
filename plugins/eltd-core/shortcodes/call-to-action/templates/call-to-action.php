<?php
    $button_params = array(
        'text' => esc_html($button_text),
        'size' => 'small',
        'icon_pack' => 'font_elegant',
        'fe_icon'   => 'arrow_carrot-right',
        'color'                  => $button_color,
        'hover_color'            => $button_hover_color,
        'background_color'       => $button_background_color,
        'hover_background_color' => $button_hover_background_color,
        'icon_bck_color'         => $icon_bck_color,
        'icon_bck_hover_color'   => $icon_bck_hover_color,
        'link'                   => $button_link,
        'target'                 => $button_target
    );
?>

<div class="eltd-call-to-action-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="eltd-cta-inner <?php echo esc_attr($inner_classes); ?>">
		<div class="eltd-cta-text-holder">
			<div class="eltd-cta-text"><?php echo do_shortcode($content); ?></div>
		</div>
		<div class="eltd-cta-button-holder" <?php echo findme_elated_get_inline_style($button_holder_styles); ?>>
                <?php
                echo findme_elated_get_button_html($button_params);
                ?>
		</div>
	</div>
</div>