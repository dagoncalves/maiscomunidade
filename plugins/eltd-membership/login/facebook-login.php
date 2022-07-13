<?php
/**
 * Functions for Facebook login
 */

if ( ! function_exists( 'eltd_membership_get_facebook_social_login' ) ) {
	/**
	 * Render form for facebook login
	 */
	function eltd_membership_get_facebook_social_login() {

		$social_login_enabled   = findme_elated_options()->getOptionValue( 'enable_social_login' ) == 'yes' ? true : false;
		$facebook_login_enabled = findme_elated_options()->getOptionValue( 'enable_facebook_social_login' ) == 'yes' ? true : false;
		$enabled                = ( $social_login_enabled && $facebook_login_enabled ) ? true : false;

		if ( ! is_user_logged_in() && $enabled ) {

			$html = '<form class="eltd-facebook-login-holder">'
			        . wp_nonce_field( 'eltd_validate_facebook_login', 'eltd_nonce_facebook_login_'.rand(), true, false ) .
			        findme_elated_get_button_html( array(
				        'html_type'    => 'button',
				        'custom_class' => 'eltd-facebook-login',
				        'icon_pack'    => 'font_awesome',
				        'fa_icon'      => 'fa-facebook',
				        'size'         => 'small',
				        'background_color' => '#3b5998',
				        'border_color' => '#3b5998',
                        'hover_color'  => '#3b5998',
                        'icon_hover_color' => '#3b5998'
			        ) ) .
			        '</form>';
			echo findme_elated_get_module_part( $html );

		}

	}

	add_action( 'eltd_membership_social_network_login', 'eltd_membership_get_facebook_social_login' );

}

if ( ! function_exists( 'eltd_membership_check_facebook_user' ) ) {
	/**
	 * Function for getting facebook user data.
	 * Checks for user mail and register or log in user
	 */
	function eltd_membership_check_facebook_user() {

		if ( isset( $_POST['response'] ) ) {
			$response            = $_POST['response'];
			$user_email          = $response['email'];
			$network             = 'facebook';
			$response['network'] = $network;
			$nonce               = $response['nonce'];

			if ( email_exists( $user_email ) ) {
				//User already exist, log in user
				eltd_membership_login_user_from_social_network( $user_email, $nonce, $network );
			} else {
				//Register new user
				eltd_membership_register_user_from_social_network( $response );
			}
			$url = eltd_membership_get_dashboard_page_url();
			if ( $url == '' ) {
				$url = esc_url( home_url( '/' ) );
			}
			eltd_membership_ajax_response( 'success', esc_html__( 'Login successful, redirecting...', 'eltd-membership' ), $url );
		}
		wp_die();

	}

	add_action( 'wp_ajax_eltd_membership_check_facebook_user', 'eltd_membership_check_facebook_user' );
	add_action( 'wp_ajax_nopriv_eltd_membership_check_facebook_user', 'eltd_membership_check_facebook_user' );

}