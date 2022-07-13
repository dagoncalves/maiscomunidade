<?php
namespace ElatedListing\Maps;
use ElatedListing\Lib\Core;

class MapGlobalVars{

	private $id;
	private $type;
	private $query;
	private $init_multiple_map;
	private $multiple_vars;

	public function __construct($type, $id = '', $query = '' ,$init_multiple_map = false) {

		$this->type = $type;
		$this->id = $id;
		$this->query = $query;
		$this->init_multiple_map = $init_multiple_map;
		$this->multiple_vars['addresses'] = array();

		if($this->type === 'single'){
			add_action('wp_enqueue_scripts', array($this, 'generateSingleGlobalVar'), 20);
		}
		if($this->type === 'multiple'){
			$this->setMultipleVars();

			if($this->init_multiple_map){
				add_action('wp_footer', array($this, 'setMultipleGlobalVars'));
			}
		}
	}

	public function generateSingleGlobalVar(){

		$single_map_variables = array();

		if($this->id !== ''){
			$single_map_variables['currentListing'] = $this->generateListingMapParams($this->id);
		}

		$single_map_variables = apply_filters('eltd_listing_filter_js_single_map_variables', $single_map_variables);

		wp_localize_script('findme-elated-modules', 'eltdSingleMapVars', array(
			'single' => $single_map_variables
		));

	}

	public function setMultipleGlobalVars(){

		$multiple_map_variables = $this->getMultipleVars();

		wp_localize_script('findme-elated-modules', 'eltdMultipleMapVars', array(
			'multiple' => $multiple_map_variables
		));

	}

	public function setMultipleVars(){

		if($this->query !== ''){
			if($this->query->have_posts()){
				while($this->query->have_posts()){
					$this->query->the_post();
					$this->multiple_vars['addresses'][] = $this->generateListingMapParams(get_the_ID());
				}
			}
		}

	}

	public function getMultipleVars(){
		return $this->multiple_vars;
	}

	private function generateListingMapParams($listing_item_id){

		$listing_map_params = array();

		//get listing image
		$image_id = get_post_thumbnail_id( $listing_item_id );
		$image = wp_get_attachment_image_src( $image_id , 'medium' );
		$image[5] = '';
		if(isset($image[0]) && $image[0] !== ''){
			$image[5] = findme_elated_get_inline_style('background-image: url('.$image[0].')');
		}

		//Get item type
		$listing_types = wp_get_post_terms($listing_item_id, 'job_listing_type');
		$listing_type_id = false;
		if(is_array($listing_types) && count($listing_types)){
			$listing_type_id = $listing_types[0]->term_id;
		}

		$categories = wp_get_post_terms($listing_item_id, 'job_listing_category');
		$marker_pin = '';

		if(is_array($categories) && count($categories)){

			$marker_pin = eltd_listing_get_listing_category_icon_html($categories[0]->term_id);

		}

		//get address params
		$address_array = eltd_listing_get_address_params($listing_item_id);

		//Get item location
		if($address_array['address'] === '' && $address_array['address_lat'] === '' && $address_array['address_long'] === ''){
			$listing_map_params['location'] = get_post_meta( get_the_ID(), '_job_location', true );
		}else{
			$listing_map_params['location'] = array(
				'address' => get_post_meta( get_the_ID(), '_job_location', true ),
				'latitude' => $address_array['address_lat'],
				'longitude' => $address_array['address_long']
			);
		}


		$listing_map_params['title'] = get_the_title($listing_item_id);

		$rating_obj = new Core\ListingRating($listing_item_id, false, 'get_average_rating');
		ob_start();
		$rating_obj->getRatingHtml();
		$rating_html = ob_get_clean();

		if(isset($listing_type_id) && $listing_type_id){
			$listing_post = get_post($listing_type_id);
			$listing_item_type_name = null;
			if($listing_post && $listing_post !== null){
				$listing_item_type_name = $listing_type_id !== '' ? get_post($listing_type_id)->post_name : null;
			}
			$listing_map_params['listingType'] = $listing_item_type_name;

		}

		$listing_map_params['markerPin'] = $marker_pin;
		$listing_map_params['featuredImage'] = $image;
		$listing_map_params['ratingHtml'] = $rating_html;
		$listing_map_params['itemUrl'] = get_the_permalink($listing_item_id);

		return $listing_map_params;

	}

}