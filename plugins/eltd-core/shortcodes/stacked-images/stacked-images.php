<?php
namespace ElatedCore\CPT\Shortcodes\StackedImages;

use ElatedCore\Lib;

class StackedImages implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'eltd_stacked_images';

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
					'name'     => esc_html__( 'Elated Stacked Images', 'eltd-core' ),
					'base'     => $this->base,
					'category' => esc_html__( 'by ELATED', 'eltd-core' ),
					'icon'     => 'icon-wpb-stacked-images extended-custom-icon',
					'params'   => array(
						array(
							'type'       => 'attach_image',
							'param_name' => 'item_image',
							'heading'    => esc_html__( 'Image', 'eltd-core' )
						),
						array(
							'type'       => 'attach_image',
							'param_name' => 'item_stack_image',
							'heading'    => esc_html__( 'Stack Image', 'eltd-core' )
						)
					)
				)
			);
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'item_image'           => '',
			'item_stack_image'     => ''
		);
		$params = shortcode_atts($args, $atts);
		
		$html = eltd_core_get_shortcode_module_template_part('templates/stacked-images', 'stacked-images', '', $params);

		return $html;
	}
}