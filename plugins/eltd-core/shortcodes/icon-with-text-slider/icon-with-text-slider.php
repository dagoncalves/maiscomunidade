<?php
namespace ElatedCore\CPT\Shortcodes\IconWithTextSlider;

use ElatedCore\Lib;

class IconWithTextSlider implements Lib\ShortcodeInterface {
    private $base;
	
    function __construct() {
        $this->base = 'eltd_icon_with_text_slider';
        add_action('vc_before_init', array($this, 'vcMap'));
    }
	
    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
	    if(function_exists('vc_map')) {
		    vc_map(
		    	array(
                    'name'                    => esc_html__( 'Elated Icon With Text Slider', 'eltd-core' ),
					'base'                    => $this->base,
					'as_parent'               => array( 'only' => 'eltd_icon_with_text' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by ELATED', 'eltd-core' ),
					'icon'                    => 'icon-wpb-icon-with-text extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
                    'params'                  => array(
                        array(
							'type'       => 'textfield',
							'param_name' => 'iwt_class',
							'heading'    => esc_html__( 'Custom CSS Class', 'eltd-core' )
						),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'item_number',
                            'heading'     => esc_html__('Number', 'eltd-core'),
                            'description' => esc_html__('Number of items', 'eltd-core'),
                            'value'       => array(
                                esc_html__( 'Two', 'eltd-core' )  => '2',
								esc_html__( 'Tree', 'eltd-core' ) => '3',
                                esc_html__( 'Four', 'eltd-core' ) => '4'
                            ),
                            'save_always' => true
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'slider_loop',
                            'heading'     => esc_html__('Enable Slider Loop', 'eltd-core'),
                            'value'       => array_flip(findme_elated_get_yes_no_select_array(false, true)),
                            'save_always' => true
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'slider_autoplay',
                            'heading'     => esc_html__('Enable Slider Autoplay', 'eltd-core'),
                            'value'       => array_flip(findme_elated_get_yes_no_select_array(false, true)),
                            'save_always' => true
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'slider_speed',
                            'heading'     => esc_html__('Slide Duration', 'eltd-core'),
                            'description' => esc_html__('Default value is 5000 (ms)', 'eltd-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'slider_speed_animation',
                            'heading'     => esc_html__('Slide Animation Duration', 'eltd-core'),
                            'description' => esc_html__('Speed of slide animation in milliseconds. Default value is 600.', 'eltd-core'),
                        ),
                        array(
                            'type'		  => 'dropdown',
                            'param_name'  => 'slider_navigation',
                            'heading'	  => esc_html__('Enable Slider Navigation Arrows', 'eltd-core'),
                            'value'       => array_flip(findme_elated_get_yes_no_select_array(false, true)),
                            'save_always' => true
                        ),
                        array(
                            'type'		  => 'dropdown',
                            'param_name'  => 'slider_pagination',
                            'heading'	  => esc_html__('Enable Slider Pagination', 'eltd-core'),
                            'value'       => array_flip(findme_elated_get_yes_no_select_array(false, true)),
                            'save_always' => true
                        )
                    )
				)
			);
		}
	}
    
    public function render($atts, $content = null) {
		$default_atts = array(
			'iwt_class'               => '',
            'item_number'             => '',
	        'slider_loop'		      => 'yes',
	        'slider_autoplay'		  => 'yes',
	        'slider_speed'		      => '5000',
	        'slider_speed_animation'  => '600',
	        'slider_navigation'	      => 'yes',
	        'slider_pagination'	      => 'yes'
		);
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);

		$params['content']   = $content;
        $params['data_attr'] = $this->getSliderData($params);

		$output = '';

		$output .= eltd_core_get_shortcode_module_template_part('templates/iwt-slider-holder-template','icon-with-text-slider', '', $params);

		return $output;
	}
    
    private function getSliderData($params) {
        $slider_data = array();

        $slider_data['data-number-of-items']        = !empty($params['item_number']) ? $params['item_number'] : '4';
        $slider_data['data-enable-loop']            = !empty($params['slider_loop']) ? $params['slider_loop'] : '';
        $slider_data['data-enable-autoplay']        = !empty($params['slider_autoplay']) ? $params['slider_autoplay'] : '';
        $slider_data['data-slider-speed']           = !empty($params['slider_speed']) ? $params['slider_speed'] : '5000';
        $slider_data['data-slider-speed-animation'] = !empty($params['slider_speed_animation']) ? $params['slider_speed_animation'] : '600';
        $slider_data['data-enable-navigation']      = !empty($params['slider_navigation']) ? $params['slider_navigation'] : '';
        $slider_data['data-enable-pagination']      = !empty($params['slider_pagination']) ? $params['slider_pagination'] : '';

        return $slider_data;
    }
}