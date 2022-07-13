<?php
$load_more_option = findme_elated_options()->getOptionValue('listings_archive_load_more');
$enable_load_more = $load_more_option === 'yes' ? true : false;
$button_params = array(
	'custom_class' => 'eltd-listing-archive-load-more',
	'type'  => 'solid',
	'size'  => 'medium',
	'text'  => esc_html__('Load More','eltd-listing'),
	'html_type' => 'button'
);
if($enable_load_more){
	echo findme_elated_get_button_html($button_params);
}