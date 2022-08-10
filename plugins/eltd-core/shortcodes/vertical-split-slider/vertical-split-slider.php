<?php
namespace ElatedCore\CPT\Shortcodes\VerticalSplitSlider;

use ElatedCore\Lib;

class VerticalSplitSlider implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltd_vertical_split_slider';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Elated Vertical Split Slider', 'eltd-core' ),
					'base'                    => $this->base,
					'icon'                    => 'icon-wpb-vertical-split-slider extended-custom-icon',
					'category'                => esc_html__( 'by ELATED', 'eltd-core' ),
					'as_parent'               => array( 'only' => 'eltd_vertical_split_slider_left_panel, eltd_vertical_split_slider_right_panel' ),
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

		$html = '';

		$html .= '<div class="eltd-vertical-split-slider">';
		$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;
	}
}
