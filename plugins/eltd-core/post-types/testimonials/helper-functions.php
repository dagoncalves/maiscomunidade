<?php

if(!function_exists('eltd_core_testimonials_meta_box_functions')) {
	function eltd_core_testimonials_meta_box_functions($post_types) {
		$post_types[] = 'testimonials';
		
		return $post_types;
	}
	
	add_filter('findme_elated_meta_box_post_types_save', 'eltd_core_testimonials_meta_box_functions');
	add_filter('findme_elated_meta_box_post_types_remove', 'eltd_core_testimonials_meta_box_functions');
}

if(!function_exists('eltd_core_register_testimonials_cpt')) {
	function eltd_core_register_testimonials_cpt($cpt_class_name) {
		$cpt_class = array(
			'ElatedCore\CPT\Testimonials\TestimonialsRegister'
		);
		
		$cpt_class_name = array_merge($cpt_class_name, $cpt_class);
		
		return $cpt_class_name;
	}
	
	add_filter('eltd_core_filter_register_custom_post_types', 'eltd_core_register_testimonials_cpt');
}