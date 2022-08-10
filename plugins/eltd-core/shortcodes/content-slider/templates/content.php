<div class="eltd-content-slider-content" <?php echo findme_elated_get_inline_style($content_style); ?>>

    <?php if ($title != '') { ?>
        <<?php echo esc_attr($title_tag); ?> class="eltd-content-slider-title">
        <span><?php echo esc_attr($title); ?></span>
    </<?php echo esc_attr($title_tag); ?>>
    <?php } ?>

    <div class="eltd-content-slider-text">
        <?php echo wp_kses_post($text); ?>
    </div>

    <?php if ($show_button === 'yes') { ?>
        <div class="eltd-content-slider-button">
            <?php echo findme_elated_get_button_html($button_params); ?>
        </div>
    <?php } ?>

</div>