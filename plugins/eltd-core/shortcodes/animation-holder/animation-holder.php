<?php
namespace ElatedCore\CPT\Shortcodes\AnimationHolder;

use ElatedCore\Lib;

class AnimationHolder implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'eltd_animation_holder';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return	$this->base;
	}

	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Elated Animation Holder', 'eltd-core' ),
					'base'                    => $this->base,
					"as_parent"               => array( 'except' => 'vc_row' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by ELATED', 'eltd-core' ),
					'icon'                    => 'icon-wpb-animation-holder extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'       => 'dropdown',
							'param_name' => 'animation',
							'heading'    => esc_html__( 'Animation Type', 'eltd-core' ),
							'value'      => array(
								esc_html__( 'Element Grow In', 'eltd-core' )          => 'eltd-grow-in',
								esc_html__( 'Element Fade In Down', 'eltd-core' )     => 'eltd-fade-in-down',
								esc_html__( 'Element From Fade', 'eltd-core' )        => 'eltd-element-from-fade',
								esc_html__( 'Element From Left', 'eltd-core' )        => 'eltd-element-from-left',
								esc_html__( 'Element From Right', 'eltd-core' )       => 'eltd-element-from-right',
								esc_html__( 'Element From Top', 'eltd-core' )         => 'eltd-element-from-top',
								esc_html__( 'Element From Bottom', 'eltd-core' )      => 'eltd-element-from-bottom',
								esc_html__( 'Element Flip In', 'eltd-core' )          => 'eltd-flip-in',
								esc_html__( 'Element X Rotate', 'eltd-core' )         => 'eltd-x-rotate',
								esc_html__( 'Element Z Rotate', 'eltd-core' )         => 'eltd-z-rotate',
								esc_html__( 'Element Y Translate', 'eltd-core' )      => 'eltd-y-translate',
								esc_html__( 'Element Fade In X Rotate', 'eltd-core' ) => 'eltd-fade-in-left-x-rotate',
							),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'animation_delay',
							'heading'    => esc_html__( 'Animation Delay (ms)', 'eltd-core' )
						)
					)
				)
			);
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'animation'       => '',
			'animation_delay' => ''
        );

        extract(shortcode_atts($args, $atts));

        $html = '<div class="eltd-animation-holder '. esc_attr($animation) .'" data-animation="'.esc_attr($animation).'" data-animation-delay="'.esc_attr($animation_delay).'"><div class="eltd-animation-inner">'.do_shortcode($content).'</div></div>';

        return $html;
	}
}