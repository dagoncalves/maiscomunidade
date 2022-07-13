<?php
namespace ElatedListing\Lib\Shortcodes;

use ElatedListing\Lib\Shortcodes\ShortcodeInterface;
use ElatedListing\Lib\Core;

/**
 * Class Button that represents button shortcode
 * @package FindmeElated\Modules\Shortcodes\Button
 */
class ListingSearch implements ShortcodeInterface {

	private static $instance;
	private $base;
	private $basic_params;
	private $types;
    private $regions;
    private $categories;

	public function __construct() {

		$this->base = 'eltd_listing_search';
		self::$instance = $this;

		add_action('vc_before_init', array($this, 'generateListingTypeArray'));
        add_action('vc_before_init', array($this, 'generateListingRegionArray'));
        add_action('vc_before_init', array($this, 'generateCategoriesArray'));
		add_action('vc_before_init', array($this, 'vcMap'));


		//Listing category filter
		add_filter( 'vc_autocomplete_eltd_listing_search_category_callback', array( &$this, 'listingCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Listing category render
		add_filter( 'vc_autocomplete_eltd_listing_search_category_render', array( &$this, 'listingCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
	}


	/**
	 * Returns current instance of class
	 * @return ListingAdvancedSearch
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

	public function generateListingTypeArray(){
		$types_array = eltd_listing_get_listing_types(true);
		$this->types = $types_array['key_value'];
	}

	public function getListingTypes(){
		return $this->types;
	}
    
    public function generateListingRegionArray(){
		$region_array = eltd_listing_get_listing_region(true);
		$this->regions = $region_array['key_value'];
	}

    public function generateCategoriesArray(){
        $category_array = eltd_listing_get_listing_cats(true);
        $this->categories = $category_array['key_value'];
    }


	public function getListingRegions(){
		return $this->regions;
	}

    public function getListingCategories(){
        return $this->categories;
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

	public function vcMap() {

		vc_map(array(
			'name'                      => esc_html__('Elated Listing Search', 'eltd-listing'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by ELATED', 'eltd-listing'),
			'icon'                      => 'icon-wpb-button extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'dropdown',
					'param_name'  => 'listing_search_skin',
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
                    'param_name'  => 'listing_search_type',
                    'heading'     => esc_html__('Choose search type', 'eltd-listing'),
                    'value'       => array(
                        esc_html__('Type 1', 'eltd-listing') => 'one',
                        esc_html__('Type 2', 'eltd-listing') => 'two',
                        esc_html__('Type 3', 'eltd-listing') => 'three'
                    ),
                ),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'listing_search_top_cats',
					'heading'     => esc_html__('Enable Top Categories', 'eltd-listing'),
					'value'       => array_flip(eltd_listing_get_yes_no_select_array()),
					'save_always' => true
				),
				array(
					'type'        => 'autocomplete',
					'heading'     => esc_html__('Choose Featured Types','eltd-listing'),
					'param_name'  => 'category',
					'settings'    => array(
						'multiple'      => true,
						'sortable'      => true,
						'unique_values' => true
					),
					'description' => esc_html__("Here you can choose which types will be displayed as featured in the search. These types will be displayed as icons above the search form. ", 'eltd-listing'),
					'dependency' => array(
						'element'   =>  'listing_search_top_cats',
						'value'     =>  'yes'
					),
					'save_always' => true
				)
            )
		));

	}

	public function render($atts, $content = null) {

		$args = array(
			'listing_search_skin' => '',
			'listing_search_type' => 'one',
			'listing_search_top_cats' => '',
			'category' => ''
		);

		$params = shortcode_atts($args, $atts);
		$this->resetBasicParams();
		$this->setBasicParams($params);

		$this->setBasicParams(array(
			'holder_classes' => $this->getHolderClasses(),
			'wrapper_classes' => $this->getWrapperClasses(),
			'top_categories' => $this->getTopCategories()
		));

		return eltd_listing_get_shortcode_module_template_part('templates/holder', 'listing-search');

	}

	public function getHolderClasses(){

		$classes = array();
		$skin = $this->getBasicParamByKey('listing_search_skin');
		$type = $this->getBasicParamByKey('listing_search_type');

		if($skin && $skin !== ''){
			$classes[] = 'eltd-'.$skin.'-skin';
		}
		if($type && $type !== ''){
			$classes[] = 'eltd-type-'.$type;
		}

		return implode($classes);
	}


	public function getWrapperClasses(){
		$classes = array();
		$type = $this->getBasicParamByKey('listing_search_type');
		$skin = $this->getBasicParamByKey('listing_search_skin');

		if($type && $type !== ''){
			$classes[] = 'eltd-type-'.$type;
		}
		if($skin && $skin !== ''){
			$classes[] = 'eltd-'.$skin.'-skin';
		}


		return implode(' ', $classes);
	}


	/**
	 * Sort listing categories by listing item count and take maximum 5 categories
	 *
	 * @return array
	 */
	private function getTopCategories() {

		$selected_cats = explode(',',$this->getBasicParamByKey('category'));
		$selected_cats_array = array();

		if(is_array($selected_cats) && count($selected_cats)){
			foreach ($selected_cats as $cat_slug){
				$cat =  get_term_by( 'slug', $cat_slug, 'job_listing_type');
				if($cat){
					$selected_cats_array[$cat->term_id]['name'] = $cat->name;
					$custom_icon = get_term_meta($cat->term_id, 'custom_icon', true);
					$selected_cats_array[$cat->term_id]['icon'] = $this->getIconHtml($custom_icon);
					$selected_cats_array[$cat->term_id]['link'] = get_term_link($cat->term_id, 'job_listing_type');
				}

			}
		}

		return $selected_cats_array;

	}

	private function getIconHtml($icon_src){

		$html = '';

		if($icon_src !== ''){

			$html .= '<img src="'.esc_url($icon_src).'" alt="'.esc_html__('Type Icon', 'eltd-listing').'">';

		}

		return $html;

	}

	/**
	 * Filter listing categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function listingCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS listing_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'job_listing_type' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['listing_category_title'] ) > 0 ) ? esc_html__( 'Category', 'eltd-core' ) . ': ' . $value['listing_category_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find listing category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function listingCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$listing_category = get_term_by( 'slug', $query, 'job_listing_type' );
			if ( is_object( $listing_category ) ) {

				$listing_category_slug = $listing_category->slug;
				$listing_category_title = $listing_category->name;

				$listing_category_title_display = '';
				if ( ! empty( $listing_category_title ) ) {
					$listing_category_title_display = esc_html__( 'Category', 'eltd-core' ) . ': ' . $listing_category_title;
				}

				$data          = array();
				$data['value'] = $listing_category_slug;
				$data['label'] = $listing_category_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

	
}