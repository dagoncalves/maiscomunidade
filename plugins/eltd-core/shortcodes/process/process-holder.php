<?php
namespace ElatedCore\CPT\Shortcodes\ProcessHolder;

use ElatedCore\Lib;

class ProcessHolder implements Lib\ShortcodeInterface {

	private static $instance;
	private $base;
	private $basic_params;

	function __construct() {
		$this->base = 'eltd_process_holder';
		self::$instance = $this;

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
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

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {

		vc_map(array(
			'name' =>esc_html__( 'Process Holder','eltd-core'),
			'base' => $this->getBase(),
			'as_parent' => array('only' => 'eltd_process'),
			'content_element' => true,
			'category' => esc_html__('by ELATED', 'eltd-core'),
			'icon' => 'icon-wpb-circles extended-custom-icon',
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Columns','eltd-core'),
					'param_name' => 'columns',
					'value' => array(
                        esc_html__('Three' ,'eltd-core')     => 'three',
						esc_html__('Four' ,'eltd-core')     => 'four',
						esc_html__('Five','eltd-core')      => 'five',
						esc_html__('Six','eltd-core')      =>  'six'
					),
					'save_always' => true,
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Skin','eltd-core'),
					'param_name' => 'skin',
					'value' => array(
						esc_html__('Dark'  ,'eltd-core')    => 'dark',
						esc_html__('Light' ,'eltd-core')     => 'light'
					),
					'save_always' => true,
					'admin_label' => true,
					'description' => ''
				)
			)
		));
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'columns' => '',
			'skin' => '',
		);

		$params = shortcode_atts($args, $atts);
		extract($params);

		$this->resetBasicParams();
		$this->setBasicParams($params);

		$this->setBasicParams(array(
			'content' => $content,
			'classes' => $this->getHolderClasses()
		));

		$html = eltd_core_get_shortcode_module_template_part('templates/process-holder', 'process');

		return $html;


	}


	public function getHolderClasses(){

		$classes = array(
			'eltd-processes-holder',
			'clearfix'
		);
		$columns = $this->getBasicParamByKey('columns');
		$skin = $this->getBasicParamByKey('skin');

		$classes[] = 'eltd-'.esc_attr($columns).'-columns';
		$classes[] = 'eltd-process-'.esc_attr($skin).'-skin';

		return $classes;

	}

}