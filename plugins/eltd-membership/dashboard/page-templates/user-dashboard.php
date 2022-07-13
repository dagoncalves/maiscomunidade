<?php
get_header();
if ( eltd_membership_theme_installed() ) {
	findme_elated_get_title();
} else { ?>
	<div class="eltd-membership-title">
		<?php the_title( '<h1>', '</h1>' ); ?>
	</div>
<?php }
?>
	<div class="eltd-container">
		<?php do_action( 'findme_elated_after_container_open' ); ?>
		<div class="eltd-container-inner clearfix">
			<?php if ( is_user_logged_in() ) { ?>
				<div class="eltd-membership-dashboard-nav-holder clearfix">
					<?php
					//Include dashboard navigation
					echo eltd_membership_get_dashboard_template_part( 'navigation' );
					?>
				</div>
				<div class="eltd-membership-dashboard-content-holder">
					<?php echo eltd_membership_get_dashboard_pages(); ?>
				</div>
			<?php } else { ?>
				<div class="eltd-login-register-content">
					<ul class="eltd-login-button-wrapper">
						<li class="eltd-login-reg-btn">
							<a href="#eltd-login-content"><?php esc_html_e( 'Login', 'eltd-membership' ); ?></a>
						</li>
						<li class="eltd-login-reg-btn">
							<a href="#eltd-register-content"><?php esc_html_e( 'Register', 'eltd-membership' ); ?></a>
						</li>
					</ul>
					<div class="eltd-login-content-inner" id="eltd-login-content">
						<div
							class="eltd-wp-login-holder"><?php echo eltd_membership_execute_shortcode( 'eltd_user_login', array() ); ?>
						</div>
					</div>
					<div class="eltd-register-content-inner" id="eltd-register-content">
						<div
							class="eltd-wp-register-holder"><?php echo eltd_membership_execute_shortcode( 'eltd_user_register', array() ) ?>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php do_action( 'findme_elated_before_container_close' ); ?>
	</div>
<?php get_footer(); ?>