<?php
namespace ElatedListing\Lib\Shortcodes;

use ElatedListing\Lib\Shortcodes\ShortcodeInterface;

/**
 * Class ListingList
 * @package ElatedListing\Lib\Shortcodes
 */
class ListingList implements ShortcodeInterface {

	private static $instance;
	private $base;
	private $basic_params;
	private $types;
	private $cats;

	public function __construct() {

		$this->base = 'eltd_listing_list';
		self::$instance = $this;
		   
		add_action('vc_before_init', array($this, 'vcMap'));
		$this->generateListingCatsArray();
		$this->generateListingTypeArray();

	}


	/**
	 * Returns current instance of class
	 * @return ListingList
	 */
	public static function getInstance() {

		if(self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}
	/**
	 * Make sleep magic method private, so nobody can serialize instance.
	 */

	private function __clone() {}

	/**
	 * Make sleep magic method private, so nobody can serialize instance.
	 */
	private function __sleep() {}

	/**
	 * Make wakeup magic method private, so nobody can unserialize instance.
	 */
	private function __wakeup() {}


	public function getBase() {
		return $this->base;
	}

	public function setBasicParams($params = array()){

		if(is_array($params) && count($params)){
			foreach($params as $param_key => $param_value){
				$this->basic_params[$param_key] = $param_value;
			}
		}

	}

	public function resetBasicParams(){
		if(is_array($this->basic_params) && count($this->basic_params)){
			foreach ($this->basic_params as $param_key => $param_value) {
				unset($this->basic_params[$param_key]);
			}
		}
	}

	public function getBasicParams(){
		return $this->basic_params;
	}

	public function getBasicParamByKey($key){
		return $this->basic_params[$key];
	}

	public function setQueryResults($query){
		$this->query = $query;
	}
	public function getQueryResults(){
		return $this->query;
	}
	
	public function generateListingTypeArray(){
		$this->types = eltd_listing_get_listing_types_VC_Array();
	}
    
	public function getListingTypes(){
		return $this->types;
	}
    
	public function generateListingCatsArray(){
	    $this->cats = eltd_listing_categories_VC_ARRAY(true);
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Elated Listing List', 'eltd-listing'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by ELATED', 'eltd-listing'),
			'icon'                      => 'icon-wpb-button extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'dropdown',
					'param_name'  => 'listing_list_skin',
					'heading'     => esc_html__('Skin', 'eltd-listing'),
					'value'       => array(
						esc_html__('Default', 'eltd-listing') => '',
						esc_html__('Light', 'eltd-listing') => 'light',
						esc_html__('Dark', 'eltd-listing') => 'dark'
					),
					'save_always' => true,
					'admin_label' => true
				),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'listing_type',
					'heading'     => esc_html__('Listing Type', 'eltd-listing'),
					'value'       => $this->types,
					'admin_label' => true
				),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'listing_category',
					'heading'     => esc_html__('Listing Category', 'eltd-listing'),
					'value'       => $this->cats,
					'admin_label' => true
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'listing_list_number',
					'heading'     => esc_html__('Number of items', 'eltd-listing'),
					'value'       => '',
					'admin_label' => true
				),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'listing_list_columns',
					'heading'     => esc_html__('Number of columns', 'eltd-listing'),
					'value'       => array(
						esc_html__('Default', 'eltd-listing') => '',
						esc_html__('One Column','eltd-listing') => 'one',
						esc_html__('Two Columns','eltd-listing') => 'two',
						esc_html__('Three Columns','eltd-listing') => 'three',
						esc_html__('Four Columns','eltd-listing') => 'four',
						esc_html__('Five Columns','eltd-listing') => 'five',
						esc_html__('Six Columns','eltd-listing') => 'six'
					),
					'admin_label' => true
				),
			)
		));

	}

	public function render($atts, $content = null) {
		$args = array(
			'listing_list_skin' => '',
			'listing_list_number' => '3',
			'listing_list_columns'  => 'three',
			'listing_type'  => '',
			'listing_category'  => ''
		);
		$params = shortcode_atts($args, $atts);
		extract($params);
		
		$this->resetBasicParams();
		$this->setBasicParams($params);
		
		$this->setBasicParams(array(
			'holder_classes' => $this->getHolderClasses()
		));

		$query_results = eltd_listing_get_listing_query_results($this->getQueryArray());
		
		$this->setQueryResults($query_results);

		return eltd_listing_get_shortcode_module_template_part('templates/holder', 'listing-list');

	}

	public function getHolderClasses(){

		$classes = array(
			'eltd-ls-list-normal-space'
		);

		$skin = $this->getBasicParamByKey('listing_list_skin');
		if($skin && $skin !== ''){
			$classes[] = 'eltd-'.$skin.'-skin';
		}

		$column_number = $this->getBasicParamByKey('listing_list_columns');
		if($column_number && $column_number !== ''){
			$classes[] = 'eltd-ls-list-'.$column_number.'-columns';
		}

		return implode($classes, ' ');
	}
	
	
	public function getQueryArray(){
	    $listing_type = '';
	    
	    $query_params = array(
		'post_number' => $this->getBasicParamByKey('listing_list_number')
	    );
	    
	    $type = $this->getBasicParamByKey('listing_type');
	    $listing_category = $this->getBasicParamByKey('listing_category');

	    if($type !== ''){
		$query_params['type'] = $listing_type;		    
	    }
	    if($listing_category !== ''){
		$query_params['category_array'] = array($listing_category);
	    }
	    
	    return $query_params;
	    
	}
}