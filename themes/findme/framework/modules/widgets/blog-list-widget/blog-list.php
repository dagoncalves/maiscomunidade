<?php

class FindmeElatedBlogListWidget extends FindmeElatedWidget {
    public function __construct() {
        parent::__construct(
            'eltd_blog_list_widget',
            esc_html__('Elated Blog List Widget', 'findme'),
            array( 'description' => esc_html__( 'Display a list of your blog posts', 'findme'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type'  => 'textfield',
                'name'  => 'widget_title',
                'title' => esc_html__('Widget Title', 'findme')
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'type',
                'title'   => esc_html__('Type', 'findme'),
                'options' => array(
                    'simple'  => esc_html__('Simple', 'findme'),
                    'minimal' => esc_html__('Minimal', 'findme'),
                    'advanced' => esc_html__('Advanced', 'findme')
                )
            ),
            array(
                'type'  => 'textfield',
                'name'  => 'number_of_posts',
                'title' => esc_html__('Number of Posts', 'findme')
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'space_between_columns',
                'title'   => esc_html__('Space Between items', 'findme'),
                'options' => array(
                    'normal' => esc_html__('Normal', 'findme'),
                    'small'  => esc_html__('Small', 'findme'),
                    'tiny'   => esc_html__('Tiny', 'findme'),
                    'no'     => esc_html__('No Space', 'findme')
                )
            ),
	        array(
		        'type'    => 'dropdown',
		        'name'    => 'order_by',
		        'title'   => esc_html__('Order By', 'findme'),
		        'options' => findme_elated_get_query_order_by_array()
	        ),
	        array(
		        'type'    => 'dropdown',
		        'name'    => 'order',
		        'title'   => esc_html__('Order', 'findme'),
		        'options' => findme_elated_get_query_order_array()
	        ),
            array(
                'type'        => 'textfield',
                'name'        => 'category',
                'title'       => esc_html__('Category Slug', 'findme'),
                'description' => esc_html__('Leave empty for all or use comma for list', 'findme')
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'title_tag',
                'title'   => esc_html__('Title Tag', 'findme'),
                'options' => findme_elated_get_title_tag(true)
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'title_transform',
                'title'   => esc_html__('Title Text Transform', 'findme'),
                'options' => findme_elated_get_text_transform_array(true)
            ),
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

        $instance['post_info_section'] = 'yes';
        $instance['number_of_columns'] = '1';

        // Filter out all empty params
        $instance = array_filter($instance, function($array_value) { return trim($array_value) != ''; });

        //generate shortcode params
        foreach($instance as $key => $value) {
            $params .= " $key='$value' ";
        }

        if(!isset($instance['type'])){
            $params['type'] = 'simple';    
        }

        echo '<div class="widget eltd-blog-list-widget">';
            if(!empty($instance['widget_title'])) {
	            echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
            }

            echo do_shortcode("[eltd_blog_list $params]"); // XSS OK
        echo '</div>';
    }
}