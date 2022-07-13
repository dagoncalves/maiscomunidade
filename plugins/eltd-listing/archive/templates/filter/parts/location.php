<?php

$regions = eltd_listing_get_listing_region(false);
$regions_array = $regions['key_value'];

$selected_region  = '';
if(isset($_GET['eltd-ls-main-search-listing-region'])){
	$selected_region = $_GET['eltd-ls-main-search-listing-region'];
}elseif(is_tax( 'job_listing_region' )){
	$selected_region = get_queried_object_id();
}

if(findme_elated_is_wp_job_manager_locations_installed()){ ?>

	<div class="eltd-ls-archive-filter-item">

		<div class="eltd-archive-filter-icon">
			<?php echo findme_elated_icon_collections()->renderIcon( 'icon_briefcase', 'font_elegant' );?>
		</div>

		<select name="eltd-archive-region-search" class="eltd-listing-search-input eltd-archive-region-search">
			<option value="all">
                <?php esc_html_e('All Locations', 'eltd-listing');?>
            </option>

			<?php foreach($regions_array as $region_key => $region_value){
				$selected = '';

				if($region_key == $selected_region){
					$selected = 'selected';
				}

				if($type_key !== ''){ ?>
					<option value="<?php echo esc_attr($region_key); ?>" <?php echo esc_attr($selected) ?>>
						<?php echo esc_attr($region_value); ?>
					</option>
				<?php } ?>

			<?php } ?>

		</select>
	</div>

<?php } ?>