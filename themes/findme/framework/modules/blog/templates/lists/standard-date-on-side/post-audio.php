<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="eltd-post-content">
        <div class="eltd-post-heading">
            <?php findme_elated_get_module_template_part('templates/parts/image', 'blog', '', $part_params); ?>
            <?php findme_elated_get_module_template_part('templates/parts/post-type/audio', 'blog', '', $part_params); ?>
        </div>
        <div class="eltd-post-text">
            <div class="eltd-post-date-inner">
                <div class="eltd-post-date-day">
                    <?php the_time('d'); ?>
                </div>
                <div class="eltd-post-date-month">
                    <?php the_time('F'); ?>
                </div>
            </div>
            <div class="eltd-post-text-inner">
                <?php findme_elated_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                <div class="eltd-post-info">
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/like', 'blog', '', $part_params); ?>
                </div>
                <div class="eltd-post-text-main">
                    <?php findme_elated_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                    <?php do_action('findme_elated_single_link_pages'); ?>
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>