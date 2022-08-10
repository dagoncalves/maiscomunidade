<button type="submit" <?php findme_elated_inline_style($button_styles); ?> <?php findme_elated_class_attribute($button_classes); ?> <?php echo findme_elated_get_inline_attrs($button_data); ?> <?php echo findme_elated_get_inline_attrs($button_custom_attrs); ?>>

    <span class="eltd-btn-text" <?php echo findme_elated_get_inline_style($text_styles); ?> >
        <?php echo esc_html($text); ?>
    </span>

    <?php
    if($icon !== '' && $icon_pack !== ''){ ?>
        <span class="eltd-btn-icon-html" <?php echo  findme_elated_inline_style($icon_styles);?> >
            <?php echo findme_elated_icon_collections()->renderIcon($icon, $icon_pack); ?>
        </span>
    <?php } ?>

</button>