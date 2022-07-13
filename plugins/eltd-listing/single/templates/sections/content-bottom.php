<?php
$option = findme_elated_get_meta_field_intersect('listing_content_bottom');
$flag = $option === 'yes' ? true : false;
if($flag && is_active_sidebar('eltd-lst-single-widget-bottom-area')){

    dynamic_sidebar('eltd-lst-single-widget-bottom-area');

}