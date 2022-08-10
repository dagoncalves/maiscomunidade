<div class="eltd-google-map-holder">
	<div class="eltd-google-map" id="<?php echo esc_attr($map_id); ?>" <?php echo wp_kses($map_data, array('data')); ?>></div>
	<?php if ($scroll_wheel == 'no') { ?>
		<div class="eltd-google-map-overlay"></div>
	<?php } ?>
</div>
