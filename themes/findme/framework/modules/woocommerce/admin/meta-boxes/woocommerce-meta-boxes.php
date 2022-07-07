<?php

if(!function_exists('findme_elated_map_woocommerce_meta')) {
    function findme_elated_map_woocommerce_meta() {
        $woocommerce_meta_box = findme_elated_create_meta_box(
            array(
                'scope' => array('product'),
                'title' => esc_html__('Product Meta', 'findme'),
                'name' => 'woo_product_meta'
            )
        );

        findme_elated_create_meta_box_field(array(
            'name'        => 'eltd_product_featured_image_size',
            'type'        => 'select',
            'label'       => esc_html__('Dimensions for Product List Shortcode', 'findme'),
            'description' => esc_html__('Choose image layout when it appears in Elated Product List - Masonry layout shortcode', 'findme'),
            'parent'      => $woocommerce_meta_box,
            'options'     => array(
                'eltd-woo-image-normal-width' => esc_html__('Default', 'findme'),
                'eltd-woo-image-large-width'  => esc_html__('Large Width', 'findme')
            )
        ));

        findme_elated_create_meta_box_field(
            array(
                'name'          => 'eltd_show_title_area_woo_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Show Title Area', 'findme'),
                'description'   => esc_html__('Disabling this option will turn off page title area', 'findme'),
                'parent'        => $woocommerce_meta_box,
                'options'       => findme_elated_get_yes_no_select_array()
            )
        );

        findme_elated_create_meta_box_field(
            array(
                'name'        => 'eltd_disable_page_content_top_padding_meta',
                'type'        => 'select',
                'label'       => esc_html__('Disable Content Top Padding', 'findme'),
                'description' => esc_html__('Enabling this option will disable content top padding', 'findme'),
                'parent'      => $woocommerce_meta_box,
                'options'     => findme_elated_get_yes_no_select_array()
            )
        );
    }
	
    add_action('findme_elated_meta_boxes_map', 'findme_elated_map_woocommerce_meta', 99);
}