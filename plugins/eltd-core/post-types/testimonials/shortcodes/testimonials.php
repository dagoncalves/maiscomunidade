<?php
namespace ElatedCore\CPT\Shortcodes\Testimonials;

use ElatedCore\Lib;

class Testimonials implements Lib\ShortcodeInterface{
    private $base;

    public function __construct() {
        $this->base = 'eltd_testimonials';

        add_action('vc_before_init', array($this, 'vcMap'));
	
	    //Testimonials category filter
	    add_filter( 'vc_autocomplete_eltd_testimonials_category_callback', array( &$this, 'testimonialsCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
	
	    //Testimonials category render
	    add_filter( 'vc_autocomplete_eltd_testimonials_category_render', array( &$this, 'testimonialsCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
        if(function_exists('vc_map')) {
            vc_map( array(
                'name' => esc_html__( 'Elated Testimonials', 'eltd-core' ),
                'base' => $this->base,
                'category' => esc_html__('by ELATED', 'eltd-core'),
                'icon' => 'icon-wpb-testimonials extended-custom-icon',
                'allowed_container_element' => 'vc_row',
                'params' => array(
	                array(
		                'type'       => 'dropdown',
		                'param_name' => 'type',
		                'heading'    => esc_html__('Type', 'eltd-core'),
		                'value'      => array(
			                esc_html__('Standard', 'eltd-core') => 'standard',
			                esc_html__('Boxed', 'eltd-core') => 'boxed',
		                ),
		                'save_always' => true
	                ),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'skin',
                        'heading'    => esc_html__('Skin', 'eltd-core'),
                        'value'      => array(
                            esc_html__('Dark', 'eltd-core') => 'dark',
                            esc_html__('Light', 'eltd-core') => 'light',
                        ),
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'number',
                        'heading'     => esc_html__('Number', 'eltd-core'),
                        'description' => esc_html__('Number of Testimonials', 'eltd-core')
                    ),
	                array(
		                'type'        => 'dropdown',
		                'param_name'  => 'visible_items',
		                'heading'     => esc_html__('Number of Visible Items', 'eltd-core'),
		                'value'       => array(
		                	esc_html__('Three', 'eltd-core') => '3',
		                	esc_html__('Six', 'eltd-core') => '6'
		                ),
		                'dependency'  => Array('element' => 'type', 'value' => 'boxed')
	                ),
                    array(
                        'type'        => 'autocomplete',
                        'param_name'  => 'category',
                        'heading'     => esc_html__('Category', 'eltd-core'),
                        'description' => esc_html__('Enter one category slug (leave empty for showing all categories)', 'eltd-core')
                    ),
	                array(
		                'type'       => 'colorpicker',
		                'param_name' => 'box_color',
		                'heading'    => esc_html__('Content Box Color', 'eltd-core'),
		                'dependency' => Array('element' => 'type', 'value' => 'boxed')
	                ),
	                array(
		                'type'        => 'dropdown',
		                'param_name'  => 'slider_loop',
		                'heading'     => esc_html__('Enable Slider Loop', 'eltd-core'),
		                'value'       => array_flip(findme_elated_get_yes_no_select_array(false, true)),
		                'save_always' => true,
		                'group'       => esc_html__('Slider Settings', 'eltd-core')
	                ),
	                array(
		                'type'        => 'dropdown',
		                'param_name'  => 'slider_autoplay',
		                'heading'     => esc_html__('Enable Slider Autoplay', 'eltd-core'),
		                'value'       => array_flip(findme_elated_get_yes_no_select_array(false, true)),
		                'save_always' => true,
		                'group'       => esc_html__('Slider Settings', 'eltd-core')
	                ),
	                array(
		                'type'        => 'textfield',
		                'param_name'  => 'slider_speed',
		                'heading'     => esc_html__('Slide Duration', 'eltd-core'),
		                'description' => esc_html__('Default value is 5000 (ms)', 'eltd-core'),
		                'group'       => esc_html__('Slider Settings', 'eltd-core')
	                ),
	                array(
		                'type'        => 'textfield',
		                'param_name'  => 'slider_speed_animation',
		                'heading'     => esc_html__('Slide Animation Duration', 'eltd-core'),
		                'description' => esc_html__('Speed of slide animation in milliseconds. Default value is 600.', 'eltd-core'),
		                'group'       => esc_html__('Slider Settings', 'eltd-core')
	                ),
	                array(
		                'type'		  => 'dropdown',
		                'param_name'  => 'slider_navigation',
		                'heading'	  => esc_html__('Enable Slider Navigation Arrows', 'eltd-core'),
		                'value'       => array_flip(findme_elated_get_yes_no_select_array(false, true)),
		                'save_always' => true,
		                'group'       => esc_html__('Slider Settings', 'eltd-core')
	                ),
	                array(
		                'type'		  => 'dropdown',
		                'param_name'  => 'slider_pagination',
		                'heading'	  => esc_html__('Enable Slider Pagination', 'eltd-core'),
		                'value'       => array_flip(findme_elated_get_yes_no_select_array(false, true)),
		                'save_always' => true,
		                'group'       => esc_html__('Slider Settings', 'eltd-core')
	                )
                )
            ) );
        }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
	        'type'                    => '',
	        'skin'                    => '',
            'number'                  => '-1',
            'visible_items'           => '3',
            'category'                => '',
            'box_color'               => '',
	        'slider_loop'		      => 'yes',
	        'slider_autoplay'		  => 'yes',
	        'slider_speed'		      => '5000',
	        'slider_speed_animation'  => '600',
	        'slider_navigation'	      => 'yes',
	        'slider_pagination'	      => 'yes'
        );

        $params = shortcode_atts($args, $atts);
        extract($params);

	    $holder_classes = $this->getHolderClasses($params);

        $query_args = $this->getQueryParams($params);
        $query_results = new \WP_Query($query_args);

	    $params['box_styles'] = $this->getBoxStyles($params);
        $data_attr = $this->getSliderData($params);
    
        $html = '';
        $html .= '<div class="eltd-testimonials-holder ' . $holder_classes . ' clearfix">';
            $html .= '<div class="eltd-testimonials eltd-owl-slider"  ' . findme_elated_get_inline_attrs($data_attr) . '>';

            if ($query_results->have_posts()){
             
                $counter = 0;
                
                if ($type === 'boxed'){
                    
                    $html .= '<div class="eltd-testimonials-items-holder">';
                    
                }
                

                while ($query_results->have_posts()) : $query_results->the_post();
                    $counter++;
                    
                    $title = get_post_meta(get_the_ID(), 'eltd_testimonial_title', true);
                    $text = get_post_meta(get_the_ID(), 'eltd_testimonial_text', true);
                    $author = get_post_meta(get_the_ID(), 'eltd_testimonial_author', true);
                    $address = get_post_meta(get_the_ID(), 'eltd_testimonial_address', true);
                    $website = get_post_meta(get_the_ID(), 'eltd_testimonial_website', true);

                    $params['current_id'] = get_the_ID();
                    $params['title'] = $title;
                    $params['text'] = $text;
                    $params['author'] = $author;
                    $params['address'] = $address;
                    $params['website'] = $website;

                    $html .= eltd_core_get_cpt_shortcode_module_template_part('testimonials', 'testimonials-' . $params['type'], '', $params);
                    
                    //checks if max number(6) of items reached per slider and opens another one
                    //else it just closes it
	                if($type === 'boxed' && (int)$number !== $counter){
						if($visible_items === '6' && $counter%6 === 0){
							$html .= '</div><div clas="eltd-testimonials-items-holder">';
						}
						elseif ($visible_items === '3' && $counter%3 === 0){
							$html .= '</div><div clas="eltd-testimonials-items-holder">';
						}
	                }

                endwhile;
                
                if ($type === 'boxed'){
                    $html .= '</div>';
                }
            } 
            
            else{
                    $html .= esc_html__('Sorry, no posts matched your criteria.', 'eltd-core');
    
            }

            wp_reset_postdata();

            $html .= '</div>';
    
        $html .= '</div>';
    
        return $html;

    }

	/**
	 * Generates holder classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getHolderClasses($params){
		$holderClasses = '';

		$holderClasses .= ' eltd-testimonials-' . $params['type'];

		$holderClasses .= ' eltd-testimonials-' . $params['skin'];

		return $holderClasses;
	}

    /**
     * Generates testimonials query attribute array
     *
     * @param $params
     *
     * @return array
     */
    private function getQueryParams($params) {
        $args = array(
            'post_status' => 'publish',
            'post_type' => 'testimonials',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => $params['number']
        );
        
        if ($params['category'] != '') {
            $args['testimonials-category'] = $params['category'];
        }
        
        return $args;
    }

	/**
	 * Returns array of box styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function getBoxStyles($params) {
		$styles = array();

		if($params['type'] === 'boxed' && !empty($params['box_color'])) {
			$styles[] = 'background-color: '.$params['box_color'];
		}

		return $styles;
	}
	
	/**
	 * Return all configuration data for slider
	 *
	 * @param $params
	 * @return array
	 */
	private function getSliderData($params) {
		$slider_data = array();
		
		$slider_data['data-number-of-items']        = 1;
		$slider_data['data-enable-loop']            = !empty($params['slider_loop']) ? $params['slider_loop'] : '';
		$slider_data['data-enable-autoplay']        = !empty($params['slider_autoplay']) ? $params['slider_autoplay'] : '';
		$slider_data['data-slider-speed']           = !empty($params['slider_speed']) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation'] = !empty($params['slider_speed_animation']) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-enable-navigation']      = !empty($params['slider_navigation']) ? $params['slider_navigation'] : '';
		$slider_data['data-enable-pagination']      = !empty($params['slider_pagination']) ? $params['slider_pagination'] : '';
		
		return $slider_data;
	}
	
	/**
	 * Filter testimonials categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function testimonialsCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS testimonials_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'testimonials-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['testimonials_category_title'] ) > 0 ) ? esc_html__( 'Category', 'eltd-core' ) . ': ' . $value['testimonials_category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
		
	}
	
	/**
	 * Find testimonials category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function testimonialsCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$testimonials_category = get_term_by( 'slug', $query, 'testimonials-category' );
			if ( is_object( $testimonials_category ) ) {
				
				$testimonials_category_slug = $testimonials_category->slug;
				$testimonials_category_title = $testimonials_category->name;
				
				$testimonials_category_title_display = '';
				if ( ! empty( $testimonials_category_title ) ) {
					$testimonials_category_title_display = esc_html__( 'Category', 'eltd-core' ) . ': ' . $testimonials_category_title;
				}
				
				$data          = array();
				$data['value'] = $testimonials_category_slug;
				$data['label'] = $testimonials_category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
}