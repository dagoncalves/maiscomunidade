<div class="eltd-login-register-holder">
    <div class="eltd-login-register-content">
        <ul class="eltd-login-button-wrapper">
            <li class="eltd-login-reg-btn"><a href="#eltd-register-content"><?php esc_html_e('Sign Up Now', 'eltd-membership'); ?></a></li>
            <li class="eltd-login-login-btn"><a href="#eltd-login-content"><?php esc_html_e('Log In Now', 'eltd-membership'); ?></a></li>
        </ul>
        <div class="eltd-login-content-inner" id="eltd-login-content">
            <div
                class="eltd-wp-login-holder"><?php echo eltd_membership_execute_shortcode('eltd_user_login', array()); ?></div>
        </div>
        <div class="eltd-register-content-inner" id="eltd-register-content">
            <div
                class="eltd-wp-register-holder"><?php echo eltd_membership_execute_shortcode('eltd_user_register', array()) ?></div>
        </div>
    </div>
</div>
