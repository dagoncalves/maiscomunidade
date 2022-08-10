<<?php echo esc_attr($title_tag); ?> class="eltd-title-holder">
    <span class="eltd-accordion-mark">
        <?php echo findme_elated_icon_collections()->renderIcon( 'icon-arrow-down-circle eltd_icon_plus', 'simple_line_icons' ); ?>
        <?php echo findme_elated_icon_collections()->renderIcon( 'icon-arrow-up-circle eltd_icon_minus', 'simple_line_icons' ); ?>
	</span>
	<span class="eltd-tab-title"><?php echo esc_html($title); ?></span>
</<?php echo esc_attr($title_tag); ?>>
<div class="eltd-accordion-content">
	<div class="eltd-accordion-content-inner">
		<?php echo do_shortcode($content); ?>
	</div>
</div>