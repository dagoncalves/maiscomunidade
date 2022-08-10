<?php
namespace ElatedCore\CPT\Shortcodes\IconWithText;

use ElatedCore\Lib;

class IconWithText implements Lib\ShortcodeInterface {
    private $base;
	
    public function __construct() {
        $this->base = 'eltd_icon_with_text';

        add_action('vc_before_init', array($this, 'vcMap'));
    }
	
    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
	    if(function_exists('vc_map')) {
		    vc_map(
		    	array(
				    'name'                      => esc_html__( 'Elated Icon With Text', 'eltd-core' ),
				    'base'                      => $this->base,
				    'icon'                      => 'icon-wpb-icon-with-text extended-custom-icon',
				    'category'                  => esc_html__( 'by ELATED', 'eltd-core' ),
				    'allowed_container_element' => 'vc_row',
				    'params'                    => array_merge(
					    array(
						    array(
							    'type'        => 'dropdown',
							    'param_name'  => 'type',
							    'heading'     => esc_html__( 'Type', 'eltd-core' ),
							    'value'       => array(
								    esc_html__( 'Icon Left From Text', 'eltd-core' )  => 'icon-left',
								    esc_html__( 'Icon Left From Title', 'eltd-core' ) => 'icon-left-from-title',
								    esc_html__( 'Icon Top', 'eltd-core' )             => 'icon-top',
                                    esc_html__( 'Icon Top With Hover', 'eltd-core' )  => 'icon-top-hover'
							    ),
							    'save_always' => true
						    )
					    ),
					    findme_elated_icon_collections()->getVCParamsArray(),
					    array(
						    array(
							    'type'       => 'attach_image',
							    'param_name' => 'custom_icon',
							    'heading'    => esc_html__( 'Custom Icon', 'eltd-core' )
						    ),
                            array(
                                'type'       => 'attach_image',
                                'param_name' => 'custom_icon_hover',
                                'heading'    => esc_html__( 'Custom Hover Icon', 'eltd-core' ),
                                'dependency' => array( 'element' => 'type', 'value' => array( 'icon-top-hover' ) )
                            ),
						    array(
							    'type'       => 'dropdown',
							    'param_name' => 'icon_type',
							    'heading'    => esc_html__( 'Icon Type', 'eltd-core' ),
							    'value'      => array(
								    esc_html__( 'Normal', 'eltd-core' ) => 'eltd-normal',
								    esc_html__( 'Circle', 'eltd-core' ) => 'eltd-circle',
								    esc_html__( 'Square', 'eltd-core' ) => 'eltd-square'
							    ),
							    'group'      => esc_html__( 'Icon Settings', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'dropdown',
							    'param_name' => 'icon_size',
							    'heading'    => esc_html__( 'Icon Size', 'eltd-core' ),
							    'value'      => array(
								    esc_html__( 'Medium', 'eltd-core' )     => 'eltd-icon-medium',
								    esc_html__( 'Tiny', 'eltd-core' )       => 'eltd-icon-tiny',
								    esc_html__( 'Small', 'eltd-core' )      => 'eltd-icon-small',
								    esc_html__( 'Large', 'eltd-core' )      => 'eltd-icon-large',
								    esc_html__( 'Very Large', 'eltd-core' ) => 'eltd-icon-huge'
							    ),
							    'group'      => esc_html__( 'Icon Settings', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'textfield',
							    'param_name' => 'custom_icon_size',
							    'heading'    => esc_html__( 'Custom Icon Size (px)', 'eltd-core' ),
							    'group'      => esc_html__( 'Icon Settings', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'textfield',
							    'param_name' => 'shape_size',
							    'heading'    => esc_html__( 'Shape Size (px)', 'eltd-core' ),
							    'group'      => esc_html__( 'Icon Settings', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'icon_color',
							    'heading'    => esc_html__( 'Icon Color', 'eltd-core' ),
							    'group'      => esc_html__( 'Icon Settings', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'icon_hover_color',
							    'heading'    => esc_html__( 'Icon Hover Color', 'eltd-core' ),
							    'group'      => esc_html__( 'Icon Settings', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'icon_background_color',
							    'heading'    => esc_html__( 'Icon Background Color', 'eltd-core' ),
							    'dependency' => array( 'element' => 'icon_type', 'value'   => array( 'eltd-square', 'eltd-circle' ) ),
							    'group'      => esc_html__( 'Icon Settings', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'icon_hover_background_color',
							    'heading'    => esc_html__( 'Icon Hover Background Color', 'eltd-core' ),
							    'dependency' => array( 'element' => 'icon_type', 'value'   => array( 'eltd-square', 'eltd-circle' ) ),
							    'group'      => esc_html__( 'Icon Settings', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'icon_border_color',
							    'heading'    => esc_html__( 'Icon Border Color', 'eltd-core' ),
							    'dependency' => array( 'element' => 'icon_type', 'value'   => array( 'eltd-square', 'eltd-circle' ) ),
							    'group'      => esc_html__( 'Icon Settings', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'icon_border_hover_color',
							    'heading'    => esc_html__( 'Icon Border Hover Color', 'eltd-core' ),
							    'dependency' => array( 'element' => 'icon_type', 'value'   => array( 'eltd-square', 'eltd-circle' ) ),
							    'group'      => esc_html__( 'Icon Settings', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'textfield',
							    'param_name' => 'icon_border_width',
							    'heading'    => esc_html__( 'Border Width (px)', 'eltd-core' ),
							    'dependency' => array( 'element' => 'icon_type', 'value'   => array( 'eltd-square', 'eltd-circle' ) ),
							    'group'      => esc_html__( 'Icon Settings', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'dropdown',
							    'param_name' => 'icon_animation',
							    'heading'    => esc_html__( 'Icon Animation', 'eltd-core' ),
							    'value'      => array_flip( findme_elated_get_yes_no_select_array( false ) ),
							    'group'      => esc_html__( 'Icon Settings', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'textfield',
							    'param_name' => 'icon_animation_delay',
							    'heading'    => esc_html__( 'Icon Animation Delay (ms)', 'eltd-core' ),
							    'dependency' => array( 'element' => 'icon_animation', 'value' => array( 'yes' ) ),
							    'group'      => esc_html__( 'Icon Settings', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'textfield',
							    'param_name' => 'title',
							    'heading'    => esc_html__( 'Title', 'eltd-core' )
						    ),
						    array(
							    'type'        => 'dropdown',
							    'param_name'  => 'title_tag',
							    'heading'     => esc_html__( 'Title Tag', 'eltd-core' ),
							    'value'       => array_flip( findme_elated_get_title_tag( true ) ),
							    'save_always' => true,
							    'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							    'group'       => esc_html__( 'Text Settings', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'title_color',
							    'heading'    => esc_html__( 'Title Color', 'eltd-core' ),
							    'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							    'group'      => esc_html__( 'Text Settings', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'textfield',
							    'param_name' => 'title_top_margin',
							    'heading'    => esc_html__( 'Title Top Margin (px)', 'eltd-core' ),
							    'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							    'group'      => esc_html__( 'Text Settings', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'textarea',
							    'param_name' => 'text',
							    'heading'    => esc_html__( 'Text', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'text_color',
							    'heading'    => esc_html__( 'Text Color', 'eltd-core' ),
							    'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							    'group'      => esc_html__( 'Text Settings', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'textfield',
							    'param_name' => 'text_top_margin',
							    'heading'    => esc_html__( 'Text Top Margin (px)', 'eltd-core' ),
							    'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							    'group'      => esc_html__( 'Text Settings', 'eltd-core' )
						    ),
						    array(
							    'type'        => 'textfield',
							    'param_name'  => 'link',
							    'heading'     => esc_html__( 'Link', 'eltd-core' ),
							    'description' => esc_html__( 'Set link around icon and title', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'dropdown',
							    'param_name' => 'target',
							    'heading'    => esc_html__( 'Target', 'eltd-core' ),
							    'value'      => array_flip( findme_elated_get_link_target_array() ),
							    'dependency' => array( 'element' => 'link', 'not_empty' => true ),
						    ),
                            array(
							    'type'       => 'dropdown',
							    'param_name' => 'show_button',
							    'heading'    => esc_html__( 'Show Button', 'eltd-core' ),
							    'value'      => array_flip( findme_elated_get_yes_no_select_array( false ) ),
							    'dependency' => array( 'element' => 'type', 'value' => 'icon-top' ),
                                'save_always' => true
						    ),
						    array(
							    'type'        => 'textfield',
							    'param_name'  => 'text_padding',
							    'heading'     => esc_html__( 'Text Padding (px)', 'eltd-core' ),
							    'description' => esc_html__( 'Set left or top padding dependence of type for your text holder. Default value is 13 for left type and 25 for top icon with text type', 'eltd-core' ),
							    'dependency'  => array( 'element' => 'type', 'value' => array( 'icon-left', 'icon-top' ) ),
							    'group'       => esc_html__( 'Text Settings', 'eltd-core' )
						    )
					    )
				    )
			    )
		    );
	    }
    }

    /**
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'type'                        => 'icon-left',
            'custom_icon'                 => '',
            'custom_icon_hover'           => '',
            'icon_type'                   => 'eltd-normal',
            'icon_size'                   => 'eltd-icon-medium',
            'custom_icon_size'            => '',
            'shape_size'                  => '',
            'icon_color'                  => '',
            'icon_hover_color'            => '',
            'icon_background_color'       => '',
            'icon_hover_background_color' => '',
            'icon_border_color'           => '',
            'icon_border_hover_color'     => '',
            'icon_border_width'           => '',
            'icon_animation'              => '',
            'icon_animation_delay'        => '',
            'title'                       => '',
            'title_tag'                   => 'h4',
            'title_color'                 => '',
	        'title_top_margin'            => '',
            'text'                        => '',
            'text_color'                  => '',
	        'text_top_margin'             => '',
            'link'                        => '',
            'target'                      => '_self',
            'text_padding'                => '',
            'show_button'                 => ''
        );

        $default_atts = array_merge($default_atts, findme_elated_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);
	
	    $params['type'] = !empty($params['type']) ? $params['type'] : $default_atts['type'];

        $params['icon_parameters'] = $this->getIconParameters($params);
        $params['holder_classes']  = $this->getHolderClasses($params);
	    $params['content_styles']  = $this->getContentStyles($params);
	    $params['title_styles']    = $this->getTitleStyles($params);
	    $params['title_tag']       = !empty($params['title_tag']) ? $params['title_tag'] : $default_atts['title_tag'];
        $params['text_styles']     = $this->getTextStyles($params);
	    $params['target']          = !empty($params['target']) ? $params['target'] : $default_atts['target'];
        $params['show_button_flag']  = $params['show_button'] === 'yes' ? true : false;

	    
		return eltd_core_get_shortcode_module_template_part('templates/iwt', 'icon-with-text', $params['type'], $params);
    }

    /**
     * Returns parameters for icon shortcode as a string
     *
     * @param $params
     *
     * @return array
     */
    private function getIconParameters($params) {
        $params_array = array();

        if(empty($params['custom_icon'])) {
            $iconPackName = findme_elated_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

            $params_array['icon_pack']   = $params['icon_pack'];
            $params_array[$iconPackName] = $params[$iconPackName];

            if(!empty($params['icon_size'])) {
                $params_array['size'] = $params['icon_size'];
            }

            if(!empty($params['custom_icon_size'])) {
                $params_array['custom_size'] = findme_elated_filter_px($params['custom_icon_size']).'px';
            }

            if(!empty($params['icon_type'])) {
                $params_array['type'] = $params['icon_type'];
            }
	
	        if(!empty($params['shape_size'])) {
		        $params_array['shape_size'] = findme_elated_filter_px($params['shape_size']).'px';
	        }

            if(!empty($params['icon_border_color'])) {
                $params_array['border_color'] = $params['icon_border_color'];
            }

            if(!empty($params['icon_border_hover_color'])) {
                $params_array['hover_border_color'] = $params['icon_border_hover_color'];
            }

            if($params['icon_border_width'] !== '') {
                $params_array['border_width'] = findme_elated_filter_px($params['icon_border_width']).'px';
            }

            if(!empty($params['icon_background_color'])) {
                $params_array['background_color'] = $params['icon_background_color'];
            }

            if(!empty($params['icon_hover_background_color'])) {
                $params_array['hover_background_color'] = $params['icon_hover_background_color'];
            }

            $params_array['icon_color'] = $params['icon_color'];

            if(!empty($params['icon_hover_color'])) {
                $params_array['hover_icon_color'] = $params['icon_hover_color'];
            }

            $params_array['icon_animation']       = $params['icon_animation'];
            $params_array['icon_animation_delay'] = $params['icon_animation_delay'];
        }

        return $params_array;
    }

    /**
     * Returns array of holder classes
     *
     * @param $params
     *
     * @return array
     */
    private function getHolderClasses($params) {
        $classes = array('eltd-iwt', 'clearfix');

	    if(!empty($params['type'])) {
		    $classes[] = 'eltd-iwt-'.$params['type'];
	    }

        if(!empty($params['icon_size'])) {
            $classes[] = 'eltd-iwt-'.str_replace('eltd-', '', $params['icon_size']);
        }

        return $classes;
    }
	
	/**
	 * Returns inline content styles
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getContentStyles($params) {
		$styles = array();
		
		if($params['text_padding'] !== '' && $params['type'] === 'icon-left') {
			$styles[] = 'padding-left: '.findme_elated_filter_px($params['text_padding']).'px';
		}
		
		if($params['text_padding'] !== '' && $params['type'] === 'icon-top') {
			$styles[] = 'padding-top: '.findme_elated_filter_px($params['text_padding']).'px';
		}

		return implode(';', $styles);
	}

	/**
     * Returns inline title styles
     *
     * @param $params
     *
     * @return string
     */
    private function getTitleStyles($params) {
        $styles = array();

        if(!empty($params['title_color'])) {
            $styles[] = 'color: '.$params['title_color'];
        }
	
	    if(!empty($params['title_top_margin'])) {
		    $styles[] = 'margin-top: '.findme_elated_filter_px($params['title_top_margin']).'px';
	    }

        return implode(';', $styles);
    }

	/**
     * Returns inline text styles
     *
     * @param $params
     *
     * @return string
     */
    private function getTextStyles($params) {
        $styles = array();

        if(!empty($params['text_color'])) {
            $styles[] = 'color: '.$params['text_color'];
        }
	    
	    if(!empty($params['text_top_margin'])) {
		    $styles[] = 'margin-top: '.findme_elated_filter_px($params['text_top_margin']).'px';
	    }

        return implode(';', $styles);
    }
}