<?php

if(!function_exists('findme_elated_footer_top_general_styles')) {
    /**
     * Generates general custom styles for footer top area
     */
    function findme_elated_footer_top_general_styles() {
        $item_styles = array();
        $background_color = findme_elated_options()->getOptionValue('footer_top_background_color');

        if(!empty($background_color)) {
            $item_styles['background-color'] = $background_color;
        }

        echo findme_elated_dynamic_css('footer.eltd-page-footer .eltd-footer-top-holder', $item_styles);
    }

    add_action('findme_elated_style_dynamic', 'findme_elated_footer_top_general_styles');
}

if(!function_exists('findme_elated_footer_bottom_general_styles')) {
    /**
     * Generates general custom styles for footer bottom area
     */
    function findme_elated_footer_bottom_general_styles() {
        $item_styles = array();
	    $background_color = findme_elated_options()->getOptionValue('footer_bottom_background_color');
	
	    if(!empty($background_color)) {
		    $item_styles['background-color'] = $background_color;
	    }

        echo findme_elated_dynamic_css('footer.eltd-page-footer .eltd-footer-bottom-holder', $item_styles);
    }

    add_action('findme_elated_style_dynamic', 'findme_elated_footer_bottom_general_styles');
}