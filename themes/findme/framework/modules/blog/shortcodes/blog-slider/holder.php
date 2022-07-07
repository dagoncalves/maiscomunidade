<div class="eltd-blog-slider-holder">
    <ul class="eltd-blog-slider eltd-owl-slider" <?php echo findme_elated_get_inline_attrs($slider_data); ?>>
        <?php
            if($query_result->have_posts()):
                while ($query_result->have_posts()) : $query_result->the_post();
                    findme_elated_get_module_template_part('shortcodes/blog-slider/layout-collections/blog-slide', 'blog', '', $params);
                endwhile;
            else: ?>
                <div class="eltd-blog-slider-messsage">
                    <p><?php esc_html_e('No posts were found.', 'findme'); ?></p>
                </div>
            <?php endif;

            wp_reset_postdata();
        ?>
    </ul>
</div>
