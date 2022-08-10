<?php

namespace ElatedCore\CPT\Shortcodes\ContentSlider;

use ElatedCore\Lib;

/**
 * class Content Slider
 */
class ContentSlider implements Lib\ShortcodeInterface
{
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'eltd_content_slider';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(array(
                'name' => esc_html__('Content Slider Item', 'eltd-core'),
                'base' => $this->base,
                'icon' => 'icon-wpb-content-slider-item extended-custom-icon',
                'category' => esc_html__('by ELATED', 'eltd-core'),
                'allowed_container_element' => 'vc_row',
                'as_child' => array('only' => 'eltd_content_slider_holder'),
                'params' => array_merge(
	                array(
		                array(
			                'type' => 'attach_image',
			                'admin_label' => true,
			                'heading' => esc_html__('Slide Image', 'eltd-core'),
			                'param_name' => 'image',
			                'value' => '',
			                'description' => esc_html__('Select image from media library.', 'eltd-core'),
		                ),
		                array(
			                'type' => 'dropdown',
			                'class' => '',
			                'heading' => esc_html__('Image Position', 'eltd-core'),
			                'param_name' => 'image_position',
			                'value' => array(
				                esc_html__('Right', 'eltd-core') => 'right',
				                esc_html__('Left', 'eltd-core') => 'left'
			                ),
			                'save_always' => true,
			                'description' => ''
		                ),
		                array(
			                'type' => 'colorpicker',
			                'heading' => esc_html('Content Background', 'eltd-core'),
			                'param_name' => 'content_background',
			                'description' => '',
		                ),
		                array(
			                'type' => 'dropdown',
			                'heading' => esc_html__('Content Align', 'eltd-core'),
			                'param_name' => 'content_align',
			                'value' => array(
				                esc_html__('Left', 'eltd-core') => 'left',
				                esc_html__('Center', 'eltd-core') => 'center',
				                esc_html__('Right', 'eltd-core') => 'right'
			                ),
			                'save_always' => true,
		                ),
		                array(
			                'type' => 'textfield',
			                'heading' => esc_html__('Title', 'eltd-core'),
			                'param_name' => 'title',
			                'value' => '',
			                'save_always' => true,
			                'admin_label' => true
		                ),
		                array(
			                'type' => 'dropdown',
			                'heading' => esc_html__('Tag', 'eltd-core'),
			                'param_name' => 'title_tag',
			                'value' => array(
				                'h2' => 'h2',
				                'h3' => 'h3',
				                'h4' => 'h4',
				                'h5' => 'h5',
				                'h6' => 'h6'
			                ),
			                'save_always' => true,
			                'dependency' => array('element' => 'title', 'not_empty' => true)
		                ),
		                array(
			                'type' => 'textarea',
			                'heading' => esc_html__('Content', 'eltd-core'),
			                'param_name' => 'text',
		                ),
		                array(
			                'type' => 'dropdown',
			                'heading' => esc_html__('Show Button', 'eltd-core'),
			                'param_name' => 'show_button',
			                'value' => array(
				                esc_html__('No', 'eltd-core') => 'no',
				                esc_html__('Yes', 'eltd-core') => 'yes'
			                ),
			                'admin_label' => true,
			                'save_always' => true,
			                'description' => ''
		                ),
		                array(
			                'type' => 'textfield',
			                'heading' => esc_html__('Button Text', 'eltd-core'),
			                'param_name' => 'button_text',
			                'value' => '',
			                'save_always' => true,
			                'dependency' => array('element' => 'show_button', 'value' => array('yes')),
		                ),
		                array(
			                'type' => 'textfield',
			                'heading' => esc_html__('Button Link', 'eltd-core'),
			                'param_name' => 'button_link',
			                'value' => '',
			                'save_always' => true,
			                'dependency' => array('element' => 'button_text', 'not_empty' => true)
		                ),
		                array(
			                'type' => 'dropdown',
			                'heading' => esc_html__('Button Target', 'eltd-core'),
			                'param_name' => 'button_target',
			                'value' => array(
				                esc_html__('Same Window', 'eltd-core') => '_self',
				                esc_html__('New Window', 'eltd-core') => '_blank'
			                ),
			                'save_always' => true,
			                'dependency' => array('element' => 'button_link', 'not_empty' => true)
		                ),
		                array(
			                'type' => 'dropdown',
			                'heading' => esc_html__('Button Size', 'eltd-core'),
			                'param_name' => 'button_size',
			                'value' => array(
				                esc_html__('Small', 'eltd-core') => 'small',
				                esc_html__('Medium', 'eltd-core') => 'medium',
				                esc_html__('Large', 'eltd-core') => 'large',
			                ),
			                'description' => '',
			                'save_always' => true,
			                'dependency' => array('element' => 'button_link', 'not_empty' => true),
		                ),
	                ),
	                findme_elated_icon_collections()->getVCParamsArray(array('element' => 'show_button', 'value' => 'yes'))
                )
            ));
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'image' => '',
            'image_position' => '',
            'title' => '',
            'title_tag' => '',
            'text' => '',
            'content_background' => '',
            'content_align' => '',
            'show_button' => '',
            'button_text' => '',
            'button_link' => '',
            'button_target' => '',
            'button_size' => '',
        );

	    $args = array_merge($args, findme_elated_icon_collections()->getShortcodeParams());
	    $params = shortcode_atts($args, $atts);
	    extract($params);

        $params['content_style'] = $this->getContentStyle($params);
        $params['button_params'] = $this->getButtonParams($params);

	    $output = eltd_core_get_shortcode_module_template_part('templates/content-slider', 'content-slider', '', $params);

        return $output;
    }

    private function getButtonParams($params) {
        $button_params = array();

        if (!empty($params['button_link'])) {
            $button_params['link'] = $params['button_link'];
        }

        if (!empty($params['button_size'])) {
            $button_params['size'] = $params['button_size'];
        }

        if (!empty($params['button_target'])) {
            $button_params['target'] = $params['button_target'];
        }

        if (!empty($params['button_text'])) {
            $button_params['text'] = $params['button_text'];
        }
	    if (!empty($params['icon_pack'])) {
		    $iconParam = findme_elated_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		    $button_params['icon_pack'] = $params['icon_pack'];
		    $button_params[$iconParam] = $params[$iconParam];
	    }

        $button_params['type'] = 'solid';
        $button_params['background_color'] = '#2c84cc';
        $button_params['hover_background_color'] = '#2396f3';
        $button_params['icon_bck_color'] = '#4292d1';
        $button_params['icon_bck_hover_color'] = '#39a1f6';

        return $button_params;
    }


    private function getContentStyle($params) {

        $content_style = array();

        if (!empty($params['content_background'])) {
            $content_style[] = 'background-color: ' . $params['content_background'];
        }

        if (!empty($params['content_align'])) {
            $content_style[] = 'text-align:' . $params['content_align'];
        }

        return implode(';', $content_style);
    }
}