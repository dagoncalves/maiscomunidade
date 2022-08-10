<?php

if(!function_exists('eltd_core_map_masonry_gallery_meta')) {
    function eltd_core_map_masonry_gallery_meta() {
        $masonry_gallery_meta_box = findme_elated_create_meta_box(
            array(
                'scope' => array('masonry-gallery'),
                'title' => esc_html__('Masonry Gallery General', 'eltd-core'),
                'name' => 'masonry_gallery_meta'
            )
        );
	    
        findme_elated_create_meta_box_field(
            array(
                'name' => 'eltd_masonry_gallery_item_title_tag',
                'type' => 'select',
                'default_value' => 'h4',
                'label' => esc_html__('Title Tag', 'eltd-core'),
                'parent' => $masonry_gallery_meta_box,
                'options' => findme_elated_get_title_tag()
            )
        );

        findme_elated_create_meta_box_field(
            array(
                'name' => 'eltd_masonry_gallery_item_text',
                'type' => 'text',
                'label' => esc_html__('Text', 'eltd-core'),
                'parent' => $masonry_gallery_meta_box
            )
        );

        findme_elated_create_meta_box_field(
            array(
                'name' => 'eltd_masonry_gallery_item_image',
                'type' => 'image',
                'label' => esc_html__('Custom Item Icon', 'eltd-core'),
                'parent' => $masonry_gallery_meta_box
            )
        );

        findme_elated_create_meta_box_field(
            array(
                'name' => 'eltd_masonry_gallery_item_link',
                'type' => 'text',
                'label' => esc_html__('Link', 'eltd-core'),
                'parent' => $masonry_gallery_meta_box
            )
        );

        findme_elated_create_meta_box_field(
            array(
                'name' => 'eltd_masonry_gallery_item_link_target',
                'type' => 'select',
                'default_value' => '_self',
                'label' => esc_html__('Link Target', 'eltd-core'),
                'parent' => $masonry_gallery_meta_box,
                'options' => findme_elated_get_link_target_array()
            )
        );

        findme_elated_add_admin_section_title(array(
            'name'   => 'eltd_section_style_title',
            'parent' => $masonry_gallery_meta_box,
            'title'  => esc_html__('Masonry Gallery Item Style', 'eltd-core')
        ));

        findme_elated_create_meta_box_field(
            array(
                'name' => 'eltd_masonry_gallery_item_size',
                'type' => 'select',
                'default_value' => 'square-small',
                'label' => esc_html__('Size', 'eltd-core'),
                'parent' => $masonry_gallery_meta_box,
                'options' => array(
                    'square-small'			=> esc_html__('Square Small', 'eltd-core'),
                    'square-big'			=> esc_html__('Square Big', 'eltd-core'),
                    'rectangle-portrait'	=> esc_html__('Rectangle Portrait', 'eltd-core'),
                    'rectangle-landscape'	=> esc_html__('Rectangle Landscape', 'eltd-core')
                )
            )
        );

        findme_elated_create_meta_box_field(
            array(
                'name' => 'eltd_masonry_gallery_item_type',
                'type' => 'select',
                'default_value' => 'standard',
                'label' => esc_html__('Type', 'eltd-core'),
                'parent' => $masonry_gallery_meta_box,
                'options' => array(
                    'standard'		=> esc_html__('Standard', 'eltd-core'),
                    'with-button'	=> esc_html__('With Button', 'eltd-core'),
                    'simple'		=> esc_html__('Simple', 'eltd-core')
                ),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        'with-button' => '#eltd_masonry_gallery_item_simple_type_container',
                        'simple' => '#eltd_masonry_gallery_item_button_type_container',
                        'standard' => '#eltd_masonry_gallery_item_button_type_container, #eltd_masonry_gallery_item_simple_type_container'
                    ),
                    'show' => array(
                        'with-button' => '#eltd_masonry_gallery_item_button_type_container',
                        'simple' => '#eltd_masonry_gallery_item_simple_type_container',
                        'standard' => ''
                    )
                )
            )
        );

        $masonry_gallery_item_button_type_container = findme_elated_add_admin_container_no_style(array(
            'name'				=> 'masonry_gallery_item_button_type_container',
            'parent'			=> $masonry_gallery_meta_box,
            'hidden_property'	=> 'eltd_masonry_gallery_item_type',
            'hidden_values'		=> array('standard', 'simple')
        ));

        findme_elated_create_meta_box_field(
            array(
                'name' => 'eltd_masonry_gallery_button_label',
                'type' => 'text',
                'label' => esc_html__('Button Label', 'eltd-core'),
                'parent' => $masonry_gallery_item_button_type_container
            )
        );

        $masonry_gallery_item_simple_type_container = findme_elated_add_admin_container_no_style(array(
            'name'				=> 'masonry_gallery_item_simple_type_container',
            'parent'			=> $masonry_gallery_meta_box,
            'hidden_property'	=> 'eltd_masonry_gallery_item_type',
            'hidden_values'		=> array('standard', 'with-button')
        ));

        findme_elated_create_meta_box_field(
            array(
                'name' => 'eltd_masonry_gallery_simple_content_background_skin',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Content Background Skin', 'eltd-core'),
                'parent' => $masonry_gallery_item_simple_type_container,
                'options' => array(
                    'default' => esc_html__('Default', 'eltd-core'),
                    'light'	=> esc_html__('Light', 'eltd-core'),
                    'dark'	=> esc_html__('Dark', 'eltd-core')
                )
            )
        );
    }

    add_action('findme_elated_meta_boxes_map', 'eltd_core_map_masonry_gallery_meta', 45);
}