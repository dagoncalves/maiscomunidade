<div class="eltd-counter-holder">
	<div class="eltd-counter-inner">
		<?php if(!empty($digit)) { ?>
			<span class="eltd-counter <?php echo esc_attr($type) ?>" <?php echo findme_elated_get_inline_style($counter_styles); ?>><?php echo esc_html($digit); ?></span>
		<?php } ?>
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="eltd-counter-title" <?php echo findme_elated_get_inline_style($counter_title_styles); ?>>
				<?php echo esc_html($title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<p class="eltd-counter-text" <?php echo findme_elated_get_inline_style($counter_text_styles); ?>><?php echo esc_html($text); ?></p>
		<?php } ?>
	</div>
</div>