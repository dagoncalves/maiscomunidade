<?php $i = 0; ?>
<div class="eltd-frame-slider-holder">
	<div class="eltd-fs-phone"></div>
	<div class="eltd-fs-slides eltd-owl-slider" <?php echo findme_elated_get_inline_attrs($slider_data); ?>>
		<?php foreach ($images as $image) { ?>
			<div class="eltd-fs-slide">
				<?php if(!empty($links)){ ?>
					<a class="eltd-ig-link" href="<?php echo esc_url($links[$i++]) ?>" title="<?php echo esc_attr($image['alt']); ?>" target="<?php echo esc_attr($target); ?>">
				<?php } ?>
					<?php echo wp_get_attachment_image($image['image_id'], 'full'); ?>
				<?php if(!empty($links)){ ?>
					</a>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>
