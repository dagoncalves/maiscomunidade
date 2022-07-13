<?php

if(!function_exists('eltd_listing_set_listing_dashboard_navigation_pages')){

	/**
	 * Create listing dashboard navigation items
	 *
	 * @param array items - dashboard navigation items
	 * @param string dashboard_url - dashboard page url
	 *
	 * @return array
	 * see eltd_membership_dashboard_navigation_pages in eltd-membership plugin
	 */

	function eltd_listing_set_listing_dashboard_navigation_pages( $items, $dashboard_url){

		$items['add-new-listing'] = array(
			'url'  => esc_url( add_query_arg( array( 'user-action' => 'add-new-listing' ), $dashboard_url ) ),
			'text' => esc_html__( 'Add Listing', 'eltd-listing' ),
            'icon' => findme_elated_icon_collections()->renderIcon('lnr-file-add', 'linear_icons')
		);

		$items['my-listings'] = array(
			'url'  => esc_url( add_query_arg( array( 'user-action' => 'my-listings' ), $dashboard_url ) ),
			'text' => esc_html__( 'My Listings', 'eltd-listing' ),
            'icon' => findme_elated_icon_collections()->renderIcon('lnr-text-align-left', 'linear_icons')
		);
		if(eltd_listing_is_wc_paid_listings_installed()){
			$items['my-packages'] = array(
				'url'  => esc_url( add_query_arg( array( 'user-action' => 'my-packages' ), $dashboard_url ) ),
				'text' => esc_html__( 'My Packages', 'eltd-listing' ),
                'icon' => findme_elated_icon_collections()->renderIcon('lnr-briefcase', 'linear_icons')
			);
		}

		return $items;
	}

	add_filter('eltd_membership_dashboard_navigation_pages' , 'eltd_listing_set_listing_dashboard_navigation_pages', 10 , 2);
}

if(!function_exists('eltd_listing_get_listing_dashboard_pages')){

	/**
	 * Create listing dashboard pages
	 *
	 * @param array $pages - dashboard navigation pages
	 *
	 * @return array
	 * see eltd_membership_dashboard_pages in eltd-membership plugin
	 */


	function eltd_listing_get_listing_dashboard_pages($pages){

		$pages['add-new-listing'] = eltd_listing_get_listing_module_template_part('dashboard', 'add-new-listing');
		$pages['my-listings'] = eltd_listing_get_listing_module_template_part('dashboard', 'my-listings');
		if(eltd_listing_is_wc_paid_listings_installed()){
			$pages['my-packages'] = eltd_listing_get_listing_module_template_part('dashboard', 'my-packages');
		}
		return $pages;
	}
	add_filter('eltd_membership_dashboard_pages', 'eltd_listing_get_listing_dashboard_pages', 10, 1);

}


if(!function_exists('eltd_listing_set_user_dashboard_template_params')){
	/**
	 * Set post content for user dashboard pages
	 *
	 * User Dashboard Template need to have [job_dashboard] as post content in order to user wp_job_manager actions(Edit, Mark Filled, Duplicate, Delete)
	 *
	 * see shortcode_action_handler in wp_job_manager plugin
	 */
	function eltd_listing_set_user_dashboard_template_params(){

		$page_args = array(
			'post_type' => 'page',
			'post_status' => 'publish',
			'meta_key' => '_wp_page_template',
			'meta_value' => 'user-dashboard.php'
		);
		$user_dashboard_page = get_pages($page_args);

		if(is_array($user_dashboard_page) && count($user_dashboard_page)){
			foreach($user_dashboard_page as $page) {
				$current_page['ID'] = $page->ID;
				$current_page['post_content'] = '[job_dashboard]';
				wp_update_post( $current_page );
			}
		}

	}
	//add_action('init', 'eltd_listing_set_user_dashboard_template_params');
}