<?php
use  ElatedListing\Maps;
if(!function_exists('eltd_listing_generate_listing_map_vars')){

	/**
	 * Generates map variables based on sent attributes
	 * $attributes can contain:
	 *      $type - 'single' or 'multiple'. Single map variables is for google map on single listing pages, multiple is used for different lists and archive pages
	 *      $id - id of current listing. Note that id is only used for single listing pages
	 *      $query - $query is used just for multiple type. $query is Wp_Query object containing listing items which should be presented on map
	 *      $init_multiple_map - boolean value to enable initial setting of map items. For example, when listing items are loaded via ajax, this is set on false, and in that case this param is false
	 *
	 * @param $attributes
	 *
	 */

	function eltd_listing_generate_listing_map_vars($attributes){

		$type = '';
		$id = '';
		$query = '';
		$init_multiple_map = false;

		extract($attributes);
		new Maps\MapGlobalVars($type, $id, $query, $init_multiple_map);

	}

}


if ( ! function_exists( 'eltd_listing_set_global_map_variables' ) ) {
	/**
	 * Function for setting global map variables
	 */
	function eltd_listing_set_global_map_variables() {
		$global_map_variables = array();

		if ( eltd_listing_theme_installed() ) {
			$global_map_variables['mapStyle'] = json_decode(findme_elated_options()->getOptionValue('listing_map_style'));
			$global_map_variables['scrollable'] = findme_elated_options()->getOptionValue('listing_maps_scrollable') == 'yes' ? true : false;
			$global_map_variables['draggable'] = findme_elated_options()->getOptionValue('listing_maps_draggable') == 'yes' ? true : false;
			$global_map_variables['streetViewControl'] = findme_elated_options()->getOptionValue('listing_maps_street_view_control') == 'yes' ? true : false;
			$global_map_variables['zoomControl'] = findme_elated_options()->getOptionValue('listing_maps_zoom_control') == 'yes' ? true : false;
			$global_map_variables['mapTypeControl'] = findme_elated_options()->getOptionValue('listing_maps_type_control') == 'yes' ? true : false;

			$global_map_variables = apply_filters('eltd_listing_filter_js_global_map_variables', $global_map_variables);

			wp_localize_script('findme-elated-modules', 'eltdMapsVars', array(
				'global' => $global_map_variables
			));
		}
	}

	add_action('wp_enqueue_scripts', 'eltd_listing_set_global_map_variables', 20);

}

if( ! function_exists( 'eltd_listing_set_single_map_variables' ) ) {
	/**
	 * Function for setting single map variables
	 */
	function eltd_listing_set_single_map_variables() {

		if ( is_singular('job_listing') ) {
			$map_array = array(
				'type' => 'single',
				'id' => get_the_ID()
			);
			eltd_listing_generate_listing_map_vars($map_array);
		}

	}
	add_action('wp', 'eltd_listing_set_single_map_variables', 1);
}


if ( ! function_exists( 'eltd_listing_get_listing_item_map' ) ) {
	/**
	 * Function that renders map holder for single listing item
	 *
	 * @return string
	 */
	function eltd_listing_get_listing_item_map($latitude, $longitude) {


		$html = '<div id="eltd-ls-single-map-holder"></div>
				<meta itemprop="latitude" content="'. $latitude .'">
				<meta itemprop="longitude" content="'. $longitude .'">';

		do_action('eltd_listing_after_listing_map');

		return $html;

	}

}

if ( ! function_exists( 'eltd_listing_get_listing_multiple_map' ) ) {
	/**
	 * Function that renders map holder for multiple listing item
	 *
	 * @return string
	 */
	function eltd_listing_get_listing_multiple_map() {

		$html = '<div id="eltd-ls-multiple-map-holder"></div>';

		do_action('eltd_listing_after_listing_map');

		return $html;

	}

}

if ( ! function_exists( 'eltd_listing_marker_info_template' ) ) {
	/**
	 * Template with placeholders for marker info window
	 *
	 * uses underscore templates
	 *
	 */
	function eltd_listing_marker_info_template() {

		$html = '<script type="text/template" class="eltd-info-window-template">
				<div class="eltd-info-window">
					<div class="eltd-info-window-inner">
						<a href="<%= itemUrl %>"></a>
						<div class="eltd-info-window-details">
							<h5>
								<%= title %>
							</h5>
							<p><%= address %></p>
							<p><%= ratingHtml %></p>
						</div>
						<% if ( featuredImage ) { %>
							<div class="eltd-info-window-image" <%= featuredImage[5] %> >
								<img src="<%= featuredImage[0] %>" alt="<%= title %>" width="<%= featuredImage[1] %>" height="<%= featuredImage[2] %>">
							</div>
						<% } %>
                        
					</div>
				</div>
			</script>';

		echo findme_elated_get_module_part( $html );

	}

	add_action('eltd_listing_after_listing_map', 'eltd_listing_marker_info_template');

}

if ( ! function_exists( 'eltd_listing_marker_template' ) ) {
	/**
	 * Template with placeholders for marker
	 */
	function eltd_listing_marker_template() {

		$html = '<script type="text/template" class="eltd-marker-template">
				<div class="eltd-map-marker">
					<div class="eltd-map-marker-inner">
						<%= pin %>
						
						<svg version="1.1" id="Layer_4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 width="135px" height="154.339px" viewBox="0 0 135 154.339" enable-background="new 0 0 135 154.339" xml:space="preserve">
						<path fill="#FF4D30" stroke="#FFFFFF" stroke-width="4" stroke-miterlimit="10" d="M133.047,67.491
							c0-36.158-29.311-65.469-65.467-65.469c-36.159,0-65.469,29.311-65.469,65.469c0,26.276,16.375,48.924,38.891,59.342
							c2.935,1.503,5.991,2.781,9.148,3.8c9.552,3.785,13.827,22.089,17.297,21.577s7.263-17.233,16.329-21.194
							c3.61-1.079,7.094-2.497,10.421-4.202C116.716,116.389,133.047,93.755,133.047,67.491z"/>
						</svg>
					
					</div>
				</div>
			</script>';

		echo findme_elated_get_module_part( $html );

	}

	add_action('eltd_listing_after_listing_map', 'eltd_listing_marker_template');

}


if(!function_exists('eltd_listing_get_address_params')){

	/**
	 * Function that set up address params
	 * param id - id of current post
	 *
	 * @return array
	 */

	function eltd_listing_get_address_params($id){

		$address_array = array();
		$address_string = get_post_meta( $id, 'geolocation_formatted_address', true );
		$address_lat = get_post_meta( $id, 'geolocation_lat', true );
		$address_long = get_post_meta( $id, 'geolocation_long', true );

		$address_array['address'] = $address_string !== '' ? $address_string : '';
		$address_array['address_lat'] = $address_lat !== '' ? $address_lat : '';
		$address_array['address_long'] = $address_long !== '' ? $address_long : '';

		return $address_array;

	}

}

if(!function_exists('eltd_listing_get_address_html')){
	/**
	 * Function return listing address html
	 * param id - id of current post
	 *
	 * @return string
	 */
	function eltd_listing_get_address_html($id){

		$params_address = eltd_listing_get_address_params($id);
		$city = get_post_meta($id, 'geolocation_city' , true);
        $address = get_post_meta($id, 'geolocation_address' , true);

		extract($params_address);
		$html = '';


		if($city !== ''){
			$html .= '<div class="eltd-ls-adr-city">';
            $html .= '<span class="eltd-city">'.esc_html($address,$city).'</span>';
			$html .= '</div>';
		}

		return $html;
	}
}