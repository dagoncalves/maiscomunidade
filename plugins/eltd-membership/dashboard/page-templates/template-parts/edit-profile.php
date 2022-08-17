<div class="eltd-membership-dashboard-page">
	<h3 class="eltd-membership-dashboard-page-title eltd-main-title">
		<?php esc_html_e( 'Edit Your Profile', 'eltd-membership' ); ?>
	</h3>
	<div>
		<form method="post" id="eltd-membership-update-profile-form">
            <div class="eltd-membership-profile-input-holder">
                <div class="eltd-membership-input-holder">
                    <label for="first_name"><?php esc_html_e( 'First Name', 'eltd-membership' ); ?></label>
                    <input class="eltd-membership-input" type="text" name="first_name" id="first_name"
                           value="<?php echo esc_attr($first_name); ?>" placeholder="<?php esc_html_e( 'First Name', 'eltd-membership' ); ?>">
                </div>
                <div class="eltd-membership-input-holder">
                    <label for="last_name"><?php esc_html_e( 'Last Name', 'eltd-membership' ); ?></label>
                    <input class="eltd-membership-input" type="text" name="last_name" id="last_name"
                           value="<?php echo esc_attr($last_name); ?>" placeholder="<?php esc_html_e( 'Last Name', 'eltd-membership' ); ?>">
                </div>
                <div class="eltd-membership-input-holder">
                    <label for="email"><?php esc_html_e( 'Email', 'eltd-membership' ); ?></label>
                    <input class="eltd-membership-input" type="email" name="email" id="email"
                           value="<?php echo esc_attr($email); ?>" placeholder="<?php esc_html_e( 'Email', 'eltd-membership' ); ?>">
                </div>
                <div class="eltd-membership-input-holder">
                    <label for="url"><?php esc_html_e( 'Website', 'eltd-membership' ); ?></label>
                    <input class="eltd-membership-input" type="text" name="url" id="url" value="<?php echo esc_url($website); ?>"
                            placeholder="<?php esc_html_e( 'Website', 'eltd-membership' ); ?>">
                </div>
                <div class="eltd-membership-input-holder">
                    <label for="description"><?php esc_html_e( 'Description', 'eltd-membership' ); ?></label>
                    <input class="eltd-membership-input" type="text" name="description" id="description"
                           value="<?php echo esc_attr($description); ?>" placeholder="<?php esc_html_e( 'Description', 'eltd-membership' ); ?>">
                </div>
                <div class="eltd-membership-input-holder">
                    <label for="uf"><?php esc_html_e( 'UF', 'eltd-membership' ); ?></label>
                    <input readonly class="eltd-membership-input" type="text" name="uf" id="uf"
                           value="<?php echo esc_attr($uf); ?>" placeholder="<?php esc_html_e( 'UF', 'eltd-membership' ); ?>">
                </div>
            </div>
            <div class="eltd-membership-password-input-holder">
                <h4 class="eltd-membership-dashboard-page-title">
                    <?php esc_html_e( 'Manage your password', 'eltd-membership' ); ?>
                </h4>
                <div class="eltd-membership-input-holder">
                    <label for="password"><?php esc_html_e( 'Password', 'eltd-membership' ); ?></label>
                    <input class="eltd-membership-input" type="password" name="password" id="password" value=""
                            placeholder="<?php esc_html_e( 'Password', 'eltd-membership' ); ?>">
                </div>
                <div class="eltd-membership-input-holder">
                    <label for="password2"><?php esc_html_e( 'Repeat Password', 'eltd-membership' ); ?></label>
                    <input class="eltd-membership-input" type="password" name="password2" id="password2" value=""
                            placeholder="<?php esc_html_e( 'Repeat Password', 'eltd-membership' ); ?>">
                </div>
            </div>
			<?php
			if ( eltd_membership_theme_installed() ) {
				echo findme_elated_get_button_html( array(
					'text'      => esc_html__( 'Save Changes', 'eltd-membership' ),
					'html_type' => 'button',
                    'size' => 'medium',
					'custom_attrs' => array(
						'data-updating-text' => esc_html__('Saving Changes', 'eltd-membership'),
						'data-updated-text' => esc_html__('Changes Saved', 'eltd-membership'),
					)
				) );
			} else {
				echo '<button type="submit">' . esc_html__( 'Save Changes', 'eltd-membership' ) . '</button>';
			}
			wp_nonce_field( 'eltd_validate_edit_profile', 'eltd_nonce_edit_profile' )
			?>
		</form>
		<?php
			do_action( 'eltd_membership_action_login_ajax_response' );
		?>
	</div>
</div>