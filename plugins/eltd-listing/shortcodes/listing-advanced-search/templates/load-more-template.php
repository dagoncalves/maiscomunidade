<?php
$this_object = eltd_listing_adv_search_class_instance();
$load_more_option = $this_object->getBasicParamByKey('load_more');
$enable_load_more = ($load_more_option === 'yes') ? true : false;
$first_color = findme_elated_get_first_main_color();

if($enable_load_more){
	$button_params = array(
		'text' => esc_html__('Load More', 'eltd-listing'),
		'custom_class' => 'eltd-ls-adv-search-load-more',
		'type' => 'solid',
		'html_type' => 'button',
        'color'	                 => $first_color,
        'hover_color'            => '#fff',
        'background_color'       => 'transparent',
        'hover_background_color' => $first_color,
        'border_color'           => $first_color
	);
	$html = '<div class="eltd-ls-adv-load-more-holder">';
	$html .= findme_elated_get_button_html($button_params);
	$html .= '</div>';
	echo findme_elated_get_module_part( $html );
}