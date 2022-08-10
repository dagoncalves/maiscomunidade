<?php
namespace ElatedCore\CPT\Shortcodes\VerticalSplitSliderRightPanel;

use ElatedCore\Lib;

class VerticalSplitSliderRightPanel implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'eltd_vertical_split_slider_right_panel';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Elated Right Sliding Panel', 'eltd-core' ),
					'base'                    => $this->base,
					'as_parent'               => array( 'only' => 'eltd_vertical_split_slider_content_item' ),
					'as_child'                => array( 'only' => 'eltd_vertical_split_slider' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by ELATED', 'eltd-core' ),
					'icon'                    => 'icon-wpb-vertical-split-slider-right-panel extended-custom-icon',
					'show_settings_on_create' => false,
					'js_view'                 => 'VcColumnView'
				)
			);
		}
	}

	public function render($atts, $content = null) {
		$args = array();

		$params = shortcode_atts($args, $atts);
		extract($params);

		$html = '<div class="eltd-vss-ms-right">';
		$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;
	}
}
