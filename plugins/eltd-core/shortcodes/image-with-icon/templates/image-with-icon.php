<div class="eltd-image-with-icon-holder">
    <div class="eltd-iwc-image">
            <?php if(is_array($image_size) && count($image_size)) : ?>
                <?php echo findme_elated_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
            <?php else: ?>
                <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
            <?php endif; ?>
    </div>
    <div class="eltd-iwc-icon-holder">
        <?php if(!empty($custom_icon)) : ?>
            <?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
        <?php else: ?>
            <?php echo findme_elated_icon_collections()->renderIcon($icon, $icon_pack, $icon_params); ?>
        <?php endif; ?>

    </div>
</div>