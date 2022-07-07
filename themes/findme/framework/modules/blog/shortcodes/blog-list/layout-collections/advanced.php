<li class="eltd-bl-item clearfix">
    <div class="eltd-bli-inner">
        <?php findme_elated_get_module_template_part('templates/parts/post-info/category', 'blog', '', $params); ?>
        <?php findme_elated_get_module_template_part('templates/parts/title', 'blog', '', $params); ?>
        <?php
            if($excerpt_length != '0') {
                findme_elated_get_module_template_part('templates/parts/excerpt', 'blog', '', $params);
            }
        ?>
        <div class="eltd-bli-content">
            <?php findme_elated_get_module_template_part('templates/parts/post-info/author', 'blog', 'advanced', $params); ?>
        </div>
    </div>
</li>