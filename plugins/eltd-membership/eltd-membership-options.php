<?php
/**
 * Options map file
 */

if ( ! function_exists( 'eltd_membership_add_options' ) ) {
	/**
	 * Map plugin options
	 */
	function eltd_membership_add_options() {

		if ( eltd_membership_theme_installed() ) {

			$panel_social_login = findme_elated_add_admin_panel( array(
				'page'  => '_social_page',
				'name'  => 'panel_social_login',
				'title' => esc_html__('Enable Social Login', 'eltd-membership')
			) );

			findme_elated_add_admin_field( array(
				'type'          => 'yesno',
				'name'          => 'enable_social_login',
				'default_value' => 'no',
				'label'         => esc_html__('Enable Social Login', 'eltd-membership'),
				'description'   => esc_html__('Enabling this option will allow login from social networks of your choice', 'eltd-membership'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_panel_enable_social_login'
				),
				'parent'        => $panel_social_login
			) );

			$panel_enable_social_login = findme_elated_add_admin_panel( array(
				'page'            => '_social_page',
				'name'            => 'panel_enable_social_login',
				'title'           => esc_html__('Enable Login via', 'eltd-membership'),
				'hidden_property' => 'enable_social_login',
				'hidden_value'    => 'no'
			) );

			findme_elated_add_admin_field( array(
				'type'          => 'yesno',
				'name'          => 'enable_facebook_social_login',
				'default_value' => 'no',
				'label'         => esc_html__('Facebook', 'eltd-membership'),
				'description'   => esc_html__('Enabling this option will allow login via Facebook', 'eltd-membership'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_enable_facebook_social_login_container'
				),
				'parent'        => $panel_enable_social_login
			) );

			$enable_facebook_social_login_container = findme_elated_add_admin_container( array(
				'name'            => 'enable_facebook_social_login_container',
				'hidden_property' => 'enable_facebook_social_login',
				'hidden_value'    => 'no',
				'parent'          => $panel_enable_social_login
			) );

			findme_elated_add_admin_field( array(
				'type'          => 'text',
				'name'          => 'enable_facebook_login_fbapp_id',
				'default_value' => '',
				'label'         => esc_html__('Facebook App ID', 'eltd-membership'),
				'description'   => esc_html__('Copy your application ID form created Facebook Application', 'eltd-membership'),
				'parent'        => $enable_facebook_social_login_container
			) );

			findme_elated_add_admin_field( array(
				'type'          => 'yesno',
				'name'          => 'enable_google_social_login',
				'default_value' => 'no',
				'label'         => esc_html__('Google+', 'eltd-membership'),
				'description'   => esc_html__('Enabling this option will allow login via Google+', 'eltd-membership'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_enable_google_social_login_container'
				),
				'parent'        => $panel_enable_social_login
			) );

			$enable_google_social_login_container = findme_elated_add_admin_container( array(
				'name'            => 'enable_google_social_login_container',
				'hidden_property' => 'enable_google_social_login',
				'hidden_value'    => 'no',
				'parent'          => $panel_enable_social_login
			) );

			findme_elated_add_admin_field( array(
				'type'          => 'text',
				'name'          => 'enable_google_login_client_id',
				'default_value' => '',
				'label'         => esc_html__('Client ID', 'eltd-membership'),
				'description'   => esc_html__('Copy your Client ID form created Google Application', 'eltd-membership'),
				'parent'        => $enable_google_social_login_container
			) );

		}

	}

	add_action( 'findme_elated_options_map', 'eltd_membership_add_options', 50 );

}
