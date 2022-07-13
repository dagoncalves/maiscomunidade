<?php
use ElatedListing\Lib\Core;
if(!function_exists('eltd_listing_single_listing')){

	/**
	 * Function load single listing template
	 */

	function eltd_listing_single_listing(){
		$listing_template = 'standard'; //currently there is only one single listing type

		$params = array(
			'listing_template' => $listing_template,
			'holder_class'       => array(
				'eltd-'.$listing_template,
				'eltd-listing-single-holder'
			)
		);

		//update listing view count
//		$view_obj = new Core\ListingViews(get_the_ID());
//		$view_obj->setCountValue();
		eltd_listing_single_template_part('holder', '', $params);
	}

}

if(!function_exists('eltd_listing_related_taxonomy_settings')){
	/**
	 * Function generate taxonomy array which will be used to generate related posts
	 * For each taxonomy need to be set priority in order to choose from which taxonomy will be taken post
	 * return array
	 */
	function eltd_listing_related_taxonomy_settings(){

		$tax_array = array(
			array(
				'id' => 'job_listing_type',
				'priority' => 2
			),
			array(
				'id' => 'job_listing_category',
				'priority' => 1
			),
			array(
				'id' => 'job_listing_tag',
				'priority' => 3
			)
		);

		return $tax_array;

	}

}


if(!function_exists('eltd_listing_single_bookmark_trigger')){

	/**
	 * Function to add wishlist(bookmark) button to listing single pages
	 */
	function eltd_listing_single_bookmark_trigger(){

		if(eltd_listing_bookmark_plugin_installed()){

			do_action('single_job_listing_meta_after');

		}

	}

	add_action('eltd_listing_action_add_bookmark_button' , 'eltd_listing_single_bookmark_trigger');
}