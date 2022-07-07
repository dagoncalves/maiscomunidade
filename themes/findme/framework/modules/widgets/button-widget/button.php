<?php

class FindmeElatedButtonWidget extends FindmeElatedWidget {
	public function __construct() {
		parent::__construct(
			'eltd_button_widget',
			esc_html__('Elated Button Widget', 'findme'),
			array( 'description' => esc_html__( 'Add button element to widget areas', 'findme'))
		);

		$this->setParams();
	}

	/**
	 * Sets widget options
	 */
	protected function setParams() {
		$this->params = array_merge(
            findme_elated_icon_collections()->getIconWidgetParamsArray(),
            array(
                array(
                    'type'    => 'dropdown',
                    'name'    => 'type',
                    'title'   => esc_html__('Type', 'findme'),
                    'options' => array(
                        'solid'   => esc_html__('Solid', 'findme'),
                        'outline' => esc_html__('Outline', 'findme'),
                        'simple'  => esc_html__('Simple', 'findme')
                    )
                ),
                array(
                    'type'    => 'dropdown',
                    'name'    => 'size',
                    'title'   => esc_html__('Size', 'findme'),
                    'options' => array(
                        'small'  => esc_html__('Small', 'findme'),
                        'medium' => esc_html__('Medium', 'findme'),
                        'large'  => esc_html__('Large', 'findme'),
                        'huge'   => esc_html__('Huge', 'findme')
                    ),
                    'description' => esc_html__('This option is only available for solid and outline button type', 'findme')
                ),
                array(
                    'type'    => 'textfield',
                    'name'    => 'text',
                    'title'   => esc_html__('Text', 'findme'),
                    'default' => esc_html__('Button Text', 'findme')
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'link',
                    'title' => esc_html__('Link', 'findme')
                ),
                array(
                    'type'    => 'dropdown',
                    'name'    => 'target',
                    'title'   => esc_html__('Link Target', 'findme'),
                    'options' => findme_elated_get_link_target_array()
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'color',
                    'title' => esc_html__('Color', 'findme')
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'hover_color',
                    'title' => esc_html__('Hover Color', 'findme')
                ),
                array(
                    'type'        => 'textfield',
                    'name'        => 'background_color',
                    'title'       => esc_html__('Background Color', 'findme'),
                    'description' => esc_html__('This option is only available for solid button type', 'findme')
                ),
                array(
                    'type'        => 'textfield',
                    'name'        => 'hover_background_color',
                    'title'       => esc_html__('Hover Background Color', 'findme'),
                    'description' => esc_html__('This option is only available for solid button type', 'findme')
                ),
                array(
                    'type'        => 'textfield',
                    'name'        => 'border_color',
                    'title'       => esc_html__('Border Color', 'findme'),
                    'description' => esc_html__('This option is only available for solid and outline button type', 'findme')
                ),
                array(
                    'type'        => 'textfield',
                    'name'        => 'hover_border_color',
                    'title'       => esc_html__('Hover Border Color', 'findme'),
                    'description' => esc_html__('This option is only available for solid and outline button type', 'findme')
                ),
	            array(
		            'type'        => 'textfield',
		            'name'        => 'icon_bck_color',
		            'title'       => esc_html__('Icon Background Color', 'findme'),
	            ),
	            array(
		            'type'        => 'textfield',
		            'name'        => 'icon_bck_hover_color',
		            'title'       => esc_html__('Icon Background Hover Color', 'findme'),
	            ),
                array(
                    'type'        => 'textfield',
                    'name'        => 'margin',
                    'title'       => esc_html__('Margin', 'findme'),
                    'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'findme')
                )
            )
		);
	}

	/**
	 * Generates widget's HTML
	 *
	 * @param array $args args from widget area
	 * @param array $instance widget's options
	 */
	public function widget($args, $instance) {
		$params = '';
        
		if (!is_array($instance)) { $instance = array(); }

		// Filter out all empty params
		$instance = array_filter($instance, function($array_value) { return trim($array_value) != ''; });

		// Default values
		if (!isset($instance['text'])) { $instance['text'] = 'Button Text'; }

		// Generate shortcode params
		foreach($instance as $key => $value) {
			$params .= " $key='$value' ";
		}
        
		echo '<div class="widget eltd-button-widget">';
			echo do_shortcode("[eltd_button $params]"); // XSS OK
		echo '</div>';
	}
}