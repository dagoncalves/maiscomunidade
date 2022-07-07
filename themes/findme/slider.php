<?php
do_action('findme_elated_before_slider_action');

$eltd_slider_shortcode = get_post_meta(findme_elated_get_page_id(), 'eltd_page_slider_meta', true);
if (!empty($eltd_slider_shortcode)) { ?>
	<div class="eltd-slider">
		<div class="eltd-slider-inner">
			<?php echo do_shortcode(wp_kses_post($eltd_slider_shortcode)); // XSS OK ?>
		</div>
	</div>
<?php }

do_action('findme_elated_after_slider_action');
?>