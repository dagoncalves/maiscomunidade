<?php

if ( ! function_exists( 'findme_elated_logo_options_map' ) ) {
	function findme_elated_logo_options_map() {
		
		findme_elated_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'findme' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = findme_elated_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'findme' )
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'findme' ),
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "#eltd_hide_logo_container",
					"dependence_show_on_yes" => ""
				)
			)
		);
		
		$hide_logo_container = findme_elated_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'hidden_property' => 'hide_logo',
				'hidden_value'    => 'yes'
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => ELATED_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'findme' ),
				'parent'        => $hide_logo_container
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => ELATED_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'findme' ),
				'parent'        => $hide_logo_container
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => ELATED_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Light', 'findme' ),
				'parent'        => $hide_logo_container
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => ELATED_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'findme' ),
				'parent'        => $hide_logo_container
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => ELATED_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'findme' ),
				'parent'        => $hide_logo_container
			)
		);
	}
	
	add_action( 'findme_elated_options_map', 'findme_elated_logo_options_map', 2 );
}