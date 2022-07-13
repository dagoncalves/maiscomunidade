<?php
$this_object = eltd_listing_adv_search_class_instance();

$enable_map = $this_object->getBasicParamByKey('enable_map') === 'yes' ? true : false;
$map_in_grid = $this_object->getBasicParamByKey('map_in_grid') === 'yes' ? true : false;
$grid_class = '';
if($map_in_grid){
    $grid_class = 'eltd-grid';
}

$keyword_flag = $this_object->getBasicParamByKey('keyword_search') === 'yes' ? true : false ;

if($enable_map){ ?>
<div class="eltd-ls-adv-search-map-holder <?php echo esc_attr($grid_class); ?> ">
	    <?php
		echo eltd_listing_get_listing_multiple_map();
		if($keyword_flag){
		    echo eltd_listing_get_shortcode_module_template_part('templates/keyword', 'listing-advanced-search');
		}
	    ?>
    </div>
<?php }