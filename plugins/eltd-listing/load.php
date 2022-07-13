<?php
if(eltd_listing_is_wp_job_manager_installed()){
	require_once 'lib/shortcodes/shortcode-interface.php';
	require_once 'lib/listing-core-functions.php';
	require_once 'lib/listing-core-classes.php';
	require_once 'lib/listing-global-settings.php';
	require_once 'lib/listing-field-creator.php';
	require_once 'lib/custom-field-creator.php';
	require_once 'lib/front-end-field-creator.php';
	require_once 'lib/listing-repeater-field-functions.php';
	require_once 'lib/related-post.php';
	require_once 'dashboard/dashboard-functions.php';
	require_once 'maps/map-functions.php';
	require_once 'maps/map-classes.php';
	require_once 'helpers/listing-helper-functions.php';
	require_once 'helpers/helper-functions.php';
	require_once 'helpers/listing-review-functions.php';
	require_once 'helpers/listing-ajax-helper-functions.php';
	require_once 'helpers/taxonomy-meta-fields.php';
	require_once 'helpers/update-functions.php';
	require_once 'meta-box/map.php';
	require_once 'options-map/map.php';
	require_once 'single/functions.php';
	require_once 'archive/functions.php';
	require_once 'archive/classes.php';
    require_once 'widgets/helper.php';
    require_once 'widgets/listing_widget.php';
    require_once 'templates/functions.php';
}