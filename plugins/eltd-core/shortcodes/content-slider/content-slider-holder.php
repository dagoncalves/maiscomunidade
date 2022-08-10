<?php

namespace ElatedCore\CPT\Shortcodes\ContentSlider;

use ElatedCore\Lib;

/**
 * class Content Slider Holder
 */
class ContentSliderHolder implements Lib\ShortcodeInterface{
    /**
     * @var string
     */
    private $base;

    function __construct() {

        $this->base = 'eltd_content_slider_holder';
        add_action('vc_before_init', array($this, 'vcMap'));

    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        if (function_exists('vc_map')) {
            vc_map(array(
                'name' => esc_html__('Content Slider', 'eltd-core'),
                'base' => $this->base,
                'as_parent' => array('only' => 'eltd_content_slider'),
                'content_element' => true,
                'category' => esc_html__('by ELATED', 'eltd-core'),
                'icon' => 'icon-wpb-content-slider-holder extended-custom-icon',
                'show_settings_on_create' => true,
                'js_view' => 'VcColumnView',
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Box Shadow', 'eltd-core'),
                        'param_name' => 'box_shadow',
                        'value' => array(
                            esc_html__('Default', 'eltd-core') => '',
                            esc_html__('Yes', 'eltd-core') => 'yes',
                            esc_html__('No', 'eltd-core') => 'no',
                        ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Slide duration', 'eltd-core'),
                        'admin_label' => true,
                        'param_name' => 'autoplay',
                        'value' => array(
                            esc_html__('3', 'eltd-core') => '3',
                            esc_html__('5', 'eltd-core') => '5',
                            esc_html__('10', 'eltd-core') => '10',
                            esc_html__('Disable', 'eltd-core') => 'disable',
                        ),
                        'save_always' => true,
                        'description' => esc_html__('Auto rotate slides each X seconds', 'eltd-core'),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Pause on hover', 'eltd-core'),
                        'param_name' => 'pause',
                        'value' => array(
                            esc_html__('Yes', 'eltd-core') => 'yes',
                            esc_html__('No', 'eltd-core') => 'no'
                        ),
                        'save_always' => true,
                        'dependency' => array(
                            'element' => 'autoplay',
                            'value' => array(
                                '3', '5', '10'
                            )
                        ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Loop', 'eltd-core'),
                        'param_name' => 'loop',
                        'value' => array(
                            esc_html__('Yes', 'eltd-core') => 'yes',
                            esc_html__('No', 'eltd-core') => 'no'
                        ),
                        'save_always' => true,
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Show Navigation Arrows', 'eltd-core'),
                        'param_name' => 'navigation',
                        'value' => array(
	                        esc_html__('No', 'eltd-core') => 'no',
                            esc_html__('Yes', 'eltd-core') => 'yes'
                        ),
                        'save_always' => true
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Navigation Position', 'eltd-core'),
                        'param_name' => 'navigation_position',
                        'value' => array(
                            esc_html__('Inside', 'eltd-core') => 'inside',
                            esc_html__('Outside', 'eltd-core') => 'outside'
                        ),
                        'std' => 'inside',
                        'save_always' => true,
                        'dependency' => array(
                            'element' => 'navigation',
                            'value' => array(
                                'yes'
                            )
                        ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Show Pagination', 'eltd-core'),
                        'param_name' => 'pagination',
                        'value' => array(
                            esc_html__('Yes', 'eltd-core') => 'yes',
                            esc_html__('No', 'eltd-core') => 'no'
                        ),
                        'save_always' => true,
                    ),
                ),
            ));
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'autoplay' => '',
            'pause' => '',
            'loop' => '',
            'navigation' => '',
            'navigation_position' => '',
            'pagination' => '',
            'box_shadow' => '',
        );

        $args = array_merge($args, findme_elated_icon_collections()->getShortcodeParams());
        $params = shortcode_atts($args, $atts);

        // extract params for use in method
        extract($params);
        $params['content'] = $content;
        $params['content_slider_classes'] = $this->getContentSliderClasses($params);
        $params['content_slider_data'] = $this->getContentSliderData($params);

        $output = '';

        $output .= eltd_core_get_shortcode_module_template_part('templates/content-slider-holder', 'content-slider', '', $params);

        return $output;
    }

    private function getContentSliderClasses($params) {
        $content_slider_classes = array();

        $content_slider_classes[] = ($params['navigation_position'] == 'inside') ? 'eltd-nav-inside' : '';
        $content_slider_classes[] = ($params['box_shadow'] == 'yes') ? 'eltd-box-shadow' : '';

        return implode(' ', $content_slider_classes);
    }

    /**
     * Return all configuration data for slider
     *
     * @param $params
     * @return array
     */
    private function getContentSliderData($params) {
        $content_slider_data = array();

        $content_slider_data['data-enable-autoplay'] = ($params['autoplay'] !== '') ? $params['autoplay'] : '';
        $content_slider_data['data-enable-autoplay-hover-pause'] = ($params['pause'] != '') ? $params['pause'] : '';
        $content_slider_data['data-enable-loop'] = ($params['loop'] !== '') ? $params['loop'] : '';
        $content_slider_data['data-enable-navigation'] = ($params['navigation'] !== '') ? $params['navigation'] : '';
        $content_slider_data['data-enable-pagination'] = ($params['pagination'] !== '') ? $params['pagination'] : '';

        return $content_slider_data;
    }
}
