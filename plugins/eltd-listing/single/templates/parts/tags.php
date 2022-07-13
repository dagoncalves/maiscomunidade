<?php
if(eltd_listing_is_wp_job_manager_tags_installed()){

	$tags_html = $article_obj->getTaxHtml('job_listing_tag', 'eltd-ls-tags-wrapper', true);

	if($tags_html !== ''){ ?>

		<div class="eltd-ls-content-part-holder clearfix">

            <h3 class="eltd-ls-content-tags-title">
                Tags
            </h3>

			<div class="eltd-ls-content-part">
				<?php echo wp_kses_post($tags_html); ?>
                <?php ?>
			</div>

		</div>

	<?php }

}