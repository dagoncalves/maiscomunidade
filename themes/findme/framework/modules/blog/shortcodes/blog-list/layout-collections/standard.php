<li class="eltd-bl-item clearfix">
	<div class="eltd-bli-inner">
        <?php findme_elated_get_module_template_part('templates/parts/image', 'blog', '', $params);
        if ($post_info_category == 'yes') {
            findme_elated_get_module_template_part('templates/parts/post-info/category', 'blog', '', $params);
        }?>

        <div class="eltd-bli-content">
            
            <?php
            if($post_info_section == 'yes' || $post_info_category == 'yes') { ?>
                <div class="eltd-bli-info">
                    <?php
                    if ($post_info_author == 'yes') {
                        findme_elated_get_module_template_part('templates/parts/post-info/author', 'blog', '', $params);
                    }
                    if ($post_info_like == 'yes') {
                        findme_elated_get_module_template_part('templates/parts/post-info/like', 'blog', '', $params);
                    }
                    ?>
                </div>
            <?php } ?>
            <?php findme_elated_get_module_template_part('templates/parts/title', 'blog', '', $params); ?>
            <?php
            if($excerpt_length != '0') {
                findme_elated_get_module_template_part('templates/parts/excerpt', 'blog', '', $params);
                findme_elated_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $params);
            } ?>
            <div class="eltd-post-info-bottom clearfix">
                <div class="eltd-post-info-bottom-left">
                    <?php if ($post_info_date == 'yes') {
                        findme_elated_get_module_template_part('templates/parts/post-info/date', 'blog', '', $params);
                    }?>
                    <?php if ($post_info_comments == 'yes') {
                        findme_elated_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $params);
                    }?>
                </div>
                <div class="eltd-post-info-bottom-right">
                    <?php if ($post_info_share == 'yes') {
                        findme_elated_get_module_template_part('templates/parts/post-info/share', 'blog', '', $params);
                    } ?>
                </div>
            </div>
        </div>
	</div>
</li>