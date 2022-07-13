<?php
$share_type = isset($share_type) ? $share_type : 'list';
$global_share_option = findme_elated_options()->getOptionValue('enable_social_share');
$listing_share_option = findme_elated_options()->getOptionValue('enable_social_share_on_job_listing');

if($global_share_option === 'yes' && $listing_share_option === 'yes') { ?>
	<div class="eltd-ls-header-info eltd-ls-social-share">
        <span><?php esc_html_e('Share', 'eltd-listing'); ?></span>
		<?php echo findme_elated_get_social_share_html(array('type' => $share_type)) ?>
	</div>
<?php }