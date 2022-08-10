<?php
namespace ElatedCore\CPT\Shortcodes\Portfolio;

use ElatedCore\Lib;

class PortfolioSlider implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'eltd_portfolio_slider';

	    add_action('vc_before_init', array($this, 'vcMap'));

	    //Portfolio category filter
	    add_filter( 'vc_autocomplete_eltd_portfolio_slider_category_callback', array( &$this, 'portfolioCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Portfolio category render
	    add_filter( 'vc_autocomplete_eltd_portfolio_slider_category_render', array( &$this, 'portfolioCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Portfolio selected projects filter
	    add_filter( 'vc_autocomplete_eltd_portfolio_slider_selected_projects_callback', array( &$this, 'portfolioIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Portfolio selected projects render
	    add_filter( 'vc_autocomplete_eltd_portfolio_slider_selected_projects_render', array( &$this, 'portfolioIdAutocompleteRender', ), 10, 1 ); // Render exact portfolio. Must return an array (label,value)

	    //Portfolio tag filter
	    add_filter( 'vc_autocomplete_eltd_portfolio_slider_tag_callback', array( &$this, 'portfolioTagAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Portfolio tag render
	    add_filter( 'vc_autocomplete_eltd_portfolio_slider_tag_render', array( &$this, 'portfolioTagAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
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
		        'name'                      => esc_html__( 'Elated Portfolio Slider', 'eltd-core' ),
		        'base'                      => $this->base,
		        'category'                  => esc_html__( 'by ELATED', 'eltd-core' ),
		        'icon'                      => 'icon-wpb-portfolio-slider extended-custom-icon',
		        'allowed_container_element' => 'vc_row',
		        'params'                    => array(
			        array(
				        'type'        => 'textfield',
				        'param_name'  => 'number_of_items',
				        'heading'     => esc_html__( 'Number of Portfolios Items', 'eltd-core' ),
				        'admin_label' => true,
				        'description' => esc_html__( 'Set number of items for your portfolio slider. Enter -1 to show all', 'eltd-core' )
			        ),
			        array(
				        'type'        => 'dropdown',
				        'param_name'  => 'number_of_columns',
				        'heading'     => esc_html__( 'Number of Columns', 'eltd-core' ),
				        'value'       => array(
					        esc_html__( 'Default', 'eltd-core' ) => '',
					        esc_html__( 'One', 'eltd-core' )     => '1',
					        esc_html__( 'Two', 'eltd-core' )     => '2',
					        esc_html__( 'Three', 'eltd-core' )   => '3',
					        esc_html__( 'Four', 'eltd-core' )    => '4',
					        esc_html__( 'Five', 'eltd-core' )    => '5'
				        ),
				        'description' => esc_html__( 'Number of portfolios that are showing at the same time in slider (on smaller screens is responsive so there will be less items shown). Default value is Four', 'eltd-core' ),
				        'save_always' => true,
					    'admin_label' => true
			        ),
			        array(
				        'type'        => 'dropdown',
				        'param_name'  => 'space_between_items',
				        'heading'     => esc_html__( 'Space Between Portfolio Items', 'eltd-core' ),
				        'value'       => array(
					        esc_html__( 'Normal', 'eltd-core' )   => 'normal',
					        esc_html__( 'Small', 'eltd-core' )    => 'small',
					        esc_html__( 'Tiny', 'eltd-core' )     => 'tiny',
					        esc_html__( 'No Space', 'eltd-core' ) => 'no'
				        ),
				        'save_always' => true,
					    'admin_label' => true
			        ),
			        array(
				        'type'        => 'dropdown',
				        'param_name'  => 'image_proportions',
				        'heading'     => esc_html__( 'Image Proportions', 'eltd-core' ),
				        'value'       => array(
					        esc_html__( 'Original', 'eltd-core' )  => 'full',
					        esc_html__( 'Square', 'eltd-core' )    => 'square',
					        esc_html__( 'Landscape', 'eltd-core' ) => 'landscape',
					        esc_html__( 'Portrait', 'eltd-core' )  => 'portrait',
					        esc_html__( 'Medium', 'eltd-core' )    => 'medium',
					        esc_html__( 'Large', 'eltd-core' )     => 'large'
				        ),
				        'description' => esc_html__( 'Set image proportions for your portfolio slider.', 'eltd-core' ),
				        'save_always' => true
			        ),
			        array(
				        'type'        => 'autocomplete',
				        'param_name'  => 'category',
				        'heading'     => esc_html__( 'One-Category Portfolio List', 'eltd-core' ),
				        'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'eltd-core' )
			        ),
			        array(
				        'type'        => 'autocomplete',
				        'param_name'  => 'selected_projects',
				        'heading'     => esc_html__( 'Show Only Projects with Listed IDs', 'eltd-core' ),
				        'settings'    => array(
					        'multiple'      => true,
					        'sortable'      => true,
					        'unique_values' => true
				        ),
				        'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'eltd-core' )
			        ),
			        array(
				        'type'        => 'autocomplete',
				        'param_name'  => 'tag',
				        'heading'     => esc_html__( 'One-Tag Portfolio List', 'eltd-core' ),
				        'description' => esc_html__( 'Enter one tag slug (leave empty for showing all tags)', 'eltd-core' )
			        ),
			        array(
				        'type'        => 'dropdown',
				        'param_name'  => 'order_by',
				        'heading'     => esc_html__('Order By', 'eltd-core'),
				        'value'       => array_flip(findme_elated_get_query_order_by_array()),
				        'save_always' => true
			        ),
			        array(
				        'type'       => 'dropdown',
				        'param_name' => 'order',
				        'heading'    => esc_html__('Order', 'eltd-core'),
				        'value'      => array_flip(findme_elated_get_query_order_array()),
				        'save_always' => true
			        ),
			        array(
				        'type'        => 'dropdown',
				        'param_name'  => 'item_style',
				        'heading'     => esc_html__( 'Item Style', 'eltd-core' ),
				        'value'       => array(
					        esc_html__( 'Standard - Shader', 'eltd-core' )                 => 'standard-shader',
					        esc_html__( 'Standard - Switch Featured Images', 'eltd-core' ) => 'standard-switch-images',
					        esc_html__( 'Gallery - Overlay', 'eltd-core' )                 => 'gallery-overlay',
					        esc_html__( 'Gallery - Slide From Image Bottom', 'eltd-core' ) => 'gallery-slide-from-image-bottom'
				        ),
				        'save_always' => true,
				        'group'       => esc_html__( 'Content Layout', 'eltd-core' )
			        ),
			        array(
				        'type'       => 'dropdown',
				        'param_name' => 'enable_title',
				        'heading'    => esc_html__( 'Enable Title', 'eltd-core' ),
				        'value'      => array_flip(findme_elated_get_yes_no_select_array(false, true)),
				        'group'      => esc_html__( 'Content Layout', 'eltd-core' )
			        ),
			        array(
				        'type'        => 'dropdown',
				        'param_name'  => 'title_tag',
				        'heading'     => esc_html__( 'Title Tag', 'eltd-core' ),
				        'value'       => array_flip(findme_elated_get_title_tag(true)),
				        'dependency'  => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
				        'group'       => esc_html__( 'Content Layout', 'eltd-core' )
			        ),
			        array(
				        'type'        => 'dropdown',
				        'param_name'  => 'title_text_transform',
				        'heading'     => esc_html__( 'Title Text Transform', 'eltd-core' ),
				        'value'       => array_flip(findme_elated_get_text_transform_array(true)),
				        'dependency'  => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
				        'group'       => esc_html__( 'Content Layout', 'eltd-core' )
			        ),
			        array(
				        'type'       => 'dropdown',
				        'param_name' => 'enable_category',
				        'heading'    => esc_html__( 'Enable Category', 'eltd-core' ),
				        'value'      => array_flip(findme_elated_get_yes_no_select_array(false, true)),
				        'group'      => esc_html__( 'Content Layout', 'eltd-core' )
			        ),
			        array(
				        'type'       => 'dropdown',
				        'param_name' => 'enable_excerpt',
				        'heading'    => esc_html__( 'Enable Excerpt', 'eltd-core' ),
				        'value'      => array_flip(findme_elated_get_yes_no_select_array(false)),
				        'group'      => esc_html__( 'Content Layout', 'eltd-core' )
			        ),
			        array(
				        'type'        => 'textfield',
				        'param_name'  => 'excerpt_length',
				        'heading'     => esc_html__( 'Excerpt Length', 'eltd-core' ),
				        'description' => esc_html__( 'Number of characters', 'eltd-core' ),
				        'dependency'  => array( 'element' => 'enable_excerpt', 'value' => array( 'yes' ) ),
				        'group'       => esc_html__( 'Content Layout', 'eltd-core' )
			        ),
			        array(
				        'type'        => 'dropdown',
				        'param_name'  => 'enable_loop',
				        'heading'     => esc_html__('Enable Slider Loop', 'eltd-core'),
				        'value'       => array_flip(findme_elated_get_yes_no_select_array(false, true)),
				        'save_always' => true,
				        'group'       => esc_html__('Slider Settings', 'eltd-core')
			        ),
			        array(
				        'type'        => 'dropdown',
				        'param_name'  => 'enable_autoplay',
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
				        'param_name'  => 'enable_navigation',
				        'heading'	  => esc_html__('Enable Slider Navigation Arrows', 'eltd-core'),
				        'value'       => array_flip(findme_elated_get_yes_no_select_array(false, true)),
				        'save_always' => true,
				        'group'       => esc_html__('Slider Settings', 'eltd-core')
			        ),
			        array(
				        'type'        => 'dropdown',
				        'param_name'  => 'navigation_skin',
				        'heading'     => esc_html__( 'Navigation Skin', 'eltd-core' ),
				        'value'       => array(
					        esc_html__( 'Default', 'eltd-core' ) => '',
					        esc_html__( 'Light', 'eltd-core' )   => 'light',
					        esc_html__( 'Dark', 'eltd-core' )    => 'dark'
				        ),
				        'dependency'  => array( 'element' => 'enable_navigation', 'value' => array( 'yes' ) ),
				        'group'       => esc_html__( 'Slider Settings', 'eltd-core' )
			        ),
			        array(
				        'type'		  => 'dropdown',
				        'param_name'  => 'enable_pagination',
				        'heading'	  => esc_html__('Enable Slider Pagination', 'eltd-core'),
				        'value'       => array_flip(findme_elated_get_yes_no_select_array(false, true)),
				        'save_always' => true,
				        'group'       => esc_html__('Slider Settings', 'eltd-core')
			        ),
			        array(
				        'type'       => 'dropdown',
				        'param_name' => 'pagination_skin',
				        'heading'    => esc_html__( 'Pagination Skin', 'eltd-core' ),
				        'value'      => array(
					        esc_html__( 'Default', 'eltd-core' ) => '',
					        esc_html__( 'Light', 'eltd-core' )   => 'light',
					        esc_html__( 'Dark', 'eltd-core' )    => 'dark'
				        ),
				        'dependency' => array( 'element' => 'enable_pagination', 'value' => array( 'yes' ) ),
				        'group'      => esc_html__( 'Slider Settings', 'eltd-core' )
			        ),
			        array(
				        'type'        => 'dropdown',
				        'param_name'  => 'pagination_position',
				        'heading'     => esc_html__( 'Pagination Position', 'eltd-core' ),
				        'value'       => array(
					        esc_html__( 'Below Slider', 'eltd-core' ) => 'below-slider',
					        esc_html__( 'On Slider', 'eltd-core' )    => 'on-slider'
				        ),
				        'save_always' => true,
				        'dependency'  => array( 'element' => 'enable_pagination', 'value' => array( 'yes' ) ),
				        'group'       => esc_html__( 'Slider Settings', 'eltd-core' )
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
	        'number_of_items'        => '9',
	        'number_of_columns'      => '4',
	        'space_between_items'    => 'normal',
	        'image_proportions'      => 'full',
	        'category'               => '',
	        'selected_projects'      => '',
	        'tag'                    => '',
	        'order_by'               => 'date',
	        'order'                  => 'ASC',
	        'item_style'             => 'standard-shader',
	        'enable_title'           => 'yes',
	        'title_tag'              => 'h4',
	        'title_text_transform'   => '',
	        'enable_category'        => 'yes',
	        'enable_excerpt'         => 'no',
	        'excerpt_length'         => '20',
	        'enable_loop'		     => 'yes',
	        'enable_autoplay'		 => 'yes',
	        'slider_speed'		     => '5000',
	        'slider_speed_animation' => '600',
	        'enable_navigation'	     => 'yes',
	        'navigation_skin'        => '',
	        'enable_pagination'	     => 'yes',
	        'pagination_skin'        => '',
	        'pagination_position'    => 'below-slider'
        );
		$params = shortcode_atts($args, $atts);
		
        $params['type']                = 'gallery';
	    $params['portfolio_slider_on'] = 'yes';

		$html = '';

	    $html .= '<div class="eltd-portfolio-slider-holder">';
			$html .= findme_elated_execute_shortcode('eltd_portfolio_list', $params);
	    $html .= '</div>';

        return $html;
    }

	/**
	 * Filter portfolio categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['portfolio_category_title'] ) > 0 ) ? esc_html__( 'Category', 'eltd-core' ) . ': ' . $value['portfolio_category_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find portfolio category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$portfolio_category = get_term_by( 'slug', $query, 'portfolio-category' );
			if ( is_object( $portfolio_category ) ) {

				$portfolio_category_slug = $portfolio_category->slug;
				$portfolio_category_title = $portfolio_category->name;

				$portfolio_category_title_display = '';
				if ( ! empty( $portfolio_category_title ) ) {
					$portfolio_category_title_display = esc_html__( 'Category', 'eltd-core' ) . ': ' . $portfolio_category_title;
				}

				$data          = array();
				$data['value'] = $portfolio_category_slug;
				$data['label'] = $portfolio_category_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

	/**
	 * Filter portfolios by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$portfolio_id = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'portfolio-item' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $portfolio_id > 0 ? $portfolio_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'eltd-core' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'eltd-core' ) . ': ' . $value['title'] : '' );
				$results[] = $data;
			}
		}

		return $results;
	}

	/**
	 * Find portfolio by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio
			$portfolio = get_post( (int) $query );
			if ( ! is_wp_error( $portfolio ) ) {

				$portfolio_id = $portfolio->ID;
				$portfolio_title = $portfolio->post_title;

				$portfolio_title_display = '';
				if ( ! empty( $portfolio_title ) ) {
					$portfolio_title_display = ' - ' . esc_html__( 'Title', 'eltd-core' ) . ': ' . $portfolio_title;
				}

				$portfolio_id_display = esc_html__( 'Id', 'eltd-core' ) . ': ' . $portfolio_id;

				$data          = array();
				$data['value'] = $portfolio_id;
				$data['label'] = $portfolio_id_display . $portfolio_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

	/**
	 * Filter portfolio tags
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioTagAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_tag_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-tag' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['portfolio_tag_title'] ) > 0 ) ? esc_html__( 'Tag', 'eltd-core' ) . ': ' . $value['portfolio_tag_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find portfolio tag by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioTagAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$portfolio_tag = get_term_by( 'slug', $query, 'portfolio-tag' );
			if ( is_object( $portfolio_tag ) ) {

				$portfolio_tag_slug = $portfolio_tag->slug;
				$portfolio_tag_title = $portfolio_tag->name;

				$portfolio_tag_title_display = '';
				if ( ! empty( $portfolio_tag_title ) ) {
					$portfolio_tag_title_display = esc_html__( 'Tag', 'eltd-core' ) . ': ' . $portfolio_tag_title;
				}

				$data          = array();
				$data['value'] = $portfolio_tag_slug;
				$data['label'] = $portfolio_tag_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}