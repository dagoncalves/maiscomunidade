<?php

if (!function_exists('findme_elated_woocommerce_products_per_page')) {
	/**
	 * Function that sets number of products per page. Default is 9
	 * @return int number of products to be shown per page
	 */
	function findme_elated_woocommerce_products_per_page() {

		$products_per_page = 12;

		if (findme_elated_options()->getOptionValue('eltd_woo_products_per_page')) {
			$products_per_page = findme_elated_options()->getOptionValue('eltd_woo_products_per_page');
		}
		if(isset($_GET['woo-products-count']) && $_GET['woo-products-count'] === 'view-all') {
			$products_per_page = 9999;
		}

		return $products_per_page;
	}
}

if (!function_exists('findme_elated_woocommerce_thumbnails_per_row')) {
	/**
	 * Function that sets number of thumbnails on single product page per row. Default is 4
	 * @return int number of thumbnails to be shown on single product page per row
	 */
	function findme_elated_woocommerce_thumbnails_per_row() {

		return 4;
	}
}

if (!function_exists('findme_elated_woocommerce_related_products_args')) {
	/**
	 * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
	 * @param $args array array of args for the query
	 * @return mixed array of changed args
	 */
	function findme_elated_woocommerce_related_products_args($args) {
		$related = findme_elated_options()->getOptionValue('eltd_woo_product_list_columns');
		
		if (!empty($related)) {
			switch ($related) {
				case 'eltd-woocommerce-columns-4':
					$args['posts_per_page'] = 4;
					break;
				case 'eltd-woocommerce-columns-3':
					$args['posts_per_page'] = 3;
					break;
				default:
					$args['posts_per_page'] = 3;
			}
		} else {
			$args['posts_per_page'] = 3;
		}

		return $args;
	}
}

if (!function_exists('findme_elated_woocommerce_template_loop_product_title')) {
	/**
	 * Function for overriding product title template in Product List Loop
	 */
	function findme_elated_woocommerce_template_loop_product_title() {

		$tag = findme_elated_options()->getOptionValue('eltd_products_list_title_tag');
		if($tag === '') {
			$tag = 'h5';
		}
		the_title('<' . $tag . ' class="eltd-product-list-title"><a href="'.get_the_permalink().'">', '</a></' . $tag . '>');
	}
}

if (!function_exists('findme_elated_woocommerce_template_single_title')) {
	/**
	 * Function for overriding product title template in Single Product template
	 */
	function findme_elated_woocommerce_template_single_title() {

		$tag = findme_elated_options()->getOptionValue('eltd_single_product_title_tag');
		if($tag === '') {
			$tag = 'h1';
		}
		the_title('<' . $tag . '  itemprop="name" class="eltd-single-product-title">', '</' . $tag . '>');
	}
}

if (!function_exists('findme_elated_woocommerce_sale_flash')) {
	/**
	 * Function for overriding Sale Flash Template
	 *
	 * @return string
	 */
	function findme_elated_woocommerce_sale_flash() {

		return '<span class="eltd-onsale">' . esc_html__('Sale', 'findme') . '</span>';
	}
}

if (!function_exists('findme_elated_woocommerce_product_out_of_stock')) {
	/**
	 * Function for adding Out Of Stock Template
	 *
	 * @return string
	 */
	function findme_elated_woocommerce_product_out_of_stock() {

		global $product;

		if (!$product->is_in_stock()) {
			print '<span class="eltd-out-of-stock">' . esc_html__('Out Of Stock', 'findme') . '</span>';
		}
	}
}

if (!function_exists('findme_elated_woo_view_all_pagination_additional_tag_before')) {
	function findme_elated_woo_view_all_pagination_additional_tag_before() {

		print '<div class="eltd-woo-pagination-holder"><div class="eltd-woo-pagination-inner">';
	}
}

if (!function_exists('findme_elated_woo_view_all_pagination_additional_tag_after')) {
	function findme_elated_woo_view_all_pagination_additional_tag_after() {

		print '</div></div>';
	}
}

if (!function_exists('findme_elated_woocommerce_product_thumbnail_column_size')) {
	function findme_elated_woocommerce_product_thumbnail_column_size() {
		
		return 4;
	}
}

if (!function_exists('findme_elated_single_product_content_additional_tag_before')) {
	function findme_elated_single_product_content_additional_tag_before() {

		print '<div class="eltd-single-product-content eltd-grid">';
	}
}

if (!function_exists('findme_elated_single_product_content_additional_tag_after')) {
	function findme_elated_single_product_content_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('findme_elated_single_product_summary_additional_tag_before')) {
	function findme_elated_single_product_summary_additional_tag_before() {

		print '<div class="eltd-single-product-summary">';
	}
}

if (!function_exists('findme_elated_single_product_summary_additional_tag_after')) {
	function findme_elated_single_product_summary_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('findme_elated_pl_holder_additional_tag_before')) {
	function findme_elated_pl_holder_additional_tag_before() {

		print '<div class="eltd-pl-main-holder">';
	}
}

