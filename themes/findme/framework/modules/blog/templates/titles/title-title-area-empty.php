<?php do_action('findme_elated_before_page_title'); ?>
<?php if($show_title_area) { ?>
    <div class="eltd-title <?php echo findme_elated_title_classes(array(), $module); ?>" style="<?php echo esc_attr($title_height); echo esc_attr($title_background_color); echo esc_attr($title_background_image); ?>" data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10));?>" <?php echo esc_attr($title_background_image_width); ?>>
        <?php if(!empty($title_background_image_src)) { ?>
            <div class="eltd-title-image">
                <img itemprop="image" src="<?php echo esc_url($title_background_image_src); ?>" alt="<?php esc_attr_e('Title Image', 'findme'); ?>" />
            </div>
        <?php } ?>
        <div class="eltd-title-holder" <?php findme_elated_inline_style($title_holder_height); ?>>
            <div class="eltd-container clearfix">
                <div class="eltd-container-inner">
                    <div class="eltd-title-subtitle-holder" style="<?php echo esc_attr($title_subtitle_holder_padding); ?>">
                        <div class="eltd-title-subtitle-holder-inner">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php do_action('findme_elated_after_page_title'); ?>