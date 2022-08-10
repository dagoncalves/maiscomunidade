<div <?php findme_elated_class_attribute($shortcode_classes);?>>
	<div class="eltd-scrolling-image-inner">
		<div class="eltd-image-holder">
			<img class="eltd-image-frame" src="<?php echo ELATED_CORE_ASSETS_URL_PATH ?>/css/img/scrolling-image-screen.png" alt="<?php esc_attr(_e('scrolling image holder','revolver')); ?>" />
			<div class="eltd-image-holder-inner">
				<img class="eltd-scrolling-img" src="<?php echo wp_get_attachment_url( $image ); ?>" alt="<?php echo get_the_title( $image ); ?>" />
			</div>
		</div>
		<div class="eltd-text-holder">
			<?php if ($image_title != '') { ?>
				<h6 class="eltd-image-title"><?php echo esc_attr($image_title) ?></h6>
			<?php } ?>
			<?php if ($image_subtitle != '') { ?>
				<p class="eltd-image-subtitle"><?php echo esc_attr($image_subtitle) ?></p>
			<?php } ?>
		</div>
	</div>
	<?php if ($image_link != '') { ?>
		<a class="eltd-scrolling-image-link" href="<?php echo esc_url($image_link) ?>" target="<?php echo esc_attr($image_target) ?>"></a>
	<?php } ?>
</div>
