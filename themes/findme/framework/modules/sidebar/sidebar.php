<?php

if (!function_exists('findme_elated_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function findme_elated_register_sidebars() {

        register_sidebar(array(
            'name' => esc_html__('Sidebar', 'findme'),
            'id' => 'sidebar',
            'description' => esc_html__('Default Sidebar', 'findme'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="eltd-widget-title-holder"><h2 class="eltd-widget-title">',
            'after_title' => '</h2></div>'
        ));
    }

    add_action('widgets_init', 'findme_elated_register_sidebars', 1);
}

if (!function_exists('findme_elated_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates FindmeElatedSidebar object
     */
    function findme_elated_add_support_custom_sidebar() {
        add_theme_support('FindmeElatedSidebar');
        if (get_theme_support('FindmeElatedSidebar')) new FindmeElatedSidebar();
    }

    add_action('after_setup_theme', 'findme_elated_add_support_custom_sidebar');
}