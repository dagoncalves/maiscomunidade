<div class="eltd-pls-holder <?php echo esc_attr($holder_classes) ?>">
    <ul class="eltd-pls-inner">
        <?php if($query_result->have_posts()): while ($query_result->have_posts()) : $query_result->the_post(); ?>
            <li class="eltd-pls-item">
                <div class="eltd-pls-image">
                    <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php findme_elated_get_module_template_part('templates/parts/image-simple', 'woocommerce', '', $params); ?>
                    </a>    
                </div>
                <div class="eltd-pls-text">
                    <?php findme_elated_get_module_template_part('templates/parts/title', 'woocommerce', '', $params); ?>
    
                    <?php findme_elated_get_module_template_part('templates/parts/rating', 'woocommerce', '', $params); ?>
    
                    <?php findme_elated_get_module_template_part('templates/parts/price', 'woocommerce', '', $params); ?>
                </div>
            </li>
        <?php endwhile; else: ?>
            <li class="eltd-pls-messsage">
                <?php findme_elated_get_module_template_part('templates/parts/no-posts', 'woocommerce', '', $params); ?>
            </li>
        <?php endif;
            wp_reset_postdata();
        ?>
    </ul>
</div>