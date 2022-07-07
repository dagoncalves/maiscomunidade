<?php

if ( ! function_exists( 'findme_elated_register_required_plugins' ) ) {
	/**
	 * Registers Visual Composer, Revolution Slider, Elated Core, Elated Instagram Feed, Elated Twitter Feed  as required plugins. Hooks to tgmpa_register hook
	 */
	function findme_elated_register_required_plugins() {

		$plugins = array(
			array(
				'name'               => esc_html__( 'WPBakery Page Builder', 'findme' ),
				'slug'               => 'js_composer',
				'source'             => get_template_directory() . '/includes/plugins/js_composer.zip',
				'required'           => true,
				'version'            => '6.4.1',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => ''
			),
			array(
				'name'               => esc_html__( 'Revolution Slider', 'findme' ),
				'slug'               => 'revslider',
				'source'             => get_template_directory() . '/includes/plugins/revslider.zip',
				'version'            => '6.2.23',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => ''
			),
			array(
				'name'               => esc_html__( 'Envato Market', 'findme' ),
				'slug'               => 'envato-market',
				'source'             => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => '',
			),
			array(
				'name'         => esc_html__( 'Wp Job Manager', 'findme' ),
				'slug'         => 'wp-job-manager',
				'required'     => true,
				'external_url' => 'https://wordpress.org/plugins/wp-job-manager/',
			),
			array(
				'name'               => esc_html__( 'Elated Core', 'findme' ),
				'slug'               => 'eltd-core',
				'source'             => get_template_directory() . '/includes/plugins/eltd-core.zip',
				'required'           => true,
				'version'            => '1.4.2',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => ''
			),
			array(
				'name'               => esc_html__( 'Elated Instagram Feed', 'findme' ),
				'slug'               => 'eltd-instagram-feed',
				'source'             => get_template_directory() . '/includes/plugins/eltd-instagram-feed.zip',
				'required'           => true,
				'version'            => '2.0',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => ''
			),
			array(
				'name'               => esc_html__( 'Elated Twitter Feed', 'findme' ),
				'slug'               => 'eltd-twitter-feed',
				'source'             => get_template_directory() . '/includes/plugins/eltd-twitter-feed.zip',
				'required'           => true,
				'version'            => '1.0.1',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => ''
			),
			array(
				'name'               => esc_html__( 'Elated Booking', 'findme' ),
				'slug'               => 'eltd-booking',
				'source'             => get_template_directory() . '/includes/plugins/eltd-booking.zip',
				'required'           => true,
				'version'            => '1.1',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => ''
			),
			array(
				'name'               => esc_html__( 'Elated Listing', 'findme' ),
				'slug'               => 'eltd-listing',
				'source'             => get_template_directory() . '/includes/plugins/eltd-listing.zip',
				'required'           => true,
				'version'            => '1.4.2',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => ''
			),
			array(
				'name'               => esc_html__( 'Elated Membership', 'findme' ),
				'slug'               => 'eltd-membership',
				'source'             => get_template_directory() . '/includes/plugins/eltd-membership.zip',
				'required'           => true,
				'version'            => '1.1.1',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => ''
			),
			array(
				'name'         => esc_html__( 'WooCommerce plugin', 'findme' ),
				'slug'         => 'woocommerce',
				'external_url' => 'https://wordpress.org/plugins/woocommerce/',
				'required'     => false
			),
			array(
				'name'         => esc_html__( 'Contact Form 7', 'findme' ),
				'slug'         => 'contact-form-7',
				'external_url' => 'https://wordpress.org/plugins/contact-form-7/',
				'required'     => false
			)
		);

		$config = array(
			'domain'       => 'findme',
			'default_path' => '',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'menu'         => 'install-required-plugins',
			'has_notices'  => true,
			'is_automatic' => false,
			'message'      => '',
			'strings'      => array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'findme' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'findme' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'findme' ),
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'findme' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'findme' ),
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'findme' ),
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'findme' ),
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'findme' ),
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'findme' ),
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'findme' ),
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'findme' ),
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'findme' ),
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'findme' ),
				'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'findme' ),
				'return'                          => esc_html__( 'Return to Required Plugins Installer', 'findme' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'findme' ),
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'findme' ),
				'nag_type'                        => 'updated'
			)
		);

		tgmpa( $plugins, $config );
	}

	add_action( 'tgmpa_register', 'findme_elated_register_required_plugins' );
}