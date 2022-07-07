<?php

if ( ! function_exists('findme_elated_search_options_map') ) {

	function findme_elated_search_options_map() {

		findme_elated_add_admin_page(
			array(
				'slug' => '_search_page',
				'title' => esc_html__('Search', 'findme'),
				'icon' => 'fa fa-search'
			)
		);

		$search_page_panel = findme_elated_add_admin_panel(
			array(
				'title' => esc_html__('Search Page', 'findme'),
				'name' => 'search_template',
				'page' => '_search_page'
			)
		);

		findme_elated_add_admin_field(array(
			'name'        => 'search_page_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout', 'findme'),
            'description' 	=> esc_html__("Choose a sidebar layout for search page", 'findme'),
            'default_value' => 'no-sidebar',
            'options'       => array(
                'no-sidebar'        => esc_html__('No Sidebar', 'findme'),
                'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'findme'),
                'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'findme'),
                'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'findme'),
                'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'findme')
            ),
			'parent'      => $search_page_panel
		));

        $findme_custom_sidebars = findme_elated_get_custom_sidebars();
        if(count($findme_custom_sidebars) > 0) {
            findme_elated_add_admin_field(array(
                'name' => 'search_custom_sidebar_area',
                'type' => 'selectblank',
                'label' => esc_html__('Sidebar to Display', 'findme'),
                'description' => esc_html__('Choose a sidebar to display on search page. Default sidebar is "Sidebar"', 'findme'),
                'parent' => $search_page_panel,
                'options' => $findme_custom_sidebars,
				'args' => array(
					'select2' => true
				)
            ));
        }

		$search_panel = findme_elated_add_admin_panel(
			array(
				'title' => esc_html__('Search', 'findme'),
				'name' => 'search',
				'page' => '_search_page'
			)
		);

		findme_elated_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'select',
				'name'			=> 'search_type',
				'default_value'	=> 'fullscreen',
				'label' 		=> esc_html__('Select Search Type', 'findme'),
				'description' 	=> esc_html__("Choose a type of Select search bar (Note: Slide From Header Bottom search type doesn't work with Vertical Header)", 'findme'),
				'options' 		=> array(
					'fullscreen' => esc_html__('Fullscreen Search', 'findme'),
					'slide-from-header-bottom' => esc_html__('Slide From Header Bottom', 'findme'),
                    'covers-header' => esc_html__('Search Covers Header', 'findme'),
                    'slide-from-window-top' => esc_html__('Slide from Window Top' , 'findme')
				)
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'select',
				'name'			=> 'search_icon_pack',
				'default_value'	=> 'font_elegant',
				'label'			=> esc_html__('Search Icon Pack', 'findme'),
				'description'	=> esc_html__('Choose icon pack for search icon', 'findme'),
				'options'		=> findme_elated_icon_collections()->getIconCollectionsExclude(array('linea_icons'))
			)
		);

        findme_elated_add_admin_field(
            array(
                'parent'		=> $search_panel,
                'type'			=> 'yesno',
                'name'			=> 'search_in_grid',
                'default_value'	=> 'yes',
                'label'			=> esc_html__('Enable Grid Layout', 'findme'),
                'description'	=> esc_html__('Set search area to be in grid. (Applied for Search covers header and Slide from Window Top types.', 'findme'),
            )
        );
		
		findme_elated_add_admin_section_title(
			array(
				'parent' 	=> $search_panel,
				'name'		=> 'initial_header_icon_title',
				'title'		=> esc_html__('Initial Search Icon in Header', 'findme')
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'text',
				'name'			=> 'header_search_icon_size',
				'default_value'	=> '',
				'label'			=> esc_html__('Icon Size', 'findme'),
				'description'	=> esc_html__('Set size for icon', 'findme'),
				'args'			=> array(
					'col_width' => 3,
					'suffix'	=> 'px'
				)
			)
		);
		
		$search_icon_color_group = findme_elated_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title'		=> esc_html__('Icon Colors', 'findme'),
				'description' => esc_html__('Define color style for icon', 'findme'),
				'name'		=> 'search_icon_color_group'
			)
		);
		
		$search_icon_color_row = findme_elated_add_admin_row(
			array(
				'parent'	=> $search_icon_color_group,
				'name'		=> 'search_icon_color_row'
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'parent'	=> $search_icon_color_row,
				'type'		=> 'colorsimple',
				'name'		=> 'header_search_icon_color',
				'label'		=> esc_html__('Color', 'findme')
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'		=> 'colorsimple',
				'name'		=> 'header_search_icon_hover_color',
				'label'		=> esc_html__('Hover Color', 'findme')
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'yesno',
				'name'			=> 'enable_search_icon_text',
				'default_value'	=> 'no',
				'label'			=> esc_html__('Enable Search Icon Text', 'findme'),
				'description'	=> esc_html__("Enable this option to show 'Search' text next to search icon in header", 'findme'),
				'args'			=> array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_enable_search_icon_text_container'
				)
			)
		);
		
		$enable_search_icon_text_container = findme_elated_add_admin_container(
			array(
				'parent'			=> $search_panel,
				'name'				=> 'enable_search_icon_text_container',
				'hidden_property'	=> 'enable_search_icon_text',
				'hidden_value'		=> 'no'
			)
		);
		
		$enable_search_icon_text_group = findme_elated_add_admin_group(
			array(
				'parent'	=> $enable_search_icon_text_container,
				'title'		=> esc_html__('Search Icon Text', 'findme'),
				'name'		=> 'enable_search_icon_text_group',
				'description'	=> esc_html__('Define style for search icon text', 'findme')
			)
		);
		
		$enable_search_icon_text_row = findme_elated_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row'
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_text_color',
				'label'			=> esc_html__('Text Color', 'findme')
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_text_color_hover',
				'label'			=> esc_html__('Text Hover Color', 'findme')
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_font_size',
				'label'			=> esc_html__('Font Size', 'findme'),
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_line_height',
				'label'			=> esc_html__('Line Height', 'findme'),
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);
		
		$enable_search_icon_text_row2 = findme_elated_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row2',
				'next'		=> true
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_text_transform',
				'label'			=> esc_html__('Text Transform', 'findme'),
				'default_value'	=> '',
				'options'		=> findme_elated_get_text_transform_array()
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'fontsimple',
				'name'			=> 'search_icon_text_google_fonts',
				'label'			=> esc_html__('Font Family', 'findme'),
				'default_value'	=> '-1',
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_font_style',
				'label'			=> esc_html__('Font Style', 'findme'),
				'default_value'	=> '',
				'options'		=> findme_elated_get_font_style_array(),
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_font_weight',
				'label'			=> esc_html__('Font Weight', 'findme'),
				'default_value'	=> '',
				'options'		=> findme_elated_get_font_weight_array(),
			)
		);
		
		$enable_search_icon_text_row3 = findme_elated_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row3',
				'next'		=> true
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row3,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_letter_spacing',
				'label'			=> esc_html__('Letter Spacing', 'findme'),
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);
	}

	add_action('findme_elated_options_map', 'findme_elated_search_options_map', 16);
}