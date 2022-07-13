<?php
$this_object = eltd_listing_list_class_instance();
$load_more_option = $this_object->getBasicParamByKey('load_more');
$enable_load_more = ($load_more_option === 'yes') ? true : false;
if($enable_load_more){
	$button_params = array(
		'text' => esc_html__('Load More', 'eltd-listing'),
		'custom_class' => 'eltd-ls-list-load-more',
		'type' => 'solid',
		'html_type' => 'button',
		'color'     => '#353535',
		'background_color'     => '#fff',
		'border_color'     => '#f4f4f4'
	);
	$html = '<div class="eltd-ls-list-load-more-holder">';
	$html .= findme_elated_get_button_html($button_params);
	$html .= '</div>';
	echo findme_elated_get_module_part( $html );
}