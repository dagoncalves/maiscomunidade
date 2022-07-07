<?php

class FindmeElatedSeparatorWidget extends FindmeElatedWidget {
    public function __construct() {
        parent::__construct(
            'eltd_separator_widget',
	        esc_html__('Elated Separator Widget', 'findme'),
	        array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'findme'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type' => 'dropdown',
                'name' => 'type',
                'title' => esc_html__('Type', 'findme'),
                'options' => array(
                    'normal' => esc_html__('Normal', 'findme'),
                    'full-width' => esc_html__('Full Width', 'findme')
                )
            ),
            array(
                'type' => 'dropdown',
                'name' => 'position',
                'title' => esc_html__('Position', 'findme'),
                'options' => array(
                    'center' => esc_html__('Center', 'findme'),
                    'left' => esc_html__('Left', 'findme'),
                    'right' => esc_html__('Right', 'findme')
                )
            ),
            array(
                'type' => 'dropdown',
                'name' => 'border_style',
                'title' => esc_html__('Style', 'findme'),
                'options' => array(
                    'solid' => esc_html__('Solid', 'findme'),
                    'dashed' => esc_html__('Dashed', 'findme'),
                    'dotted' => esc_html__('Dotted', 'findme')
                )
            ),
            array(
                'type' => 'textfield',
                'name' => 'color',
                'title' => esc_html__('Color', 'findme')
            ),
            array(
                'type' => 'textfield',
                'name' => 'width',
                'title' => esc_html__('Width', 'findme')
            ),
            array(
                'type' => 'textfield',
                'name' => 'thickness',
                'title' => esc_html__('Thickness (px)', 'findme')
            ),
            array(
                'type' => 'textfield',
                'name' => 'top_margin',
                'title' => esc_html__('Top Margin', 'findme')
            ),
            array(
                'type' => 'textfield',
                'name' => 'bottom_margin',
                'title' => esc_html__('Bottom Margin', 'findme')
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
        extract($args);

        //prepare variables
        $params = '';

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params .= " $key='$value' ";
            }
        }

        echo '<div class="widget eltd-separator-widget">';
            echo do_shortcode("[eltd_separator $params]"); // XSS OK
        echo '</div>';
    }
}