<?php
$this_object = eltd_core_process_class_instance();

$params = $this_object->getBasicParams();
extract($params);
?>

<div class="eltd-process" <?php echo findme_elated_get_inline_style($background_image_style)?>>

    <div class="eltd-process-wrapper" <?php echo findme_elated_get_inline_style($background_color_style)?>>

        <?php if($link != '') { ?>
            <a class="eltd-process-link" href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>"></a>

        <?php } ?>

        <div class="eltd-process-content-wrapper" >

            <div class="eltd-process-content-holder" >

                <div class="eltd-process-content-holder-inner">

                    <?php if($type === 'process_icons'){
                        if(!empty($custom_icon)) : ?>
                            <?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
                        <?php else: ?>
                            <?php echo wp_kses_post($icon); ?>
                        <?php endif; ?>

                    <?php } elseif($type === 'process_text'){ ?>

                        <span class="eltd-process-inner-text">
                            <?php echo esc_html($text_in_process, 'woly') ?>
                        </span>

                    <?php } ?>

                </div>
            </div>
        </div>

        <div class="eltd-process-text-holder">
            <?php if($process_number !== ''){ ?>

                <div class="eltd-process-number">
                    <?php echo esc_attr($process_number)?>
                </div>

            <?php } ?>
            <h3 class="eltd-process-title">
                <?php echo esc_html($title); ?>
            </h3>
            <p class="eltd-process-text">
                <?php echo esc_html($text); ?>
            </p>
        </div>
    </div>

</div>