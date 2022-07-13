<?php

class ElatedMembershipLoginRegister extends WP_Widget {
    protected $params;

    public function __construct() {
        parent::__construct(
            'eltd_login_register_widget', // Base ID
            esc_html__('Elated Login', 'eltd-membership'),
            array('description' => esc_html__('Login and register, connect with social networks', 'eltd-membership'),)
        );

        $this->setParams();
    }

    protected function setParams() {
        $this->params = array();
    }

    public function getParams() {
        return $this->params;
    }

    public function widget($args, $instance) {

        echo '<div class="widget eltd-login-register-widget">';
        if(!is_user_logged_in()) {
            if(eltd_membership_theme_installed()) {
                echo '<div class="eltd-login-holder">';
                echo '<a href="#" class="eltd-login-opener">'.findme_elated_icon_collections()->renderIcon('icon_profile', 'font_elegant').'</a>';
                echo '</div>';
            }
            add_action('wp_footer', array($this, 'eltd_membership_render_login_form'));

        } else {
            echo eltd_membership_get_widget_template_part('login-widget', 'login-widget-template');
        }
        echo '</div>';

    }

    public function eltd_membership_render_login_form() {

        //Render modal with login and register forms
        echo eltd_membership_get_widget_template_part('login-widget', 'login-modal-template');

    }
}

function eltd_membership_login_widget_load() {
    register_widget('ElatedMembershipLoginRegister');
}

add_action('widgets_init', 'eltd_membership_login_widget_load');