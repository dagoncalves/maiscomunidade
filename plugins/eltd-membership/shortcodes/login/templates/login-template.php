<div class="eltd-social-login-holder">
	<div class="eltd-social-login-holder-inner">

	    <form method="post" class="eltd-login-form">
	        <?php
	        $redirect = '';
	        if(isset($_GET['redirect_uri'])) {
	            $redirect = $_GET['redirect_uri'];
	        } ?>
	        <fieldset>
	            <div>
	                <input type="text" name="user_login_name" id="user_login_name"
	                    placeholder="<?php esc_html_e('User Name*', 'eltd-membership') ?>" value="" required
	                    pattern=".{3,}"
	                    title="<?php esc_html_e('Three or more characters', 'eltd-membership'); ?>"/>
	            </div>
	            <div>
	                <input type="password" name="user_login_password" id="user_login_password"
	                    placeholder="<?php esc_html_e('Password*', 'eltd-membership') ?>" value="" required/>
	            </div>
	            <div class="eltd-lost-pass-remember-holder clearfix">
				<span class="eltd-login-remember">
					<input name="rememberme" value="forever" id="rememberme" type="checkbox"/>
					<label for="rememberme"
	                    class="eltd-checbox-label"><?php esc_html_e('Remember me', 'eltd-membership') ?></label>
				<a href="<?php echo wp_lostpassword_url(); ?>" class="eltd-login-action-btn"
	                data-el="#eltd-reset-pass-content"
	                data-title="<?php esc_html_e('Lost Password?', 'eltd-membership'); ?>"><?php esc_html_e('Forgot Your Password?', 'eltd-membership'); ?></a>
				</span>
	            </div>
	            <input type="hidden" name="redirect" id="redirect" value="<?php echo esc_url($redirect); ?>">

	            <div class="eltd-login-button-holder">
	                <?php
	                if(eltd_membership_theme_installed()) {
	                    echo findme_elated_get_button_html(array(
	                        'html_type' => 'button',
	                        'text'      => esc_html__('Login', 'eltd-membership'),
	                        'type'      => 'solid',
                            'fullwidth' => 'yes'
	                    ));
	                } else {
	                    echo '<button type="submit">'.esc_html__('Sign in', 'eltd-membership').'</button>';
	                }
	                wp_nonce_field('eltd-ajax-login-nonce', 'eltd-login-security'); ?>
	            </div>
	        </fieldset>
	    </form>
	</div>
    <?php
    if(eltd_membership_theme_installed()) {
        //if social login enabled add social networks login
        $social_login_enabled = findme_elated_options()->getOptionValue('enable_social_login') == 'yes' ? true : false;
        if($social_login_enabled) { ?>
            <div class="eltd-login-form-social-login">
                <div
                    class="eltd-login-social-title"><?php esc_html_e('Or Connect with Social Networks', 'eltd-membership'); ?></div>
                <?php
                do_action('eltd_membership_social_network_login');
                ?>
            </div>
        <?php }
    }
    do_action('eltd_membership_action_login_ajax_response');
    ?>
</div>