<li class="eltd-blog-slider-item">
    <div class="eltd-blog-slider-item-inner">
        <div class="eltd-item-image clearfix">
            <a itemprop="url" href="<?php echo esc_url(get_permalink()) ?>">
                <?php echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size); ?>
            </a>
        </div>
        <div class="eltd-item-text-wrapper">
            <div class="eltd-item-text-holder">
                <div class="eltd-item-text-holder-inner">
                    <?php if($post_info_date == 'yes' || $post_info_category == 'yes' || $post_info_author == 'yes' || $post_info_comments == 'yes'){ ?>
                        <div class="eltd-item-info-section">
                            <?php
                            if($post_info_date == 'yes'){
                                findme_elated_get_module_template_part('templates/parts/post-info/date', 'blog', '', $params);
                            } ?>
                            <?php
                            if($post_info_category == 'yes'){
                                findme_elated_get_module_template_part('templates/parts/post-info/category', 'blog', '', $params);
                            } ?>
                            <?php
                            if($post_info_comments == 'yes'){
                                findme_elated_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $params);
                            } ?>
                            <?php
                            if($post_info_author == 'yes'){
                                findme_elated_get_module_template_part('templates/parts/post-info/author', 'blog', '', $params);
                            } ?>
                        </div>
                    <?php } ?>

                    <<?php echo esc_attr( $title_tag)?> itemprop="name" class="eltd-item-title entry-title">
                        <a itemprop="url" href="<?php echo esc_url(get_permalink()); ?>">
                            <?php echo get_the_title(); ?>
                        </a>
                    </<?php echo esc_attr($title_tag); ?>>

                    <div class="eltd-section-button-holder">
                        <?php findme_elated_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $params); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>