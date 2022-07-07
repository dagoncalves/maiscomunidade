<?php
if (!function_exists('findme_elated_register_side_area_sidebar')) {
    /**
     * Register side area sidebar
     */
    function findme_elated_register_side_area_sidebar() {

        register_sidebar(array(
            'name' => esc_html__('Side Area', 'findme'),
            'id' => 'sidearea', //TODO Change name of sidebar
            'description' => esc_html__('Side Area', 'findme'),
            'before_widget' => '<div id="%1$s" class="widget eltd-sidearea %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="eltd-widget-title-holder"><h4 class="eltd-widget-title">',
            'after_title' => '</h4></div>'
        ));
    }

    add_action('widgets_init', 'findme_elated_register_side_area_sidebar');
}

if (!function_exists('findme_elated_side_menu_body_class')) {
    /**
     * Function that adds body classes for different side menu styles
     *
     * @param $classes array original array of body classes
     *
     * @return array modified array of classes
     */
    function findme_elated_side_menu_body_class($classes) {

        if (is_active_widget(false, false, 'eltd_side_area_opener')) {

            $classes[] = 'eltd-side-menu-slide-from-right';
        }

        return $classes;
    }

    add_filter('body_class', 'findme_elated_side_menu_body_class');
}

if (!function_exists('findme_elated_get_side_area')) {
    /**
     * Loads side area HTML
     */
    function findme_elated_get_side_area() {

        if (is_active_widget(false, false, 'eltd_side_area_opener')) {

            findme_elated_get_module_template_part('templates/sidearea', 'sidearea');
        }
    }
	
	add_action('findme_elated_after_body_tag', 'findme_elated_get_side_area', 10);
}