if (!function_exists('findme_elated_pl_holder_additional_tag_after')) {
	function findme_elated_pl_holder_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('findme_elated_pl_inner_additional_tag_before')) {
	function findme_elated_pl_inner_additional_tag_before() {

		print '<div class="eltd-pl-inner">';
	}
}

if (!function_exists('findme_elated_pl_inner_additional_tag_after')) {
	function findme_elated_pl_inner_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('findme_elated_pl_image_additional_tag_before')) {
	function findme_elated_pl_image_additional_tag_before() {

		print '<div class="eltd-pl-image">';
	}
}

if (!function_exists('findme_elated_pl_image_additional_tag_after')) {
	function findme_elated_pl_image_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('findme_elated_pl_inner_text_additional_tag_before')) {
	function findme_elated_pl_inner_text_additional_tag_before() {

		print '<div class="eltd-pl-text"><div class="eltd-pl-text-outer"><div class="eltd-pl-text-inner">';
	}
}

if (!function_exists('findme_elated_pl_inner_text_additional_tag_after')) {
	function findme_elated_pl_inner_text_additional_tag_after() {

		print '</div></div></div>';
	}
}

if (!function_exists('findme_elated_pl_text_wrapper_additional_tag_before')) {
	function findme_elated_pl_text_wrapper_additional_tag_before() {

		print '<div class="eltd-pl-text-wrapper">';
	}
}

if (!function_exists('findme_elated_pl_text_wrapper_additional_tag_after')) {
	function findme_elated_pl_text_wrapper_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('findme_elated_pl_rating_additional_tag_before')) {
	function findme_elated_pl_rating_additional_tag_before() {
		global $product;

		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {

			$rating_html = wc_get_rating_html( $product->get_average_rating() );

			if($rating_html !== '') {
				print '<div class="eltd-pl-rating-holder">';
			}
		}
	}
}

if (!function_exists('findme_elated_pl_rating_additional_tag_after')) {
	function findme_elated_pl_rating_additional_tag_after() {
		global $product;

		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {

			$rating_html = wc_get_rating_html( $product->get_average_rating() );

			if($rating_html !== '') {
				print '</div>';
			}
		}
	}
}

if(!function_exists('findme_elated_woocommerce_show_product_categories')){

	function findme_elated_woocommerce_show_product_categories(){
		global $product;
		$html = '<span class="in_category">';
		$html .= wc_get_product_category_list( $product->get_id(), ', ' );
		$html .= '</span>';
		echo wp_kses_post($html);
	}

}

if(!function_exists('findme_elated_data_tabs_tag_before')){
    
    function findme_elated_data_tabs_tag_before(){
        print '</div><div class="eltd-tabs-holder"><div class="eltd-grid">';
    }
}

if(!function_exists('findme_elated_data_tabs_tag_after')){
    
    function findme_elated_data_tabs_tag_after(){
        print '</div></div>';
    }
}

if(!function_exists('findme_elated_single_related_product_additional_tag_before')){
    
    function findme_elated_single_related_product_additional_tag_before(){
        print '<div class="eltd-related-projects-holder"><div class="eltd-grid">';
    }
}

if(!function_exists('findme_elated_single_related_product_additional_tag_after')){
    
    function findme_elated_single_related_product_additional_tag_after(){
        print '</div></div>';
    }
}

if(!function_exists('findme_elated_get_woo_single_widget_area')){

	function findme_elated_get_woo_single_widget_area(){

		if(is_active_sidebar('eltd-woo-single-widget-area')){ ?>
			<div class="eltd-single-product-widget-area">
				<div class="eltd-grid">
					<?php dynamic_sidebar('eltd-woo-single-widget-area'); ?>
				</div>
			
		<?php }

	}

}

if ( ! function_exists( 'findme_elated_woocommerce_single_add_pretty_photo_for_images' ) ) {
	/**
	 * Function that add necessary html attributes for prettyPhoto
	 */
	function findme_elated_woocommerce_single_add_pretty_photo_for_images( $html, $attachment_id ) {
		$our_html = '';

		if(!empty($html)) {
			$full_size_image  = wp_get_attachment_image_src( $attachment_id, 'full' );

			$attributes = array(
				'data-src'                => $full_size_image[0],
				'data-large_image'        => $full_size_image[0],
				'data-large_image_width'  => $full_size_image[1],
				'data-large_image_height' => $full_size_image[2],
			);

			$our_html  .= '<div class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" data-rel="prettyPhoto[woo_single_pretty_photo]">';
			$our_html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
			$our_html .= '</a></div>';

			$html = $our_html;
		}

		return $html;
	}

	add_filter( 'woocommerce_single_product_image_thumbnail_html', 'findme_elated_woocommerce_single_add_pretty_photo_for_images', 10, 2 );
}