<?php

if ( ! function_exists( 'eltd_membership_get_dashboard_page_url' ) ) {
	/**
	 * Function that returns dashboard page url
	 *
	 * @return string
	 */
	function eltd_membership_get_dashboard_page_url() {
		$url   = '';
		$pages = get_all_page_ids();
		foreach ( $pages as $page ) {
			if ( ( get_post_status( $page ) == 'publish' ) && ( get_page_template_slug( $page ) == 'user-dashboard.php' ) ) {
				$url = esc_url( get_the_permalink( $page ) );
				break;
			}
		}


		return $url;
	}
}

if ( ! function_exists( 'eltd_membership_get_dashboard_template_part' ) ) {
	/**
	 * Loads Dashboard template part.
	 *
	 * @param $template
	 * @param string $slug
	 * @param array $params
	 *
	 * @return string
	 */
	function eltd_membership_get_dashboard_template_part( $template, $slug = '', $params = array() ) {

		//HTML Content from template
		$html = '';

		$theme_template_path  = get_template_directory() . '/eltd-membership/dashboard/page-templates/template-parts';
		$plugin_template_path = ELATED_MEMBERSHIP_ABS_PATH . '/dashboard/page-templates/template-parts';

		if ( $slug !== '' ) {
			$template = "{$template}-{$slug}.php";
		} else {
			$template = "{$template}.php";
		}

		if ( file_exists( $theme_template_path . '/' . $template ) ) {
			$temp_path = $theme_template_path . '/' . $template;
		} else {
			$temp_path = $plugin_template_path . '/' . $template;
		}
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}

		if ( $temp_path ) {
			ob_start();
			include( $temp_path );
			$html = ob_get_clean();
		}

		return $html;
	}

}

if ( ! function_exists( 'eltd_membership_get_dashboard_pages' ) ) {
	/**
	 * Loads dashboard page content based on user action
	 *
	 * @return string
	 */
	function eltd_membership_get_dashboard_pages() {

		$action = 'profile';
		if ( isset( $_GET['user-action'] ) ) {
			$action = $_GET['user-action'];
		}
		$listing_id = '';
		if(isset( $_GET['listing-id'] )){
			$listing_id = $_GET['listing-id'];
		}
		//Template params
		$params  = array();
		$user_id = get_current_user_id();

		if ( $action == 'profile' || $action == 'edit-profile' ) {
			$params['user_login']  = get_the_author_meta( 'user_login', $user_id );
			$params['first_name']  = get_the_author_meta( 'first_name', $user_id );
			$params['last_name']   = get_the_author_meta( 'last_name', $user_id );
			$params['email']       = get_the_author_meta( 'email', $user_id );
			$params['website']     = get_the_author_meta( 'url', $user_id );
			$params['description'] = get_the_author_meta( 'description', $user_id );
			$params['uf'] 		   = get_the_author_meta( 'uf', $user_id );
			$profile_image         = get_user_meta( $user_id, 'social_profile_image', true );
			if ( $profile_image == '' ) {
				$profile_image = get_avatar( $user_id, 170 );
			} else {
				$profile_image = '<img src="' . esc_url( $profile_image ) . '">';
			}
			$params['profile_image'] = $profile_image;
		}

		//Array of dashboard pages, url - template
		$pages = array(
			'profile'      => eltd_membership_get_dashboard_template_part( 'profile', '', $params ),
			'edit-profile' => eltd_membership_get_dashboard_template_part( 'edit-profile', '', $params )
		);
		$pages = apply_filters( 'eltd_membership_dashboard_pages', $pages );

		//Include template part
		if ( isset( $pages[ $action ] ) ) {
			$html = $pages[ $action ];
		} else {
			$html = $pages['profile'];
		}

		return $html;

	}

}

if ( ! function_exists( 'eltd_membership_get_dashboard_navigation_items' ) ) {
	/**
	 * Function that returns dashboard navigation items
	 *
	 * @return array|mixed|void
	 */
	function eltd_membership_get_dashboard_navigation_items() {

		$dashboard_url = eltd_membership_get_dashboard_page_url();
		$items         = array(
			'profile'      => array(
				'url'  => esc_url( add_query_arg( array( 'user-action' => 'profile' ), $dashboard_url ) ),
				'text' => esc_html__( 'Profile', 'eltd-membership' ),
                'icon' => findme_elated_icon_collections()->renderIcon('lnr-user', 'linear_icons')
			),
			'edit-profile' => array(
				'url'  => esc_url( add_query_arg( array( 'user-action' => 'edit-profile' ), $dashboard_url ) ),
				'text' => esc_html__( 'Edit Profile', 'eltd-membership' ),
                'icon' => findme_elated_icon_collections()->renderIcon('lnr-cog', 'linear_icons')
			)
		);

		$items         = apply_filters( 'eltd_membership_dashboard_navigation_pages', $items, $dashboard_url );

		return $items;

	}

}

if ( ! function_exists( 'eltd_membership_update_user_profile' ) ) {

	function eltd_membership_update_user_profile() {

		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			eltd_membership_ajax_response( 'error', esc_html__( 'All fields are empty', 'eltd-membership' ) );
		} else {
			$dashboard_url = eltd_membership_get_dashboard_page_url();
			parse_str( $_POST['data'], $update_data );

			//Check nonce
			if ( wp_verify_nonce( $update_data['eltd_nonce_edit_profile'], 'eltd_validate_edit_profile' ) ) {

				$user_id = get_current_user_id();
				if ( $user_id ) {

					//Update password
					if ( ! empty( $update_data['password'] ) ) {
						if ( $update_data['password'] === $update_data['password2'] ) {
							wp_update_user( array(
								'ID'        => $user_id,
								'user_pass' => esc_attr( $update_data['password'] )
							) );
						} else {
							eltd_membership_ajax_response( 'error', esc_html__( 'Passwords don\'t match', 'eltd-membership' ) );
						}
					}

					//Update email
					if ( ! empty( $update_data['email'] ) && filter_var( $update_data['email'], FILTER_VALIDATE_EMAIL ) ) {
						wp_update_user( array( 'ID' => $user_id, 'user_email' => esc_attr( $update_data['email'] ) ) );
					} else {
						eltd_membership_ajax_response( 'error', esc_html__( 'Error. Please insert valid email', 'eltd-membership' ) );
					}

					//Update Website
					wp_update_user( array( 'ID' => $user_id, 'user_url' => esc_url( $update_data['url'] ) ) );

					//Update user meta
					update_user_meta( $user_id, 'first_name', $update_data['first_name'] );
					update_user_meta( $user_id, 'last_name', $update_data['last_name'] );
					update_user_meta( $user_id, 'description', $update_data['description'] );
					update_user_meta( $user_id, 'uf', $update_data['uf'] );

					eltd_membership_ajax_response( 'success', esc_html__( 'Your profile is updated', 'eltd-membership' ), $dashboard_url );

				} else {
					eltd_membership_ajax_response( 'error', esc_html__( 'You are unauthorized to perform this action.', 'eltd-membership' ) );
				}

			} else {
				eltd_membership_ajax_response( 'error', esc_html__( 'Error.', 'eltd-membership' ) );
			}

		}

	}

	add_action( 'wp_ajax_eltd_membership_update_user_profile', 'eltd_membership_update_user_profile' );

}