<?php
namespace ElatedCore\CPT\Shortcodes\Button;

use ElatedCore\Lib;

class Button implements Lib\ShortcodeInterface {
    private $base;
	
    public function __construct() {
        $this->base = 'eltd_button';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base attribute
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
	    if(function_exists('vc_map')) {
		    vc_map(
		    	array(
				    'name'                      => esc_html__( 'Elated Button', 'eltd-core' ),
				    'base'                      => $this->base,
				    'category'                  => esc_html__( 'by ELATED', 'eltd-core' ),
				    'icon'                      => 'icon-wpb-button extended-custom-icon',
				    'allowed_container_element' => 'vc_row',
				    'params'                    => array_merge(
					    array(
						    array(
							    'type'       => 'textfield',
							    'param_name' => 'custom_class',
							    'heading'    => esc_html__( 'Custom CSS Class', 'eltd-core' )
						    ),
						    array(
							    'type'        => 'dropdown',
							    'param_name'  => 'type',
							    'heading'     => esc_html__( 'Type', 'eltd-core' ),
							    'value'       => array(
								    esc_html__( 'Solid', 'eltd-core' )   => 'solid',
								    esc_html__( 'Outline', 'eltd-core' ) => 'outline',
								    esc_html__( 'Simple', 'eltd-core' )  => 'simple'
							    ),
							    'admin_label' => true
						    ),
						    array(
							    'type'       => 'dropdown',
							    'param_name' => 'size',
							    'heading'    => esc_html__( 'Size', 'eltd-core' ),
							    'value'      => array(
								    esc_html__( 'Default', 'eltd-core' ) => '',
								    esc_html__( 'Small', 'eltd-core' )   => 'small',
								    esc_html__( 'Medium', 'eltd-core' )  => 'medium',
								    esc_html__( 'Large', 'eltd-core' )   => 'large',
								    esc_html__( 'Huge', 'eltd-core' )    => 'huge'
							    ),
							    'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) )
						    ),
						    array(
							    'type'        => 'textfield',
							    'param_name'  => 'text',
							    'heading'     => esc_html__( 'Text', 'eltd-core' ),
							    'value'       => esc_html__( 'Button Text', 'eltd-core' ),
							    'save_always' => true,
							    'admin_label' => true
						    ),
						    array(
							    'type'        => 'dropdown',
							    'param_name'  => 'fullwidth',
							    'heading'     => esc_html__( 'Full Width', 'eltd-core' ),
							    'value'       => array_flip( findme_elated_get_yes_no_select_array() ),
							    'save_always' => true
						    ),
						    array(
							    'type'       => 'textfield',
							    'param_name' => 'link',
							    'heading'    => esc_html__( 'Link', 'eltd-core' )
						    ),
						    array(
							    'type'        => 'dropdown',
							    'param_name'  => 'target',
							    'heading'     => esc_html__( 'Link Target', 'eltd-core' ),
							    'value'       => array_flip( findme_elated_get_link_target_array() ),
							    'save_always' => true
						    ),
                            array(
                                'type'        => 'textfield',
                                'param_name'  => 'text_right_margin',
                                'heading'     => esc_html__( 'Space between text and icon in px', 'eltd-core' ),
                                'dependency'  => array( 'element' => 'icon_pack', 'not_empty' => true )
                            )
                        ),
					    findme_elated_icon_collections()->getVCParamsArray( array(), '', true ),
					    array(
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'color',
							    'heading'    => esc_html__( 'Color', 'eltd-core' ),
							    'group'      => esc_html__( 'Design Options', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'hover_color',
							    'heading'    => esc_html__( 'Hover Color', 'eltd-core' ),
							    'group'      => esc_html__( 'Design Options', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'background_color',
							    'heading'    => esc_html__( 'Background Color', 'eltd-core' ),
							    'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) ),
							    'group'      => esc_html__( 'Design Options', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'hover_background_color',
							    'heading'    => esc_html__( 'Hover Background Color', 'eltd-core' ),
							    'group'      => esc_html__( 'Design Options', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'border_color',
							    'heading'    => esc_html__( 'Border Color', 'eltd-core' ),
							    'group'      => esc_html__( 'Design Options', 'eltd-core' )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'hover_border_color',
							    'heading'    => esc_html__( 'Hover Border Color', 'eltd-core' ),
							    'group'      => esc_html__( 'Design Options', 'eltd-core' )
						    ),
                            array(
                                'type'       => 'colorpicker',
                                'param_name' => 'icon_color',
                                'heading'    => esc_html__( 'Icon Color', 'eltd-core' ),
                                'group'      => esc_html__( 'Design Options', 'eltd-core' ),
                                'dependency' => array(
                                    'element' => 'type',
                                    'value'   => 'solid'
                                )
                            ),
                            array(
                                'type'       => 'colorpicker',
                                'param_name' => 'icon_hover_color',
                                'heading'    => esc_html__( 'Icon Hover Color', 'eltd-core' ),
                                'group'      => esc_html__( 'Design Options', 'eltd-core' ),
                                'dependency' => array(
                                    'element' => 'type',
                                    'value'   => 'solid'
                                )
                            ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'icon_bck_color',
							    'heading'    => esc_html__( 'Icon Background Color', 'eltd-core' ),
							    'group'      => esc_html__( 'Design Options', 'eltd-core' ),
							    'dependency' => array(
							    	'element' => 'type',
								    'value'   => 'solid'
							    )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'icon_bck_hover_color',
							    'heading'    => esc_html__( 'Icon Background Hover Color', 'eltd-core' ),
							    'group'      => esc_html__( 'Design Options', 'eltd-core' ),
							    'dependency' => array(
								    'element' => 'type',
								    'value'   => 'solid'
							    )
						    ),
						    array(
							    'type'       => 'textfield',
							    'param_name' => 'font_size',
							    'heading'    => esc_html__( 'Font Size (px)', 'eltd-core' ),
							    'group'      => esc_html__( 'Design Options', 'eltd-core' )
						    ),
						    array(
							    'type'        => 'dropdown',
							    'param_name'  => 'font_weight',
							    'heading'     => esc_html__( 'Font Weight', 'eltd-core' ),
							    'value'       => array_flip( findme_elated_get_font_weight_array( true ) ),
							    'save_always' => true,
							    'group'       => esc_html__( 'Design Options', 'eltd-core' )
						    ),
						    array(
							    'type'        => 'textfield',
							    'param_name'  => 'margin',
							    'heading'     => esc_html__( 'Margin', 'eltd-core' ),
							    'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'eltd-core' ),
							    'group'       => esc_html__( 'Design Options', 'eltd-core' )
						    ),
                            array(
                                'type'        => 'textfield',
                                'param_name'  => 'padding',
                                'heading'     => esc_html__( 'Padding', 'eltd-core' ),
                                'description' => esc_html__( 'Insert padding in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'eltd-core' ),
                                'group'       => esc_html__( 'Design Options', 'eltd-core' )
                            ),
						    array(
							    'type'        => 'dropdown',
							    'param_name'  => 'text_align',
							    'heading'     => esc_html__( 'Text Align', 'eltd-core' ),
							    'value'       => array(
							    	esc_html__('Center', 'eltd-core') => 'center',
							    	esc_html__('Left', 'eltd-core') => 'left',
							    	esc_html__('Right', 'eltd-core') => 'right'
							    ),
							    'save_always'   => true,
							    'group'       => esc_html__( 'Design Options', 'eltd-core' )
						    )
					    )
				    )
			    )
		    );
	    }
    }

    /**
     * Renders HTML for button shortcode
     *
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'size'                   => '',
            'type'                   => 'solid',
            'text'                   => '',
	        'fullwidth'               => '',
            'link'                   => '',
            'target'                 => '_self',
            'color'                  => '',
            'hover_color'            => '',
            'background_color'       => '',
            'hover_background_color' => '',
            'border_color'           => '',
            'hover_border_color'     => '',
            'icon_color'             => '',
            'icon_hover_color'       => '',
            'icon_bck_color'         => '',
            'icon_bck_hover_color'   => '',
            'font_size'              => '',
            'font_weight'            => '',
            'margin'                 => '',
            'custom_class'           => '',
            'html_type'              => 'anchor',
            'input_name'             => '',
	        'text_align'             => '',
            'text_right_margin'      => '',
            'custom_attrs'           => array(),
            'padding'                => ''
        );

        $default_atts = array_merge($default_atts, findme_elated_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);

        if($params['html_type'] !== 'input') {
            $iconPackName   = findme_elated_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
            $params['icon'] = $iconPackName ? $params[$iconPackName] : '';
        }

        $params['size'] = !empty($params['size']) ? $params['size'] : 'medium';
        $params['type'] = !empty($params['type']) ? $params['type'] : 'solid';


        $params['link']   = !empty($params['link']) ? $params['link'] : '#';
        $params['target'] = !empty($params['target']) ? $params['target'] : $default_atts['target'];

        //prepare params for template
        $params['button_classes']      = $this->getButtonClasses($params);
        $params['button_custom_attrs'] = !empty($params['custom_attrs']) ? $params['custom_attrs'] : array();
        $params['button_styles']       = $this->getButtonStyles($params);
        $params['text_styles']         = $this->getTextStyles($params);
        $params['button_data']         = $this->getButtonDataAttr($params);
        $params['icon_styles']         = $this->getButtonIconStyles($params);

        return eltd_core_get_shortcode_module_template_part('templates/'.$params['html_type'], 'button', '', $params);
    }

    /**
     * Returns array of button styles
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonStyles($params) {
        $styles = array();

        if(!empty($params['color'])) {
            $styles[] = 'color: '.$params['color'];
        }

        if(!empty($params['background_color']) && $params['type'] !== 'outline') {
            $styles[] = 'background-color: '.$params['background_color'];
        }

        if(!empty($params['border_color'])) {
            $styles[] = 'border-color: '.$params['border_color'];
        }

        if(!empty($params['font_size'])) {
            $styles[] = 'font-size: '.findme_elated_filter_px($params['font_size']).'px';
        }

        if(!empty($params['font_weight']) && $params['font_weight'] !== '') {
            $styles[] = 'font-weight: '.$params['font_weight'];
        }

        if(!empty($params['margin'])) {
            $styles[] = 'margin: '.$params['margin'];
        }

        if(!empty($params['padding'])) {
            $styles[] = 'padding: '.$params['padding'];
        }

	    if(!empty($params['text_align'])) {
		    $styles[] = 'text-align: '.$params['text_align'];
	    }

        return $styles;
    }

    private function getTextStyles($params){
        $style = array();

        if(!empty($params['text_right_margin'])) {
	        $style['text-right-margin'] = 'margin-right: '.$params['text_right_margin'].'px';
        }

        return $style;

    }

    /**
     *
     * Returns array of button data attr
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonDataAttr($params) {
        $data = array();

        if(!empty($params['hover_color'])) {
            $data['data-hover-color'] = $params['hover_color'];
        }

        if(!empty($params['hover_background_color'])) {
            $data['data-hover-bg-color'] = $params['hover_background_color'];
        }

        if(!empty($params['hover_border_color'])) {
            $data['data-hover-border-color'] = $params['hover_border_color'];
        }

        if(!empty($params['icon_hover_color'])) {
            $data['data-icon-hover-color'] = $params['icon_hover_color'];
        }


	    if($params['type'] === 'solid'){

		    if(!empty($params['icon_bck_color'])) {
			    $data['data-icon-bck-color'] = $params['icon_bck_color'];
		    }
		    if(!empty($params['icon_bck_hover_color'])) {
			    $data['data-icon-bck-hover-color'] = $params['icon_bck_hover_color'];
		    }

	    }



        return $data;
    }

    private function getButtonIconStyles($params){

	    $styles = array();

        if(!empty($params['icon_color'])) {
            $styles[] = 'color: ' .$params['icon_color'];
        }

	    if(!empty($params['icon_bck_color'])){
			$styles[] = 'background-color: '.$params['icon_bck_color'];
	    }

		return $styles;
    }

    /**
     * Returns array of HTML classes for button
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonClasses($params) {
        $buttonClasses = array(
            'eltd-btn',
            'eltd-btn-'.$params['size'],
            'eltd-btn-'.$params['type']
        );

	    if(!empty($params['fullwidth']) && $params['fullwidth'] === 'yes') {
		    $buttonClasses[] = 'eltd-btn-fullwidth';
	    }

        if(!empty($params['hover_background_color'])) {
            $buttonClasses[] = 'eltd-btn-custom-hover-bg';
        }

        if(!empty($params['hover_border_color'])) {
            $buttonClasses[] = 'eltd-btn-custom-border-hover';
        }

        if(!empty($params['hover_color'])) {
            $buttonClasses[] = 'eltd-btn-custom-hover-color';
        }

        if(!empty($params['icon'])) {
            $buttonClasses[] = 'eltd-btn-icon';
        }

        if(!empty($params['custom_class'])) {
            $buttonClasses[] = esc_attr($params['custom_class']);
        }

        return $buttonClasses;
    }
}