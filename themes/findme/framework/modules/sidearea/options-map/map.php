<?php

if ( ! function_exists('findme_elated_sidearea_options_map') ) {

	function findme_elated_sidearea_options_map() {

		findme_elated_add_admin_page(
			array(
				'slug' => '_side_area_page',
				'title' => esc_html__('Side Area', 'findme'),
				'icon' => 'fa fa-indent'
			)
		);

		$side_area_panel = findme_elated_add_admin_panel(
			array(
				'title' => esc_html__('Side Area', 'findme'),
				'name' => 'side_area',
				'page' => '_side_area_page'
			)
		);

		$side_area_icon_style_group = findme_elated_add_admin_group(
			array(
				'parent' => $side_area_panel,
				'name' => 'side_area_icon_style_group',
				'title' => esc_html__('Side Area Icon Style', 'findme'),
				'description' => esc_html__('Define styles for Side Area icon', 'findme')
			)
		);

		$side_area_icon_style_row1 = findme_elated_add_admin_row(
			array(
				'parent'	=> $side_area_icon_style_group,
				'name'		=> 'side_area_icon_style_row1'
			)
		);

		findme_elated_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type' => 'colorsimple',
				'name' => 'side_area_icon_color',
				'label' => esc_html__('Color', 'findme')
			)
		);

		findme_elated_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type' => 'colorsimple',
				'name' => 'side_area_icon_hover_color',
				'label' => esc_html__('Hover Color', 'findme')
			)
		);

		$side_area_icon_style_row2 = findme_elated_add_admin_row(
			array(
				'parent'	=> $side_area_icon_style_group,
				'name'		=> 'side_area_icon_style_row2',
				'next'		=> true
			)
		);

		findme_elated_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type' => 'colorsimple',
				'name' => 'side_area_close_icon_color',
				'label' => esc_html__('Close Icon Color', 'findme')
			)
		);

		findme_elated_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type' => 'colorsimple',
				'name' => 'side_area_close_icon_hover_color',
				'label' => esc_html__('Close Icon Hover Color', 'findme')
			)
		);

		findme_elated_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'text',
				'name' => 'side_area_width',
				'default_value' => '',
				'label' => esc_html__('Side Area Width', 'findme'),
				'description' => esc_html__('Enter a width for Side Area', 'findme'),
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);

		findme_elated_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'color',
				'name' => 'side_area_background_color',
				'label' => esc_html__('Background Color', 'findme'),
				'description' => esc_html__('Choose a background color for Side Area', 'findme')
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'text',
				'name' => 'side_area_padding',
				'label' => esc_html__('Padding', 'findme'),
				'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'findme'),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		findme_elated_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'selectblank',
				'name' => 'side_area_aligment',
				'default_value' => '',
				'label' => esc_html__('Text Alignment', 'findme'),
				'description' => esc_html__('Choose text alignment for side area', 'findme'),
				'options' => array(
					'' => esc_html__('Default', 'findme'),
					'left' => esc_html__('Left', 'findme'),
					'center' => esc_html__('Center', 'findme'),
					'right' => esc_html__('Right', 'findme')
				)
			)
		);
	}

	add_action('findme_elated_options_map', 'findme_elated_sidearea_options_map', 15);
}