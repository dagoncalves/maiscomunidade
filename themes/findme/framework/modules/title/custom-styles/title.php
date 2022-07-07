<?php

if (!function_exists('findme_elated_title_area_typography_style')) {

    function findme_elated_title_area_typography_style(){

        // title default/small style
	    
	    $item_styles = findme_elated_get_typography_styles('page_title');
	
	    $item_selector = array(
		    '.eltd-title .eltd-title-holder .eltd-page-title'
	    );
	
	    echo findme_elated_dynamic_css($item_selector, $item_styles);
	
	    // subtitle style
	
	    $item_styles = findme_elated_get_typography_styles('page_subtitle');
	
	    $item_selector = array(
		    '.eltd-title .eltd-title-holder .eltd-subtitle'
	    );
	
	    echo findme_elated_dynamic_css($item_selector, $item_styles);
	
	    // breadcrumb style
	
	    $item_styles = findme_elated_get_typography_styles('page_breadcrumb');
	
	    $item_selector = array(
		    '.eltd-title .eltd-title-holder .eltd-breadcrumbs a',
		    '.eltd-title .eltd-title-holder .eltd-breadcrumbs span'
	    );
	
	    echo findme_elated_dynamic_css($item_selector, $item_styles);
	    

	    $breadcrumb_hover_color = findme_elated_options()->getOptionValue('page_breadcrumb_hovercolor');
	    
        $breadcrumb_hover_styles = array();
        if(!empty($breadcrumb_hover_color)) {
            $breadcrumb_hover_styles['color'] = $breadcrumb_hover_color;
        }

        $breadcrumb_hover_selector = array(
            '.eltd-title .eltd-title-holder .eltd-breadcrumbs a:hover'
        );

        echo findme_elated_dynamic_css($breadcrumb_hover_selector, $breadcrumb_hover_styles);
    }

    add_action('findme_elated_style_dynamic', 'findme_elated_title_area_typography_style');
}