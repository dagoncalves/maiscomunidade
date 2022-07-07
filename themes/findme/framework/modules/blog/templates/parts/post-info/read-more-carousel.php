<div class="eltd-post-read-more-button">
<?php
    if(findme_elated_core_plugin_installed()) {
        echo findme_elated_get_button_html(
            apply_filters(
                'findme_elated_blog_template_read_more_button',
                array(
                    'type' => 'solid',
                    'size' => 'small',
                    'link' => get_the_permalink(),
                    'text' => esc_html__('Read more', 'findme'),
                    'custom_class'           => 'eltd-blog-list-button',
                    'background_color'       => '#7dc50f',
                    'border_color'           => '#7dc50f',
                    'hover_border_color'     => '#94D800',
                    'hover_background_color' => '#94D800'
                )
            )
        );
    } else { ?>
        <a itemprop="url" href="<?php echo esc_url(get_the_permalink()); ?>" target="_self" class="eltd-btn eltd-btn-medium eltd-btn-solid eltd-blog-list-button">
            <span class="eltd-btn-text">
                <?php echo esc_html__('Read the post', 'findme'); ?>
            </span>
        </a>
<?php } ?>
</div>
