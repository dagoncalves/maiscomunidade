<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
	<div class="eltd-post-content">
		<div class="eltd-post-text">
			<div class="eltd-post-text-inner">
                <div class="eltd-post-info eltd-section-top">
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                </div>
                <?php findme_elated_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                <div class="eltd-post-info eltd-section-bottom">
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/like', 'blog', '', $part_params); ?>
                </div>
			</div>
		</div>
	</div>
</article>