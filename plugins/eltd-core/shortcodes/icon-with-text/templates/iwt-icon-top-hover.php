<div <?php findme_elated_class_attribute($holder_classes); ?>>
    <div class="eltd-iwt-icon icon-hover">
        <?php if(!empty($link)) : ?>
        <a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target);?>">
            <?php endif; ?>
            <?php if(!empty($custom_icon)) : ?>
                <?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
                <?php if(!empty($custom_icon_hover) && !empty($custom_icon)) {
                    echo wp_get_attachment_image($custom_icon_hover, 'full');
                } ?>
            <?php else: ?>
                <?php echo eltd_core_get_shortcode_module_template_part('templates/icon', 'icon-with-text', '', array('icon_parameters' => $icon_parameters)); ?>
            <?php endif; ?>
            <?php if(!empty($link)) : ?>
        </a>
    <?php endif; ?>
    </div>
    <div class="eltd-iwt-content" <?php findme_elated_inline_style($content_styles); ?>>
        <?php if(!empty($title)) { ?>
        <<?php echo esc_attr($title_tag); ?> class="eltd-iwt-title" <?php findme_elated_inline_style($title_styles); ?>>
        <?php if(!empty($link)) : ?>
        <a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
            <?php endif; ?>
            <span class="eltd-iwt-title-text"><?php echo esc_html($title); ?></span>
            <?php if(!empty($link)) : ?>
        </a>
    <?php endif; ?>
    </<?php echo esc_attr($title_tag); ?>>
    <?php } ?>
    <?php if(!empty($text)) { ?>
        <p class="eltd-iwt-text" <?php findme_elated_inline_style($text_styles); ?>><?php echo wp_kses_post($text); ?></p>
    <?php } ?>
    <?php if(!empty($link) && $show_button_flag) : ?>
        <a class="eltd-iwt-link" itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"><?php esc_html_e('Show More','eltd-core')?> <span>+</span></a>
    <?php endif; ?>
</div>
</div>