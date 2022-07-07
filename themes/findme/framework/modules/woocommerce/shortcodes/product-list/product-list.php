<?php
namespace ElatedCore\CPT\Shortcodes\ProductList;

use ElatedCore\Lib;

class ProductList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltd_product_list';
		
		add_action('vc_before_init', array($this,'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Elated Product List', 'findme' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-product-list extended-custom-icon',
					'category'                  => esc_html__( 'by ELATED', 'findme' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'findme' ),
							'value'       => array(
								esc_html__( 'Standard', 'findme' ) => 'standard',
								esc_html__( 'Masonry', 'findme' )  => 'masonry'
							),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'info_position',
							'heading'     => esc_html__( 'Product Info Position', 'findme' ),
							'value'       => array(
								esc_html__( 'Info On Image Hover', 'findme' ) => 'info-on-image',
								esc_html__( 'Info Below Image', 'findme' )    => 'info-below-image'
							),
							'admin_label' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'number_of_posts',
							'heading'    => esc_html__( 'Number of Products', 'findme' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'findme' ),
							'value'       => array(
								esc_html__( 'One', 'findme' )   => '1',
								esc_html__( 'Two', 'findme' )   => '2',
								esc_html__( 'Three', 'findme' ) => '3',
								esc_html__( 'Four', 'findme' )  => '4',
								esc_html__( 'Five', 'findme' )  => '5',
								esc_html__( 'Six', 'findme' )   => '6'
							),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'space_between_items',
							'heading'    => esc_html__( 'Space Between Items', 'findme' ),
							'value'      => array(
								esc_html__( 'Normal', 'findme' )   => 'normal',
								esc_html__( 'Small', 'findme' )    => 'small',
								esc_html__( 'Tiny', 'findme' )     => 'tiny',
								esc_html__( 'No Space', 'findme' ) => 'no'
							)
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order_by',
							'heading'     => esc_html__( 'Order By', 'findme' ),
							'value'       => array_flip( findme_elated_get_query_order_by_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'findme' ),
							'value'       => array_flip( findme_elated_get_query_order_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'taxonomy_to_display',
							'heading'     => esc_html__( 'Choose Sorting Taxonomy', 'findme' ),
							'value'       => array(
								esc_html__( 'Category', 'findme' ) => 'category',
								esc_html__( 'Tag', 'findme' )      => 'tag',
								esc_html__( 'Id', 'findme' )       => 'id'
							),
							'description' => esc_html__( 'If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display', 'findme' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'taxonomy_values',
							'heading'     => esc_html__( 'Enter Taxonomy Values', 'findme' ),
							'description' => esc_html__( 'Separate values (category slugs, tags, or post IDs) with a comma', 'findme' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'image_size',
							'heading'    => esc_html__( 'Image Proportions', 'findme' ),
							'value'      => array(
								esc_html__( 'Default', 'findme' )        => '',
								esc_html__( 'Original', 'findme' )       => 'full',
								esc_html__( 'Square', 'findme' )         => 'square',
								esc_html__( 'Landscape', 'findme' )      => 'landscape',
								esc_html__( 'Portrait', 'findme' )       => 'portrait',
								esc_html__( 'Medium', 'findme' )         => 'medium',
								esc_html__( 'Large', 'findme' )          => 'large',
								esc_html__( 'Shop Catalog', 'findme' )   => 'shop_catalog',
								esc_html__( 'Shop Single', 'findme' )    => 'shop_single',
								esc_html__( 'Shop Thumbnail', 'findme' ) => 'shop_thumbnail'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_title',
							'heading'    => esc_html__( 'Display Title', 'findme' ),
							'value'      => array_flip( findme_elated_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'findme' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'product_info_skin',
							'heading'    => esc_html__( 'Product Info Skin', 'findme' ),
							'value'      => array(
								esc_html__( 'Default', 'findme' ) => 'default',
								esc_html__( 'Light', 'findme' )   => 'light',
								esc_html__( 'Dark', 'findme' )    => 'dark'
							),
							'dependency' => array( 'element' => 'info_position', 'value' => array( 'info-on-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'findme' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_tag',
							'heading'    => esc_html__( 'Title Tag', 'findme' ),
							'value'      => array_flip( findme_elated_get_title_tag( true ) ),
							'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Product Info Style', 'findme' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_transform',
							'heading'    => esc_html__( 'Title Text Transform', 'findme' ),
							'value'      => array_flip( findme_elated_get_text_transform_array( true ) ),
							'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Product Info Style', 'findme' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_category',
							'heading'    => esc_html__( 'Display Category', 'findme' ),
							'value'      => array_flip( findme_elated_get_yes_no_select_array( false ) ),
							'group'      => esc_html__( 'Product Info', 'findme' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_excerpt',
							'heading'    => esc_html__( 'Display Excerpt', 'findme' ),
							'value'      => array_flip( findme_elated_get_yes_no_select_array( false ) ),
							'group'      => esc_html__( 'Product Info', 'findme' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'excerpt_length',
							'heading'     => esc_html__( 'Excerpt Length', 'findme' ),
							'description' => esc_html__( 'Number of characters', 'findme' ),
							'dependency'  => array( 'element' => 'display_excerpt', 'value' => array( 'yes' ) ),
							'group'       => esc_html__( 'Product Info Style', 'findme' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_rating',
							'heading'    => esc_html__( 'Display Rating', 'findme' ),
							'value'      => array_flip( findme_elated_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'findme' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_price',
							'heading'    => esc_html__( 'Display Price', 'findme' ),
							'value'      => array_flip( findme_elated_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'findme' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_button',
							'heading'    => esc_html__( 'Display Button', 'findme' ),
							'value'      => array_flip( findme_elated_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'findme' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'button_skin',
							'heading'    => esc_html__( 'Button Skin', 'findme' ),
							'value'      => array(
								esc_html__( 'Default', 'findme' ) => 'default',
								esc_html__( 'Light', 'findme' )   => 'light',
								esc_html__( 'Dark', 'findme' )    => 'dark'
							),
							'dependency' => array( 'element' => 'display_button', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Product Info Style', 'findme' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'shader_background_color',
							'heading'    => esc_html__( 'Shader Background Color', 'findme' ),
							'group'      => esc_html__( 'Product Info Style', 'findme' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'info_bottom_text_align',
							'heading'    => esc_html__( 'Product Info Text Alignment', 'findme' ),
							'value'      => array(
								esc_html__( 'Default', 'findme' ) => '',
								esc_html__( 'Left', 'findme' )    => 'left',
								esc_html__( 'Center', 'findme' )  => 'center',
								esc_html__( 'Right', 'findme' )   => 'right'
							),
							'dependency' => array( 'element' => 'info_position', 'value' => array( 'info-below-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'findme' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'info_bottom_margin',
							'heading'    => esc_html__( 'Product Info Bottom Margin (px)', 'findme' ),
							'dependency' => array( 'element' => 'info_position', 'value' => array( 'info-below-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'findme' )
						)
					)
				)
			);
		}
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'type'					  => 'standard',
			'info_position'			  => 'info-on-image',
            'number_of_posts' 		  => '8',
            'number_of_columns' 	  => '4',
            'space_between_items'	  => 'normal',
            'order_by' 				  => 'date',
            'order' 				  => 'ASC',
            'taxonomy_to_display' 	  => 'category',
            'taxonomy_values' 		  => '',
            'image_size'			  => 'full',
            'display_title' 		  => 'yes',
			'product_info_skin'       => '',
            'title_tag'				  => 'h5',
            'title_transform'		  => '',
			'display_category'        => 'no',
            'display_excerpt' 		  => 'no',
            'excerpt_length' 		  => '20',
			'display_rating' 		  => 'yes',
			'display_price' 		  => 'yes',
            'display_button' 		  => 'yes',
			'button_skin'             => 'default',
			'shader_background_color' => '',
			'info_bottom_text_align'  => '',
            'info_bottom_margin' 	  => ''
        );
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);
		
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['class_name'] = 'pli';
		
		$params['type'] = !empty($params['type']) ? $params['type'] : $default_atts['type'];
		
		$params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['title_styles'] = $this->getTitleStyles($params);
		
		$params['shader_styles'] = $this->getShaderStyles($params);

		$params['text_wrapper_styles'] = $this->getTextWrapperStyles($params);

		$queryArray = $this->generateProductQueryArray($params);
		$query_result = new \WP_Query($queryArray);
		$params['query_result'] = $query_result;

		$html = findme_elated_get_woo_shortcode_module_template_part('templates/product-list-'.$params['type'], 'product-list', '', $params);
		
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

		$productListType = !empty($params['type']) ? 'eltd-'.$params['type'].'-layout' : 'eltd-standard-layout';

        $columnsSpace = !empty($params['space_between_items']) ? 'eltd-'.$params['space_between_items'].'-space' : 'eltd-normal-space';

        $columnNumber = $this->getColumnNumberClass($params);

		$infoPosition = !empty($params['info_position']) ? 'eltd-'.$params['info_position'] : 'eltd-info-on-image';
		
		$productInfoClasses = !empty($params['product_info_skin']) ? 'eltd-product-info-'.$params['product_info_skin'] : '';

        $holderClasses .= $productListType . ' ' . $columnsSpace . ' ' . $columnNumber . ' ' . $infoPosition . ' ' . $productInfoClasses;
		
		return $holderClasses;
	}

    /**
     * Generates columns number classes for product list holder
     *
     * @param $params
     *
     * @return string
     */
    private function getColumnNumberClass($params){
        $columnsNumber = '';
        $columns = $params['number_of_columns'];

        switch ($columns) {
            case 1:
                $columnsNumber = 'eltd-one-column';
                break;
            case 2:
                $columnsNumber = 'eltd-two-columns';
                break;
            case 3:
                $columnsNumber = 'eltd-three-columns';
                break;
            case 4:
                $columnsNumber = 'eltd-four-columns';
                break;
            case 5:
                $columnsNumber = 'eltd-five-columns';
                break;
            case 6:
                $columnsNumber = 'eltd-six-columns';
                break;        
            default:
                $columnsNumber = 'eltd-four-columns';
                break;
        }

        return $columnsNumber;
    }

	/**
	   * Generates query array
	   *
	   * @param $params
	   *
	   * @return array
	*/
	public function generateProductQueryArray($params){
		$queryArray = array(
			'post_status' => 'publish',
			'post_type' => 'product',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $params['number_of_posts'],
			'orderby' => $params['order_by'],
			'order' => $params['order']
		);

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'category') {
            $queryArray['product_cat'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'tag') {
            $queryArray['product_tag'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'id') {
            $idArray = $params['taxonomy_values'];
            $ids = explode(',', $idArray);
            $queryArray['post__in'] = $ids;
        }

        return $queryArray;
	}

	/**
     * Return Style for Title
     *
     * @param $params
     * @return string
     */
    public function getTitleStyles($params) {
        $styles = array();
	
	    if (!empty($params['title_transform'])) {
		    $styles[] = 'text-transform: '.$params['title_transform'];
	    }

		return implode(';', $styles);
    }

    /**
     * Return Style for Shader
     *
     * @param $params
     * @return string
     */
	public function getShaderStyles($params) {
	    $styles = array();
	
	    if (!empty($params['shader_background_color'])) {
		    $styles[] = 'background-color: '.$params['shader_background_color'];
	    }

		return implode(';', $styles);
    }

    /**
     * Return Style for Text Wrapper Holder
     *
     * @param $params
     * @return string
     */
	public function getTextWrapperStyles($params) {
	    $styles = array();
	
	    if (!empty($params['info_bottom_text_align'])) {
		    $styles[] = 'text-align: '.$params['info_bottom_text_align'];
	    }
		
        if ($params['info_bottom_margin'] !== '') {
	        $styles[] = 'margin-bottom: '.findme_elated_filter_px($params['info_bottom_margin']).'px';
        }

		return implode(';', $styles);
    }
}