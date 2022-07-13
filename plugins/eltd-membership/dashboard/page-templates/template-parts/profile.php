<div class="eltd-membership-dashboard-page">
    <h2 class="eltd-membership-dashboard-page-title eltd-main-title">
		<?php esc_html_e( 'Profile', 'eltd-membership' ); ?>
    </h2>
	<div class="eltd-membership-dashboard-page-content">
        <div class="eltd-membership-dashboard-image-holder eltd-membership-left">
			aaaa<?php echo eltd_membership_kses_img( $profile_image ); ?>
            <p class="eltd-image-info"> <?php esc_html_e( 'You are currently signed in as', 'eltd-membership' ); ?> <span><?php echo esc_attr( $user_login ); ?></span></p>
			<?php
			echo findme_elated_get_button_html( array(
				'text'      => esc_html__( 'Sign out', 'findme' ),
				'html_type' => 'anchor',
				'size' => 'small',
				'link' => apply_filters( 'submit_job_form_logout_url', wp_logout_url( get_permalink() )),
			) );
			?>
        </div>
        <div class="eltd-membership-dashboard-profile-content eltd-membership-right">
            <?php if ($first_name !== ''){ ?>
                <p>
                    <span><?php esc_html_e( 'First Name', 'eltd-membership' ); ?></span>
                    <?php echo esc_attr($first_name); ?>
                </p>
            <?php } ?>
            <?php if ($last_name !== ''){ ?>
                <p>
                    <span><?php esc_html_e( 'Last Name', 'eltd-membership' ); ?></span>
                    <?php echo esc_attr($last_name); ?>
                </p>
            <?php } ?>
            <?php if ($email !== ''){ ?>
                <p>
                    <span><?php esc_html_e( 'Email', 'eltd-membership' ); ?></span>
                    <?php echo esc_attr($email); ?>
                </p>
            <?php } ?>
            <?php if ($website !== ''){ ?>
                <p>
                    <span><?php esc_html_e( 'Website', 'eltd-membership' ); ?></span>
                    <a href="<?php echo esc_url( $website ); ?>" target="_blank"><?php echo esc_attr($website); ?></a>
                </p>
            <?php } ?>
            <?php if ($description !== ''){ ?>
                <p class="eltd-membership-desc">
                    <span><?php esc_html_e( 'Description', 'eltd-membership' ); ?></span>
                    <?php echo esc_attr($description); ?>
                </p>
            <?php } ?>
        </div>
	</div>
</div>
