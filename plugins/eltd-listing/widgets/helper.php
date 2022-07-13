<?php
if(!function_exists('eltd_listing_register_widget')){
    
    function eltd_listing_register_widget(){
        
        register_widget('ElatedListingWidget');
        
    }
    
    add_action('widgets_init', 'eltd_listing_register_widget');
    
}

if(!function_exists('eltd_register_listing_single_widget_bottom_area')){


    function eltd_register_listing_single_widget_bottom_area(){


        register_sidebar(
            array(
                'name'          => esc_html__('Listing Single Bottom Area', 'eltd-listing'),
                'id'            => 'eltd-lst-single-widget-bottom-area',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltd-lst-single-widget-bottom-area">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the bottom of listing single pages', 'eltd-listing')
            )
        );

    }

    add_action('widgets_init', 'eltd_register_listing_single_widget_bottom_area');

}