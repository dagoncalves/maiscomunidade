<?php if($max_num_pages > 1) { ?>
	<div class="eltd-blog-pag-loading">
		<div class="eltd-blog-pag-bounce1"></div>
		<div class="eltd-blog-pag-bounce2"></div>
		<div class="eltd-blog-pag-bounce3"></div>
	</div>
	<div class="eltd-blog-pag-load-more">
		<?php
        if(findme_elated_core_plugin_installed()) {
			echo findme_elated_get_button_html(
                apply_filters(
                    'findme_elated_blog_template_load_more_button',
                    array(
                        'link' => 'javascript: void(0)',
                        'size' => 'large',
                        'text' => esc_html__('Load more', 'findme')
			        )
                )
            );
        } else { ?>
            <a itemprop="url" href="javascript:void(0)" target="_self" class="eltd-btn eltd-btn-large eltd-btn-solid">
                <span class="eltd-btn-text">
                    <?php echo esc_html__('Load more', 'findme'); ?>
                </span>
            </a>
		<?php } ?>
	</div>
<?php }