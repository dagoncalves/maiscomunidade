<?php
$this_object = eltd_listing_main_search_class_instance();
$type = $this_object->getBasicParamByKey('listing_search_type');
$wrapper_classes = $this_object->getBasicParamByKey('wrapper_classes');
$html = '';
?>

<div class="eltd-ls-main-search-wrapper <?php echo esc_attr($wrapper_classes); ?>">

    <?php
        echo eltd_listing_get_shortcode_module_template_part('templates/top-categories', 'listing-search');
        echo eltd_listing_get_shortcode_module_template_part('templates/types/type', 'listing-search', $type);
    ?>

</div>