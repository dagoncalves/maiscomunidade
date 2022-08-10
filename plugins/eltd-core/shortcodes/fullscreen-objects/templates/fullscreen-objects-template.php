<div class="swiper-holder">
    <div class="swiper-navigation">
        <span class="eltd-swiper-button-prev eltd-swiper-button">
            <?php echo findme_elated_icon_collections()->renderIcon( 'lnr-chevron-left', 'linear_icons' ); ?>
        </span>
        <span class="eltd-swiper-button-next eltd-swiper-button">
            <?php echo findme_elated_icon_collections()->renderIcon( 'lnr-chevron-right', 'linear_icons' ); ?>
        </span>
    </div>

    <div class="swiper-container eltd-fullscreen-objects full-page" <?php echo findme_elated_get_inline_attrs($data_params); ?>>
        <div class="swiper-wrapper">
            <?php foreach ($fullscreen_objects as $object) :
                $slide_styles = array();
                $slide_styles[] = 'background-image: url(' . wp_get_attachment_url($object['background_image']) . ')';
                ?>

                <div class="swiper-slide" <?php findme_elated_inline_style($slide_styles);?>>

                    <?php if (!empty($object['title'])) { ?>
                        <div class="eltd-slide-title-holder">
                            <?php if (!empty($object['link'])) { ?>
                            <a href="<?php echo esc_url($object['link']) ?>"
                               target="<?php echo esc_attr($object['target']) ?>">
                                <?php } ?>
                                <h2 class="eltd-slide-title" data-swiper-parallax="-70%">
                                    <?php echo esc_html($object['title']); ?>
                                </h2>
                                <?php if (!empty($object['link'])) { ?>
                            </a>
                        <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if (!empty($object['parallax_image'])) { ?>
                        <div class="eltd-slide-parallax-image-holder">
                            <div class="eltd-slide-parallax-image" data-swiper-parallax="-50%">
                                <?php echo wp_get_attachment_image($object['parallax_image'], 'full'); ?>
                            </div>
                        </div>
                    <?php } ?>

                </div>

            <?php endforeach; ?>
        </div>
    </div>
</div>