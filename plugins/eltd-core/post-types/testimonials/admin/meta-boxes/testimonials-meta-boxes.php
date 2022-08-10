<?php

if(!function_exists('eltd_core_map_testimonials_meta')) {
    function eltd_core_map_testimonials_meta() {
        $testimonial_meta_box = findme_elated_create_meta_box(
            array(
                'scope' => array('testimonials'),
                'title' => esc_html__('Testimonial', 'eltd-core'),
                'name' => 'testimonial_meta'
            )
        );

        findme_elated_create_meta_box_field(
            array(
                'name'        	=> 'eltd_testimonial_title',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Title', 'eltd-core'),
                'description' 	=> esc_html__('Enter testimonial title', 'eltd-core'),
                'parent'      	=> $testimonial_meta_box,
            )
        );

        findme_elated_create_meta_box_field(
            array(
                'name'        	=> 'eltd_testimonial_text',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Text', 'eltd-core'),
                'description' 	=> esc_html__('Enter testimonial text', 'eltd-core'),
                'parent'      	=> $testimonial_meta_box,
            )
        );

        findme_elated_create_meta_box_field(
            array(
                'name'        	=> 'eltd_testimonial_author',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Author', 'eltd-core'),
                'description' 	=> esc_html__('Enter author name', 'eltd-core'),
                'parent'      	=> $testimonial_meta_box,
            )
        );
        
        findme_elated_create_meta_box_field(
            array(
                'name'        	=> 'eltd_testimonial_address',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Address', 'eltd-core'),
                'description' 	=> esc_html__('Enter address', 'eltd-core'),
                'parent'      	=> $testimonial_meta_box,
            )
        );
        
        findme_elated_create_meta_box_field(
            array(
                'name'        	=> 'eltd_testimonial_website',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Website', 'eltd-core'),
                'description' 	=> esc_html__('Enter website address', 'eltd-core'),
                'parent'      	=> $testimonial_meta_box,
            )
        );
    }

    add_action('findme_elated_meta_boxes_map', 'eltd_core_map_testimonials_meta', 95);
}