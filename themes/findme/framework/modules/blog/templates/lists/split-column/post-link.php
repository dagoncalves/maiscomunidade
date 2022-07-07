<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="eltd-post-content">
        <div class="eltd-post-text">
            <div class="eltd-post-text-inner">
                <div class="eltd-post-info-top">
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                </div>
                <div class="eltd-post-text-main">
                    <div class="eltd-post-mark">
                        <span class="fa fa-link eltd-link-mark"></span>
                    </div>
                    <?php findme_elated_get_module_template_part('templates/parts/post-type/link', 'blog', '', $part_params); ?>
                </div>
                <div class="eltd-post-info eltd-post-info-bottom clearfix">
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/like', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>