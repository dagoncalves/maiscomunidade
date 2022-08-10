<div class="eltd-image-with-text-holder">
    <div class="eltd-iwt-image">

        <?php if ($enable_lightbox) { ?>
            <a itemprop="image" href="<?php echo esc_url($image['url'])?>" data-rel="prettyPhoto[single_pretty_photo]" title="<?php echo esc_attr($image['alt']); ?>">
        <?php }

        elseif($link != ''){ ?>
              <a href="<?php echo esc_url($link)?>" target="<?php echo esc_attr($target) ?>" >
        <?php }

        if(is_array($image_size) && count($image_size)) {
            echo findme_elated_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]);
        }else{
            echo wp_get_attachment_image($image['image_id'], $image_size);
        }

        if ($enable_lightbox || $link !== '') { ?>
            </a>
        <?php } ?>

    </div>

    <div class="eltd-iwt-text-holder">

        <?php if(!empty($title)) { ?>

            <<?php echo esc_attr($title_tag); ?> class="eltd-iwt-title" <?php echo findme_elated_get_inline_style($title_styles); ?>>
                    <?php echo esc_html($title); ?>
            </<?php echo esc_attr($title_tag); ?>>

        <?php }

        if(!empty($text)) { ?>
            <p class="eltd-iwt-text" <?php echo findme_elated_get_inline_style($text_styles); ?>>
                <?php echo esc_html($text); ?>
            </p>
        <?php } ?>

    </div>
</div>