<?php
namespace ElatedListing\Lib\Shortcodes;

use ElatedListing\Lib\Shortcodes\ShortcodeInterface;
use ElatedListing\Lib\Core;

/**
 * Class ListingPackage that represents wc paid listing packages
 * @package ElatedListing\Lib\Shortcodes
 */
class ListingPackage implements ShortcodeInterface {

	private static $instance;
	private $base;
	private $basic_params = array();
	private $packages;

	public function __construct() {

		$this->base = 'eltd_listing_package';
		self::$instance = $this;

		add_action('vc_before_init', array($this, 'vcMap'));
		$this->setPackages();


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
	
	public function setPackages(){
	    
	    $this->packages = eltd_listing_get_listing_packages();
	    
	}
	
	public function getPackages(){
		
	    return $this->packages;
	    
	}

	public function vcMap() {

		vc_map(array(
			'name'                      => esc_html__('Elated Listing Packages', 'eltd-listing'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by ELATED', 'eltd-listing'),
			'icon'                      => 'icon-wpb-button extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array()
		    ));

	}

	public function render($atts, $content = null) {

			$args = array();
			$params = shortcode_atts($args, $atts);
			$this->resetBasicParams();
			$this->setBasicParams($params);

			return eltd_listing_get_shortcode_module_template_part('templates/holder', 'listing-package');

	}
}