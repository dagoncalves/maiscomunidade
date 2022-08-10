<div class="eltd-banner-holder">
    <div class="eltd-banner-image">
        <?php echo wp_get_attachment_image($image, 'full'); ?>
    </div>
    <?php if ($type === 'image') { ?>
	    <div class="eltd-banner-front-image">
	        <?php echo wp_get_attachment_image($front_image, 'full'); ?>
	    </div>
    <?php } if ($type === 'text') { ?>
	    <div class="eltd-banner-text-holder">
		    <div class="eltd-banner-text-inner">
		        <?php if(!empty($subtitle)) { ?>
		            <<?php echo esc_attr($subtitle_tag); ?> class="eltd-banner-subtitle" <?php echo findme_elated_get_inline_style($subtitle_styles); ?>><?php echo esc_html($subtitle); ?></<?php echo esc_attr($subtitle_tag); ?>>
		        <?php } ?>
		        <?php if(!empty($title)) { ?>
		            <<?php echo esc_attr($title_tag); ?> class="eltd-banner-title" <?php echo findme_elated_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
		        <?php } ?>
				<?php if(!empty($text)) { ?>
		            <p class="eltd-banner-text" <?php echo findme_elated_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
		        <?php } ?>
			</div>
		</div>
	<?php } if (!empty($link)) { ?>
        <a itemprop="url" class="eltd-banner-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"></a>
    <?php } ?>
</div>