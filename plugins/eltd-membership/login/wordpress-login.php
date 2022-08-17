<?php
/**
 * Wordpress Users Login
 */

if ( ! function_exists( 'eltd_membership_login_user' ) ) {
	/**
	 * Login user
	 */
	function eltd_membership_login_user() {

		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			eltd_membership_ajax_response( 'error', esc_html__( 'All fields are empty', 'eltd-membership' ) );
		} else {
			check_ajax_referer( 'eltd-ajax-login-nonce', 'security' );
			$data = $_POST;

			$login = $data['login_data'];
			parse_str( $login, $login_data );

			$credentials['user_login']    = $login_data['user_login_name'];
			$credentials['user_password'] = $login_data['user_login_password'];
			$redirect_uri                 = $login_data['redirect'];

			if ( isset( $credentials['remember'] ) && $credentials['remember'] == 'forever' ) {
				$credentials['remember'] = true;
			} else {
				$credentials['remember'] = false;
			}
			$user_signon = wp_signon( $credentials, false );

			if ( is_wp_error( $user_signon ) ) {
				eltd_membership_ajax_response( 'error', esc_html__( 'Wrong username or password.', 'eltd-membership' ) );
			} else {
				if ( $redirect_uri == '' ) {
					$redirect_uri = eltd_membership_get_dashboard_page_url();
					if ( $redirect_uri == '' ) {
						$redirect_uri = esc_url( home_url( '/' ) );
					}
				}
				eltd_membership_ajax_response( 'success', esc_html__( 'Login successful, redirecting...', 'eltd-membership' ), $redirect_uri );
			}

		}
		wp_die();
	}

	add_action( 'wp_ajax_nopriv_eltd_membership_login_user', 'eltd_membership_login_user' );
}

if ( ! function_exists( 'eltd_membership_register_user' ) ) {
	/**
	 * Register new user
	 */
	function eltd_membership_register_user() {

		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			eltd_membership_ajax_response( 'error', esc_html__( 'All fields are empty', 'eltd-membership' ) );
		} else {
			check_ajax_referer( 'eltd-ajax-register-nonce', 'security' );
			$data = $_POST;

			$register = $data['register_data'];
			parse_str( $register, $register_data );

			$credentials['user_login']       = $register_data['user_register_name'];
			$credentials['user_email']       = $register_data['user_register_email'];
			$credentials['password']         = $register_data['user_register_password'];
			$credentials['confirm_password'] = $register_data['user_register_confirm_password'];
			$credentials['uf']      		 = $register_data['user_register_uf'];

			$user_id    = username_exists( $credentials['user_login'] );
			$user_email = email_exists( $credentials['user_email'] );

			if ( ! $user_id && ! $user_email ) {
				if ( $credentials['password'] == $credentials['confirm_password'] ) {
					$user_save_flag = wp_create_user( $credentials['user_login'], $credentials['password'], $credentials['user_email'] );

					if ( is_wp_error( $user_save_flag ) ) {
						eltd_membership_ajax_response( 'error', esc_html__( 'Something went wrong', 'eltd_membership' ) );
					} else {

						wp_update_user( array( 'ID' => $user_save_flag, 'role' => get_option( 'default_role' ) ) );
						wp_update_user( array( 'ID' => $user_save_flag, 'user_url' => $credentials['uf'] ) );
						update_user_meta( $user_save_flag, 'uf', $credentials['uf'] );

						$mail_to = $credentials['user_email'];

						$subject = esc_html__( 'User Registration', 'eltd_membership' ); //Subject
						$message = esc_html__( 'You have registered successfully on ', 'eltd_membership' ) . esc_url( get_site_url() ); //Message
						wp_mail( $mail_to, $subject, $message );
						eltd_membership_ajax_response( 'success', esc_html__( 'You have registered successfully, please login with the created credentials', 'eltd_membership' ) );

					}
				} else {
					eltd_membership_ajax_response( 'error', esc_html__( 'Both passwords must match in order to register', 'eltd_membership' ) );
				}
			} elseif ( $user_id ) {
				eltd_membership_ajax_response( 'error', esc_html__( 'Username already exists', 'eltd_membership' ) );
			} else {
				eltd_membership_ajax_response( 'error', esc_html__( 'User with that name already exists', 'eltd_membership' ) );
			}

		}
		wp_die();
	}

	add_action( 'wp_ajax_nopriv_eltd_membership_register_user', 'eltd_membership_register_user' );
}

if ( ! function_exists( 'eltd_membership_user_lost_password' ) ) {
	/**
	 * Reset user password
	 */
	function eltd_membership_user_lost_password() {

		if ( ! function_exists( 'retrieve_password' ) ) {
			ob_start();
			include_once( ABSPATH . 'wp-login.php' );
			ob_clean();
		}
		$result = retrieve_password();
		if ( $result === true ) {
			eltd_membership_ajax_response( 'success', esc_html__( 'We have sent you an email', 'eltd-membership' ) );
		} else {
			eltd_membership_ajax_response( 'error', $result->get_error_message() );
		}

		wp_die();

	}

	add_action( 'wp_ajax_nopriv_eltd_membership_user_lost_password', 'eltd_membership_user_lost_password' );

}