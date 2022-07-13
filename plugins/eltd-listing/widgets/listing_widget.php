<?php

class ElatedListingWidget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'eltd_listing_widget',
			esc_html__('Elated Listing Widget', 'eltd-listing'),
			array( 'description' => esc_html__( 'Add listing element to widget areas', 'eltd-listing'))
		);

		$this->setParams();        
	}

	/**
	 * Sets widget options
	 */
	protected function setParams() {
		$this->params =array(
		    array(
			'type'    => 'dropdown',
			'name'    => 'listing_type',
			'title'   => esc_html__('Type', 'eltd-listing'),
			'options' => array()
		    ),
		    array(
			'type'    => 'dropdown',
			'name'    => 'listing_category',
			'title'   => esc_html__('Category', 'eltd-listing'),
			'options' => array(
			)
		    ),
		    array(
			'type'    => 'textfield',
			'name'    => 'listing_list_number',
			'title'   => esc_html__('Number of Items', 'eltd-listing')
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

		// Default values
		if (!isset($instance['listing_list_number'])) { 
		    $instance['listing_list_number'] = 3;
		}
		   
		    

		$instance['listing_list_columns'] = 'one';
		foreach ($instance as $key => $value) {
			if($value !== '') {				
				$params .= $key .'='. esc_attr($value). ' ';
			}
		}
		
		echo '<div class="widget eltd-listing-widget">';
			echo do_shortcode("[eltd_listing_list $params]"); // XSS OK
		echo '</div>';
	}
    
}