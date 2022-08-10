<?php
namespace ElatedCore\CPT\Shortcodes\Tabs;

use ElatedCore\Lib;

class Tabs implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltd_tabs';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(
				array(
					'name'            => esc_html__( 'Elated Tabs', 'eltd-core' ),
					'base'            => $this->getBase(),
					'as_parent'       => array( 'only' => 'eltd_tabs_item' ),
					'content_element' => true,
					'category'        => esc_html__( 'by ELATED', 'eltd-core' ),
					'icon'            => 'icon-wpb-tabs extended-custom-icon',
					'js_view'         => 'VcColumnView',
					'params'          => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'eltd-core' ),
							'value'       => array(
								esc_html__( 'Standard', 'eltd-core' ) => 'standard',
								esc_html__( 'Boxed', 'eltd-core' )    => 'boxed',
								esc_html__( 'Simple', 'eltd-core' )   => 'simple',
								esc_html__( 'Vertical', 'eltd-core' ) => 'vertical'
							),
							'save_always' => true
						)
					)
				)
			);
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'type' => 'standard'
		);

        $params  = shortcode_atts($args, $atts);
		extract($params);
		
		// Extract tab titles
		preg_match_all('/title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);
		$tab_titles = array();

		/**
		 * get tab titles array
		 */
		if (isset($matches[0])) {
			$tab_titles = $matches[0];
		}
		
		$tab_title_array = array();
		
		foreach($tab_titles as $tab) {
			preg_match('/title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
			$tab_title_array[] = $tab_matches[1][0];
		}
		
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['tabs_titles']    = $tab_title_array;
		$params['content']        = $content;
		
		$output = '';
		
		$output .= eltd_core_get_shortcode_module_template_part('templates/tab-template','tabs', '', $params);
		
		return $output;
	}
	
	/**
	 * Generates holder classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getHolderClasses($params){
		$holder_classes = array();
		
		$holder_classes[] = !empty($params['type']) ? 'eltd-tabs-'.esc_attr($params['type']) : 'eltd-tabs-standard';
		
		return implode(' ', $holder_classes);
	}
}