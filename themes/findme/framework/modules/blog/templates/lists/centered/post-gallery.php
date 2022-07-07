<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
	<div class="eltd-post-content">
		<div class="eltd-post-text">
			<div class="eltd-post-text-inner">
                <div class="eltd-post-info">
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php findme_elated_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    <?php findme_elated_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                </div>
                <div class="eltd-post-heading">
                    <?php findme_elated_get_module_template_part('templates/parts/post-type/gallery', 'blog', '', $part_params); ?>
                </div>
                <div class="eltd-post-text-main">
                    <?php findme_elated_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                </div>
                <div class="eltd-post-info-bottom">
                    <div class="eltd-info-bottom-item">
                        <?php findme_elated_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                    </div>
                    <div class="eltd-info-bottom-item">
                        <?php findme_elated_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $part_params); ?>
                    </div>
                    <div class="eltd-info-bottom-item">
                        <?php findme_elated_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
                    </div>
                </div>
			</div>
		</div>
	</div>
</article>