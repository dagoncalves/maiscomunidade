<div class="<?php echo esc_attr($blog_classes) ?>" <?php echo esc_attr($blog_data_params) ?>>
    <div class="eltd-blog-holder-inner">
        <div class="eltd-blog-masonry-grid-sizer"></div>
        <div class="eltd-blog-masonry-grid-gutter"></div>
        <?php
            if($blog_query->have_posts()) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
                findme_elated_get_post_format_html($blog_type);
            endwhile;
            else:
                findme_elated_get_module_template_part('templates/parts/no-posts', 'blog');
            endif;

            wp_reset_postdata();
        ?>
    </div>
    <?php findme_elated_get_module_template_part('templates/parts/pagination/pagination', 'blog', '', $params); ?>
</div>