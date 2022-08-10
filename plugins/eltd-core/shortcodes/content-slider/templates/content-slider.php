<?php

$template_params['image'] = $image;
$template_params['title'] = $title;
$template_params['title_tag'] = $title_tag;
$template_params['text'] = $text;
$template_params['content_style'] = $content_style;
$template_params['button_params'] = $button_params;
$template_params['show_button'] = $show_button;

?>

<div class="eltd-content-slider-item">
    <?php if ($image_position === 'left') : ?>
        <?php echo eltd_core_get_shortcode_module_template_part('templates/image', 'content-slider', '', $template_params); ?>
        <?php echo eltd_core_get_shortcode_module_template_part('templates/content', 'content-slider', '', $template_params); ?>
    <?php elseif ($image_position === 'right') : ?>
        <?php echo eltd_core_get_shortcode_module_template_part('templates/content', 'content-slider', '', $template_params); ?>
        <?php echo eltd_core_get_shortcode_module_template_part('templates/image', 'content-slider', '', $template_params); ?>
    <?php endif; ?>
</div>