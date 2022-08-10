<?php
namespace ElatedCore\CPT\Shortcodes\Process;

use ElatedCore\Lib;

class Process implements Lib\ShortcodeInterface {

	private static $instance;
	private $base;
	private $basic_params;

	function __construct() {
		$this->base = 'eltd_process';
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


	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {

		vc_map(array(
			'name' =>esc_html__( 'Process','eltd-core'),
			'base' => $this->getBase(),
			'as_child' => array('only' => 'eltd_process_holder'),
			'content_element' => true,
			'category' => esc_html__('by ELATED', 'eltd-core'),
			'icon' => 'icon-wpb-circle extended-custom-icon',
			'show_settings_on_create' => true,
			'params' => array_merge(
				array(
					array(
						'type' => 'dropdown',
						'param_name' => 'type',
						'heading' =>esc_html__( 'Type','eltd-core'),
						'value' => array(
							esc_html__( 'Icons in Process','eltd-core') => 'process_icons',
							esc_html__( 'Text in Process','eltd-core') => 'process_text',
						),
						'admin_label' => true,
						'save_always' => true
					)
				),
				findme_elated_icon_collections()->getVCParamsArray(array('element' => 'type', 'value' => 'process_icons')),
				array(
                    array(
                        'type'       => 'attach_image',
                        'param_name' => 'custom_icon',
                        'heading'    => esc_html__( 'Custom Icon', 'eltd-core' ),
                        'dependency'  => array('element' => 'type', 'value' => 'process_icons')
                    ),
					array(
						'type' => 'textfield',
						'param_name' => 'text_in_process',
						'heading' => esc_html__( 'Text in Process','eltd-core'),
						'admin_label' => true,
						'dependency'  => array('element' => 'type', 'value' => 'process_text')
					),
					array(
						'type' => 'textfield',
						'param_name' => 'title',
						'heading' => esc_html__( 'Title','eltd-core'),
						'admin_label' => true
					),
					array(
						'type' => 'textfield',
						'param_name' => 'process_number',
						'heading' => esc_html__( 'Process Number','eltd-core'),
						'admin_label' => true
					),
					array(
						'type' => 'attach_image',
						'param_name' => 'background_image',
						'heading' =>esc_html__(  'Background Image','eltd-core'),
						'admin_label' => true
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__( 'Background Color','eltd-core'),
						'param_name'  => 'background_color',
						'admin_label' => true
					),
					array(
						'type' => 'textfield',
						'param_name' => 'link',
						'heading' => esc_html__( 'Link','eltd-core'),
						'admin_label' => true
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'target',
						'heading' => esc_html__( 'Target','eltd-core'),
						'admin_label' => true,
						'value' => array(
								esc_html__( 'Self','eltd-core') => '_self',
								esc_html__( 'Blank','eltd-core') => '_blank',
						),
						'dependency' => array('element' => 'type', 'not_empty' => true),
                        'save_always' => true
					),
					array(
						'type' => 'textfield',
						'param_name' => 'text',
						'heading' => esc_html__( 'Text','eltd-core') ,
						'admin_label' => true
					),
					array(
						'type' => 'textfield',
						'param_name' => 'icon_size',
						'heading' =>esc_html__(  'Icon Size','eltd-core'),
						'group' =>esc_html__(  'Design Group','eltd-core'),
						'admin_label' => true
					)
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
			'type' => '',
			'text_in_process' => '',
			'background_image' => '',
			'link' => '',
			'target' => '',
			'title' => '',
			'text' => '',
			'icon_size' => '38',
			'background_color'=>'',
			'process_number'   => '',
            'custom_icon'      => ''
		);

		$args = array_merge($args, findme_elated_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($args, $atts);
		extract($params);

		$this->resetBasicParams();
		$this->setBasicParams($params);

		if($type === 'process_icons'){
			$this->setBasicParams(array(
				'icon' => $this->getProcessIcon()
			));
		}

		$this->setBasicParams(array(
			'type_class' => $this->getProcessType(),
			'background_image_style' => $this->getBackgroundImage(),
			'background_color_style' => $this->getBackgroundColor()
		));

		$html = eltd_core_get_shortcode_module_template_part('templates/process', 'process');

		return $html;

	}

	/**
	 * Get Icon
	 *
	 * @param $params
	 * @return mixed|string
	 */
	private function getProcessIcon() {

		$iconPack = $this->getBasicParamByKey('icon_pack');
		$icon_size =  $this->getBasicParamByKey('icon_size');

		$iconParam = findme_elated_icon_collections()->getIconCollectionParamNameByKey($iconPack);

		$icon = $this->getBasicParamByKey($iconParam);

		$icon_atts = array(
			'icon_pack' => $iconPack,
			$iconParam => $icon,
			'custom_size' => $icon_size
		);

		return findme_elated_execute_shortcode('eltd_icon', $icon_atts);

	}

	private function getBackgroundColor(){
		$background_color_style = '';
		$bck_color = $this->getBasicParamByKey('background_color');

		if(isset($bck_color) && $bck_color !==''){
			$background_color_style = 'background-color:'.esc_attr($bck_color);
		}
		return $background_color_style;
	}

	/**
	 * Get Type Class
	 *
	 * @param $params
	 * @return string
	 */
	private function getProcessType() {

		$type_class = '';

		$type = $this->getBasicParamByKey('type');
		switch ($type){
			case 'process_icons':
				$type_class = 'eltd-process-with-icon';
				break;
			case 'process_text':
				$type_class = 'eltd-process-with-text';
				break;
		}

		return $type_class;

	}
	/**
	 * Get Background Image
	 *
	 * @param $params
	 * @return string
	 */
	private function getBackgroundImage(){

		$background_image_style = '';
		$bck_img = $this->getBasicParamByKey('background_image');
		$background_image = wp_get_attachment_image_src( $bck_img, 'full' );

		if($background_image && $background_image !==''){
			$background_image_style = 'background-image: url('.esc_attr($background_image[0]).')';
		}

		return $background_image_style;

	}

}