<?php
/**
 * Plugin Name: Elated Membership
 * Description: Plugin that adds social login and user dashboard page
 * Author: Elated Themes
 * Version: 1.1.1
 */

require_once 'load.php';

\ElatedMembership\Lib\ShortcodeLoader::getInstance()->load();

if ( ! function_exists( 'eltd_membership_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function eltd_membership_text_domain() {
		load_plugin_textdomain( 'eltd-membership', false, ELATED_MEMBERSHIP_REL_PATH . '/languages' );
	}

	add_action( 'plugins_loaded', 'eltd_membership_text_domain' );
}

if ( ! function_exists( 'eltd_membership_scripts' ) ) {
	/**
	 * Loads plugin scripts
	 */
	function eltd_membership_scripts() {
		wp_enqueue_style( 'eltd-membership-style', plugins_url( ELATED_MEMBERSHIP_REL_PATH . '/assets/css/membership-style.min.css' ) );

		//include google+ api
		wp_enqueue_script('eltd-membership-google-plus-api', 'https://apis.google.com/js/platform.js', array(), null, false);

		$array_deps = array(
			'underscore',
			'jquery-ui-tabs'
		);
		
		if ( eltd_membership_theme_installed() ) {
			$array_deps[] = 'findme-elated-modules';
		}
		
		wp_enqueue_script( 'eltd-membership-script', plugins_url( ELATED_MEMBERSHIP_REL_PATH . '/assets/js/script.min.js' ), $array_deps, false, true );
	}

	add_action( 'wp_enqueue_scripts', 'eltd_membership_scripts' );
}