<div class="eltd-progress-bar">
	<<?php echo esc_attr($title_tag); ?> class="eltd-pb-title-holder" <?php echo findme_elated_inline_style($title_styles); ?>>
		<span class="eltd-pb-title"><?php echo esc_html($title); ?></span>
		<span class="eltd-pb-percent">0</span>
	</<?php echo esc_attr($title_tag); ?>>
	<div class="eltd-pb-content-holder" <?php echo findme_elated_inline_style($inactive_bar_style); ?><?php echo findme_elated_inline_style($border_styles); ?>>
		<div data-percentage=<?php echo esc_attr($percent); ?> class="eltd-pb-content" <?php echo findme_elated_inline_style($active_bar_style); ?>></div>
	</div>
</div>