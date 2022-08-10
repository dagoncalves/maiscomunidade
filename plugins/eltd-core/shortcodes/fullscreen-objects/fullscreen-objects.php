<?php
namespace ElatedCore\CPT\Shortcodes\FullscreenObjects;

use ElatedCore\Lib;

class FullscreenObjects implements Lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'eltd_fullscreen_objects';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/*
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {
		if (function_exists('vc_map')) {
			vc_map(
				array(
					'name'                      => esc_html__('Elated Fullscreen Objects', 'elated-core'),
					'base'                      => $this->base,
					'category'                  => esc_html__('by ELATED', 'elated-core'),
					'icon'                      => 'icon-wpb-fullscreen-objects extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'mouse_wheel_control',
							'value'       => array(
								esc_html__('No', 'elated-core')  => 'no',
								esc_html__('Yes', 'elated-core') => 'yes',
							),
							'save+always' => true,
							'heading'     => esc_html__('Mouse Wheel Control', 'elated-core'),
							'description' => esc_html__('', 'elated-core')
						),
						array(
							'type'       => 'param_group',
							'heading'    => esc_html__('Fullscreen Objects Items', 'elated-core'),
							'param_name' => 'fullscreen_objects_items',
							'value'      => '',
							'params'     => array(
								array(
									'type'        => 'attach_image',
									'param_name'  => 'background_image',
									'heading'     => esc_html__('Background Image', 'elated-core'),
									'description' => esc_html__('Select image from media library', 'elated-core')
								),
								array(
									'type'        => 'textfield',
									'param_name'  => 'title',
									'heading'     => esc_html__('Title', 'elated-core'),
									'description' => esc_html__('', 'elated-core')
								),
								array(
									'type'        => 'attach_image',
									'param_name'  => 'parallax_image',
									'heading'     => esc_html__('Parallax Image', 'elated-core'),
									'description' => esc_html__('Select image from media library', 'elated-core')
								),
								array(
									'type'        => 'textfield',
									'param_name'  => 'link',
									'heading'     => esc_html__('Link', 'elated-core'),
							    	'dependency' => array( 'element' => 'title', 'not_empty' => true)
								),
							    array(
								    'type'        => 'dropdown',
								    'param_name'  => 'target',
								    'heading'     => esc_html__( 'Link Target', 'elated-core' ),
								    'value'       => array_flip( findme_elated_get_link_target_array() ),
								    'save_always' => true,
							    	'dependency' => array( 'element' => 'link', 'not_empty' => true)
							    )
							)
						)
					)
				)
			);
		}
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'mouse_wheel_control'      => '',
			'fullscreen_objects_items' => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['content'] = $content;

		$params['fullscreen_objects'] = vc_param_group_parse_atts($atts['fullscreen_objects_items']);
		$params['data_params'] = $this->getDataParams($params);

		//Get HTML from template
		$html = eltd_core_get_shortcode_module_template_part('templates/fullscreen-objects-template', 'fullscreen-objects', '', $params);

		return $html;
	}

	/**
	 * Return Fullscreen Objects data params
	 *
	 * @param $params
	 * @return array
	 */
	private function getDataParams($params) {
		$data = array();

		$data['data-mouse-wheel-control'] = $params['mouse_wheel_control'];

		return $data;
	}
}