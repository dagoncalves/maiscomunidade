<div class="eltd-blog-carousel-holder">
    <ul class="eltd-blog-carousel eltd-owl-slider" <?php echo findme_elated_get_inline_attrs($carousel_data); ?>>
        <?php
            if($query_result->have_posts()):
                while ($query_result->have_posts()) : $query_result->the_post();
                    findme_elated_get_module_template_part('shortcodes/blog-carousel/layout-collections/blog-carousel', 'blog', '', $params);
                endwhile;
            else: ?>
                <div class="eltd-blog-carousel-messsage">
                    <p><?php esc_html_e('No posts were found.', 'findme'); ?></p>
                </div>
            <?php endif;

            wp_reset_postdata();
        ?>
    </ul>
</div>
