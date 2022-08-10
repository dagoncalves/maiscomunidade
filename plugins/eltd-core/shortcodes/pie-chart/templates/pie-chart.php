<div class="eltd-pie-chart-holder">
	<div class="eltd-pc-percentage" <?php echo findme_elated_get_inline_attrs($pie_chart_data); ?>>
		<span class="eltd-pc-percent" <?php echo findme_elated_get_inline_style($percent_styles); ?>><?php echo esc_html($percent); ?></span>
	</div>
	<?php if(!empty($title) || !empty($text)) { ?>
		<div class="eltd-pc-text-holder">
			<?php if(!empty($title)) { ?>
				<<?php echo esc_attr($title_tag); ?> class="eltd-pc-title" <?php echo findme_elated_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
			<?php } ?>
			<?php if(!empty($text)) { ?>
				<p class="eltd-pc-text" <?php echo findme_elated_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
			<?php } ?>
		</div>
	<?php } ?>
</div>