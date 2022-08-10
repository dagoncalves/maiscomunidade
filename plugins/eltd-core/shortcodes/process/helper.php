<?php
use ElatedCore\CPT\Shortcodes\ProcessHolder;
use ElatedCore\CPT\Shortcodes\Process;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Eltd_Process_Holder extends WPBakeryShortCodesContainer {}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Eltd_Process extends WPBakeryShortCode {}
}

if(!function_exists('eltd_core_process_holder_class_instance')){

	function eltd_core_process_holder_class_instance(){
		return ProcessHolder\ProcessHolder::getInstance();
	}

}

if(!function_exists('eltd_core_process_class_instance')){

	function eltd_core_process_class_instance(){
		return Process\Process::getInstance();
	}

}

if(!function_exists('eltd_core_add_process_shortcodes')) {
	function eltd_core_add_process_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'ElatedCore\CPT\Shortcodes\ProcessHolder\ProcessHolder',
			'ElatedCore\CPT\Shortcodes\Process\Process'
		);

		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

		return $shortcodes_class_name;
	}

	add_filter('eltd_core_filter_add_vc_shortcode', 'eltd_core_add_process_shortcodes');
}