<?php
/**
 * Woocommerce helper functions
 */

if(!function_exists('findme_elated_woocommerce_meta_box_functions')) {
	function findme_elated_woocommerce_meta_box_functions($post_types) {
		$post_types[] = 'product';
		
		return $post_types;
	}
	
	add_filter('findme_elated_meta_box_post_types_save', 'findme_elated_woocommerce_meta_box_functions');
}

if(!function_exists('findme_elated_get_woo_shortcode_module_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $module name of the module folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 * @see findme_elated_get_template_part()
	 */
	function findme_elated_get_woo_shortcode_module_template_part($template, $module, $slug = '', $params = array()) {
		
		//HTML Content from template
		$html          = '';
		$template_path = 'framework/modules/woocommerce/shortcodes/'.$module;
		
		$temp = $template_path.'/'.$template;
		
		if(is_array($params) && count($params)) {
			extract($params);
		}
		
		$templates = array();
		
		if($temp !== '') {
			if($slug !== '') {
				$templates[] = "{$temp}-{$slug}.php";
			}
			
			$templates[] = $temp.'.php';
		}
		$located = findme_elated_find_template_path($templates);
		if($located) {
			ob_start();
			include($located);
			$html = ob_get_clean();
		}
		
		return $html;
	}
}

if(!function_exists('findme_elated_disable_woocommerce_pretty_photo')) {
    /**
     * Function that disable WooCommerce pretty photo script and style
     */
    function findme_elated_disable_woocommerce_pretty_photo() {
        //is woocommerce installed?
        if(findme_elated_is_woocommerce_installed()) {
            if(findme_elated_load_woo_assets()) {

                wp_deregister_style('woocommerce_prettyPhoto_css');
            }
        }
    }

    add_action('wp_enqueue_scripts', 'findme_elated_disable_woocommerce_pretty_photo');
}

if (!function_exists('findme_elated_woocommerce_body_class')) {
	/**
	 * Function that adds class on body for Woocommerce
	 *
	 * @param $classes
	 * @return array
	 */
	function findme_elated_woocommerce_body_class( $classes ) {
		if(findme_elated_is_woocommerce_page()) {
			$classes[] = 'eltd-woocommerce-page';

			if(function_exists('is_shop') && is_shop()) {
				$classes[] = 'eltd-woo-main-page';
			}

			if (is_singular('product')) {
				$classes[] = 'eltd-woo-single-page';
			}
		}
		
		return $classes;
	}

	add_filter('body_class', 'findme_elated_woocommerce_body_class');
}

if(!function_exists('findme_elated_woocommerce_columns_class')) {
	/**
	 * Function that adds number of columns class to header tag
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added woocommerce class
	 */
	function findme_elated_woocommerce_columns_class($classes) {
		if(findme_elated_is_woocommerce_installed()) {
			$products_list_number = findme_elated_options()->getOptionValue('eltd_woo_product_list_columns');
			
			$classes[] = $products_list_number;
		}

		return $classes;
	}

	add_filter('body_class', 'findme_elated_woocommerce_columns_class');
}

if(!function_exists('findme_elated_woocommerce_columns_space_class')) {
	/**
	 * Function that adds space between columns class to header tag
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added woocommerce class
	 */
	function findme_elated_woocommerce_columns_space_class($classes) {
		if(findme_elated_is_woocommerce_installed()) {
			$columns_space = findme_elated_options()->getOptionValue('eltd_woo_product_list_columns_space');
			
			$classes[] = $columns_space;
		}
		
		return $classes;
	}
	
	add_filter('body_class', 'findme_elated_woocommerce_columns_space_class');
}

if(!function_exists('findme_elated_woocommerce_pl_info_position_class')) {
	/**
	 * Function that adds product list info position class to header tag
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added woocommerce class
	 */
	function findme_elated_woocommerce_pl_info_position_class($classes) {
		if(findme_elated_is_woocommerce_installed()) {
			$info_position = findme_elated_options()->getOptionValue('eltd_woo_product_list_info_position');
			$info_position_class = '';
			if($info_position === 'info_below_image') {
				$info_position_class = 'eltd-woo-pl-info-below-image';
			} else if ($info_position === 'info_on_image_hover') {
				$info_position_class = 'eltd-woo-pl-info-on-image-hover';
			}
			
			$classes[] = $info_position_class;
		}
		
		return $classes;
	}
	
	add_filter('body_class', 'findme_elated_woocommerce_pl_info_position_class');
}

if(!function_exists('findme_elated_is_woocommerce_page')) {
	/**
	 * Function that checks if current page is woocommerce shop, product or product taxonomy
	 * @return bool
	 *
	 * @see is_woocommerce()
	 */
	function findme_elated_is_woocommerce_page() {
		if (function_exists('is_woocommerce') && is_woocommerce()) {
			return is_woocommerce();
		} elseif (function_exists('is_cart') && is_cart()) {
			return is_cart();
		} elseif (function_exists('is_checkout') && is_checkout()) {
			return is_checkout();
		} elseif (function_exists('is_account_page') && is_account_page()) {
			return is_account_page();
		}
	}
}

if(!function_exists('findme_elated_is_woocommerce_shop')) {
	/**
	 * Function that checks if current page is shop or product page
	 * @return bool
	 *
	 * @see is_shop()
	 */
	function findme_elated_is_woocommerce_shop() {
		return function_exists('is_shop') && (is_shop() || is_product());
	}
}

if(!function_exists('findme_elated_get_woo_shop_page_id')) {
	/**
	 * Function that returns shop page id that is set in WooCommerce settings page
	 * @return int id of shop page
	 */
	function findme_elated_get_woo_shop_page_id() {
		if(findme_elated_is_woocommerce_installed()) {
			//get shop page id from options table
			$shop_id = get_option('woocommerce_shop_page_id');
			
			if (!empty($shop_id)) {
				$page_id = $shop_id;
			} else {
				$page_id = '-1';
			}
			
			return $page_id;
		}
	}
}

if(!function_exists('findme_elated_is_product_category')) {
	function findme_elated_is_product_category() {
		return function_exists('is_product_category') && is_product_category();
	}
}

if(!function_exists('findme_elated_is_product_tag')) {
	function findme_elated_is_product_tag() {
		return function_exists('is_product_tag') && is_product_tag();
	}
}

if(!function_exists('findme_elated_load_woo_assets')) {
	/**
	 * Function that checks whether WooCommerce assets needs to be loaded.
	 *
	 * @see findme_elated_is_woocommerce_page()
	 * @see findme_elated_has_woocommerce_shortcode()
	 * @see findme_elated_has_woocommerce_widgets()
	 * @return bool
	 */

	function findme_elated_load_woo_assets() {
		return findme_elated_is_woocommerce_installed() && (findme_elated_is_woocommerce_page() || findme_elated_has_woocommerce_shortcode() || findme_elated_has_woocommerce_widgets());
	}
}

if(!function_exists('findme_elated_return_woocommerce_global_variable')) {
	function findme_elated_return_woocommerce_global_variable() {
		if(findme_elated_is_woocommerce_installed()) {
			global $product;

			return $product;
		}
	}
}

if(!function_exists('findme_elated_has_woocommerce_shortcode')) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return bool
	 */
	function findme_elated_has_woocommerce_shortcode() {
		$woocommerce_shortcodes = array(
			'eltd_product_info',
			'eltd_product_list',
			'eltd_product_list_carousel',
			'eltd_product_list_simple',
			'add_to_cart',
			'add_to_cart_url',
			'product_page',
			'product',
			'products',
			'product_categories',
			'product_category',
			'recent_products',
			'featured_products',
			'sale_products',
			'best_selling_products',
			'top_rated_products',
			'product_attribute',
			'related_products',
			'woocommerce_messages',
			'woocommerce_cart',
			'woocommerce_checkout',
			'woocommerce_order_tracking',
			'woocommerce_my_account',
			'woocommerce_edit_address',
			'woocommerce_change_password',
			'woocommerce_view_order',
			'woocommerce_pay',
			'woocommerce_thankyou'
		);

		foreach($woocommerce_shortcodes as $woocommerce_shortcode) {
			$has_shortcode = findme_elated_has_shortcode($woocommerce_shortcode);

			if($has_shortcode) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('findme_elated_has_woocommerce_widgets')) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return bool
	 */
	function findme_elated_has_woocommerce_widgets() {
		$widgets_array = array(
			'eltd_woocommerce_dropdown_cart',
			'woocommerce_widget_cart',
			'woocommerce_layered_nav',
			'woocommerce_layered_nav_filters',
			'woocommerce_price_filter',
			'woocommerce_product_categories',
			'woocommerce_product_search',
			'woocommerce_product_tag_cloud',
			'woocommerce_products',
			'woocommerce_recent_reviews',
			'woocommerce_recently_viewed_products',
			'woocommerce_top_rated_products'
		);

		foreach($widgets_array as $widget) {
			$active_widget = is_active_widget(false, false, $widget);

			if($active_widget) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('findme_elated_register_woocommerce_widget_area')){


	function findme_elated_register_woocommerce_widget_area(){


		register_sidebar(
			array(
				'name'          => esc_html__('Woo Single Widget Area', 'findme'),
				'id'            => 'eltd-woo-single-widget-area',
				'before_widget' => '<div id="%1$s" class="widget %2$s eltd-woo-single-widget-area">',
				'after_widget'  => '</div>',
				'description'   => esc_html__('Widgets added here will appear on the bottom of shop single pages', 'findme')
			)
		);

	}

	add_action('widgets_init', 'findme_elated_register_woocommerce_widget_area');

}

if(!function_exists('findme_elated_add_woocommerce_shortcode_class')) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return string
	 */
	function findme_elated_add_woocommerce_shortcode_class($classes){
		$woocommerce_shortcodes = array(
			'woocommerce_order_tracking'
		);

		foreach($woocommerce_shortcodes as $woocommerce_shortcode) {
			$has_shortcode = findme_elated_has_shortcode($woocommerce_shortcode);

			if($has_shortcode) {
				$classes[] = 'eltd-woocommerce-page woocommerce-account eltd-'.str_replace('_', '-', $woocommerce_shortcode);
			}
		}

		return $classes;
	}

	add_filter('body_class', 'findme_elated_add_woocommerce_shortcode_class');
}

if(!function_exists('findme_elated_woocommerce_product_single_class')) {
	function findme_elated_woocommerce_product_single_class($classes) {
		if(in_array('woocommerce', $classes)) {
			$product_thumbnail_position = findme_elated_get_meta_field_intersect('woo_set_thumb_images_position');
			
			if(!empty($product_thumbnail_position)) {
				$classes[] = 'eltd-woo-single-thumb-'.$product_thumbnail_position;
			}
		}
		
		return $classes;
	}
	
	add_filter('body_class', 'findme_elated_woocommerce_product_single_class');
}

if(!function_exists('findme_elated_woocommerce_share')) {
    /**
     * Function that social share for product page
     * Return array array of WooCommerce pages
     */
    function findme_elated_woocommerce_share() {
        if (findme_elated_is_woocommerce_installed()) {

            if ( findme_elated_core_plugin_installed() && findme_elated_options()->getOptionValue('enable_social_share') == 'yes' && findme_elated_options()->getOptionValue('enable_social_share_on_product') == 'yes') :
                print '<div class="eltd-woo-social-share-holder">';
                print '<span>'.esc_html__('Share:', 'findme').'</span>';
                echo findme_elated_get_social_share_html();
                print '</div>';
            endif;
        }
    }
}