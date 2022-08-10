<?php
namespace ElatedCore\CPT\Shortcodes\ElementsHolder;

use ElatedCore\Lib;

class ElementsHolderItem implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'eltd_elements_holder_item';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')){
			vc_map( 
				array(
					'name' => esc_html__( 'Elated Elements Holder Item', 'eltd-core' ),
					'base' => $this->base,
					'as_child' => array('only' => 'eltd_elements_holder'),
					'as_parent' => array('except' => 'vc_row, vc_accordion'),
					'content_element' => true,
					'category' => esc_html__('by ELATED', 'eltd-core'),
					'icon' => 'icon-wpb-elements-holder-item extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view' => 'VcColumnView',
					'params' => array(
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__('Background Color', 'eltd-core')
						),
						array(
							'type'       => 'attach_image',
							'param_name' => 'background_image',
							'heading'    => esc_html__('Background Image', 'eltd-core')
						),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'border_radius',
                            'heading'     => esc_html__('Border radius', 'eltd-core'),
                            'description' => esc_html__('Please insert border radius in format 0px 10px 0px 10px', 'eltd-core')
                        ),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding',
							'heading'     => esc_html__('Padding', 'eltd-core'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'eltd-core')
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'horizontal_aligment',
							'heading'    => esc_html__('Horizontal Alignment', 'eltd-core'),
							'value'      => array(
								esc_html__('Left', 'eltd-core')    	=> 'left',
								esc_html__('Right', 'eltd-core')     => 'right',
								esc_html__('Center', 'eltd-core')    => 'center'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'vertical_alignment',
							'heading'    => esc_html__('Vertical Alignment', 'eltd-core'),
							'value'      => array(
								esc_html__('Middle', 'eltd-core')    => 'middle',
								esc_html__('Top', 'eltd-core')    	=> 'top',
								esc_html__('Bottom', 'eltd-core')    => 'bottom'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'animation',
							'heading'    => esc_html__('Animation Type', 'eltd-core'),
							'value'      => array(
								esc_html__('Default (No Animation)', 'eltd-core') => '',
								esc_html__('Element Grow In', 'eltd-core') => 'eltd-grow-in',
								esc_html__('Element Fade In Down', 'eltd-core') => 'eltd-fade-in-down',
								esc_html__('Element From Fade', 'eltd-core') => 'eltd-element-from-fade',
								esc_html__('Element From Left', 'eltd-core') => 'eltd-element-from-left',
								esc_html__('Element From Right', 'eltd-core') => 'eltd-element-from-right',
								esc_html__('Element From Top', 'eltd-core') => 'eltd-element-from-top',
								esc_html__('Element From Bottom', 'eltd-core') => 'eltd-element-from-bottom',
								esc_html__('Element Flip In', 'eltd-core') => 'eltd-flip-in',
								esc_html__('Element X Rotate', 'eltd-core') => 'eltd-x-rotate',
								esc_html__('Element Z Rotate', 'eltd-core') => 'eltd-z-rotate',
								esc_html__('Element Y Translate', 'eltd-core') => 'eltd-y-translate',
								esc_html__('Element Fade In X Rotate', 'eltd-core') => 'eltd-fade-in-left-x-rotate',
							)
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'animation_delay',
							'heading'    => esc_html__('Animation Delay (ms)', 'eltd-core')
						),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'item_padding_1280_1600',
                            'heading'     => esc_html__('Padding on screen size between 1280px-1600px', 'eltd-core'),
                            'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'eltd-core'),
                            'group'       => esc_html__('Width & Responsiveness', 'eltd-core')
                        ),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_1024_1280',
							'heading'     => esc_html__('Padding on screen size between 1024px-1280px', 'eltd-core'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'eltd-core'),
							'group'       => esc_html__('Width & Responsiveness', 'eltd-core')
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_768_1024',
							'heading'     => esc_html__('Padding on screen size between 768px-1024px', 'eltd-core'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'eltd-core'),
							'group'       => esc_html__('Width & Responsiveness', 'eltd-core')
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_600_768',
							'heading'     => esc_html__('Padding on screen size between 600px-768px', 'eltd-core'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'eltd-core'),
							'group'       => esc_html__('Width & Responsiveness', 'eltd-core')
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_480_600',
							'heading'     => esc_html__('Padding on screen size between 480px-600px', 'eltd-core'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'eltd-core'),
							'group'       => esc_html__('Width & Responsiveness', 'eltd-core')
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_480',
							'heading'     => esc_html__('Padding on Screen Size Bellow 480px', 'eltd-core'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'eltd-core'),
							'group'       => esc_html__('Width & Responsiveness', 'eltd-core')
						)
					)
				)
			);			
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'background_color'          => '',
			'background_image'          => '',
			'item_padding'              => '',
			'horizontal_aligment'       => '',
			'vertical_alignment'        => '',
            'item_padding_1280_1600'    => '',
			'item_padding_1024_1280'    => '',
			'item_padding_768_1024'     => '',
			'item_padding_600_768'      => '',
			'item_padding_480_600'      => '',
			'item_padding_480'          => '',
			'animation'                 => '',
			'animation_delay'           => '',
            'border_radius'             =>''
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);
		$params['content']= $content;

		$rand_class = 'eltd-eh-custom-' . mt_rand(100000,1000000);

		$params['elements_holder_item_style']           = $this->getElementsHolderItemStyles($params);
		$params['elements_holder_item_content_style']   = $this->getElementsHolderItemContentStyles($params);
		$params['elements_holder_item_class']           = $this->getElementsHolderItemClass($params);
		$params['elements_holder_item_content_class']   = $rand_class;
		$params['elements_holder_item_responsive_data'] = $this->getElementsHolderItemContentResponsiveData($params);

		$html = eltd_core_get_shortcode_module_template_part('templates/elements-holder-item-template', 'elements-holder', '', $params);

		return $html;
	}
	
	/**
	 * Return Elements Holder Item style
	 *
	 * @param $params
	 * @return array
	 */
	private function getElementsHolderItemStyles($params) {
		$styles = array();

		if ($params['background_color'] !== '') {
			$styles[] = 'background-color: '.$params['background_color'];
		}
		
		if ($params['background_image'] !== '') {
			$styles[] = 'background-image: url(' . wp_get_attachment_url($params['background_image']) . ')';
		}

        if ($params['border_radius'] !== '') {
            $styles[] = 'border-radius: '.$params['border_radius'];
        }

		return implode(';', $styles);
	}

	/**
	 * Return Elements Holder Item Content style
	 *
	 * @param $params
	 * @return array
	 */
	private function getElementsHolderItemContentStyles($params) {
		$styles = array();

		if ($params['item_padding'] !== '') {
			$styles[] = 'padding: '.$params['item_padding'];
		}

		return implode(';', $styles);
	}

	/**
	 * Return Elements Holder Item classes
	 *
	 * @param $params
	 * @return array
	 */
	private function getElementsHolderItemClass($params) {
		$classes = array();
		
		if (!empty($params['vertical_alignment'])) {
			$classes[] = 'eltd-vertical-alignment-'. $params['vertical_alignment'];
		}
		
		if (!empty($params['horizontal_aligment'])) {
			$classes[] = 'eltd-horizontal-alignment-'. $params['horizontal_aligment'];
		}
		
		if (!empty($params['animation'])) {
			$classes[] = esc_attr($params['animation']);
		}
		
		return implode(' ', $classes);
	}

	/**
	 * Return Elements Holder Item Content Responssive data
	 *
	 * @param $params
	 * @return array
	 */
	private function getElementsHolderItemContentResponsiveData($params) {
		$data = array();
		$data['data-item-class'] = $params['elements_holder_item_content_class'];
		
		if (!empty($params['animation'])) {
			$data['data-animation'] = $params['animation'];
		}
		
		if ($params['animation_delay'] !== '') {
			$data['data-animation-delay'] = esc_attr($params['animation_delay']);
		}

		if ($params['item_padding_1280_1600'] !== '') {
			$data['data-1280-1600'] = $params['item_padding_1280_1600'];
		}

		if ($params['item_padding_1024_1280'] !== '') {
			$data['data-1024-1280'] = $params['item_padding_1024_1280'];
		}

		if ($params['item_padding_768_1024'] !== '') {
			$data['data-768-1024'] = $params['item_padding_768_1024'];
		}

		if ($params['item_padding_600_768'] !== '') {
			$data['data-600-768'] = $params['item_padding_600_768'];
		}

		if ($params['item_padding_480_600'] !== '') {
			$data['data-480-600'] = $params['item_padding_480_600'];
		}

		if ($params['item_padding_480'] !== '') {
			$data['data-480'] = $params['item_padding_480'];
		}

		return $data;
	}
}
