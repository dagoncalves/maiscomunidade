<?php if($query_results->max_num_pages > 1) { ?>
	<div class="eltd-pl-loading">
		<div class="eltd-pl-loading-bounce1"></div>
		<div class="eltd-pl-loading-bounce2"></div>
		<div class="eltd-pl-loading-bounce3"></div>
	</div>
	<div class="eltd-pl-load-more-holder">
		<div class="eltd-pl-load-more">
			<?php 
				echo findme_elated_get_button_html(array(
					'link' => 'javascript: void(0)',
					'size' => 'large',
					'text' => esc_html__('LOAD MORE', 'eltd-core')
				));
			?>
		</div>
	</div>
<?php }