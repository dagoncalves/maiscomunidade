<?php
namespace ElatedCore\CPT\Shortcodes\Accordion;

use ElatedCore\Lib;

class Accordion implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'eltd_accordion';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return	$this->base;
	}

	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Elated Accordion', 'eltd-core' ),
					'base'                    => $this->base,
					'as_parent'               => array( 'only' => 'eltd_accordion_tab' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by ELATED', 'eltd-core' ),
					'icon'                    => 'icon-wpb-accordion extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'       => 'textfield',
							'param_name' => 'el_class',
							'heading'    => esc_html__( 'Custom CSS Class', 'eltd-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'style',
							'heading'    => esc_html__( 'Style', 'eltd-core' ),
							'value'      => array(
								esc_html__( 'Accordion', 'eltd-core' ) => 'accordion',
								esc_html__( 'Toggle', 'eltd-core' )    => 'toggle'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'layout',
							'heading'    => esc_html__( 'Layout', 'eltd-core' ),
							'value'      => array(
								esc_html__( 'Boxed', 'eltd-core' )  => 'boxed',
								esc_html__( 'Simple', 'eltd-core' ) => 'simple'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'background_skin',
							'heading'    => esc_html__( 'Background Skin', 'eltd-core' ),
							'value'      => array(
								esc_html__( 'Default', 'eltd-core' ) => '',
								esc_html__( 'White', 'eltd-core' )   => 'white'
							),
							'dependency' => array( 'element' => 'layout', 'value' => array( 'boxed' ) )
						)
					)
				)
			);
		}
	}
	
	public function render($atts, $content = null) {
		$default_atts = array(
			'el_class'        => '',
			'title'           => '',
			'style'           => 'accordion',
			'layout'          => 'boxed',
			'background_skin' => ''
		);
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);

		$params['acc_class'] = $this->getAccordionClasses($params);
		$params['content'] = $content;

		$output = '';

		$output .= eltd_core_get_shortcode_module_template_part('templates/accordion-holder-template','accordions', '', $params);

		return $output;
	}

	/**
	   * Generates accordion classes
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function getAccordionClasses($params){
		$holder_classes = array('eltd-ac-default');

		switch($params['style']) {
            case 'toggle':
                $holder_classes[] = 'eltd-toggle';
                break;
            default:
	            $holder_classes[] = 'eltd-accordion';
                break;
        }
		
		if (!empty($params['layout'])) {
			$holder_classes[] = 'eltd-ac-'.esc_attr($params['layout']);
		}
		
		if (!empty($params['background_skin'])) {
			$holder_classes[] = 'eltd-'.esc_attr($params['background_skin']).'-skin';
		}

		if (!empty($params['el_class'])) {
			$holder_classes[] = esc_attr($params['el_class']);
		}

        return implode(' ', $holder_classes);
	}
}
