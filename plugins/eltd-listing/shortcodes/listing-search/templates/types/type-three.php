<?php
$this_object = eltd_listing_main_search_class_instance();
$types_array = $this_object->getListingTypes();
$classes = $this_object->getBasicParamByKey('holder_classes');
$region_array = $this_object->getListingRegions();
$category_array = $this_object->getListingCategories();
$first_color = findme_elated_get_first_main_color();

$button_params = array(
	'text' =>  esc_html__('Search places', 'eltd-listing'),
	'html_type' => 'button',
	'type' => 'solid',
	'size'  => 'large',
	'font_size' => '18',
	'hover_color'            => $first_color,
	'background_color'       => $first_color,
	'hover_background_color' => 'transparent',
	'border_color'           => $first_color,
	'hover_border_color'     => $first_color,
	'icon_pack' => 'font_elegant',
	'fe_icon'   => 'arrow_carrot-right'
);
?>

<form method="get" action="<?php echo esc_url(get_post_type_archive_link( 'job_listing' )); ?>">
	<div class="eltd-ls-main-search-holder clearfix <?php echo esc_attr($classes); ?>">

		<div class="eltd-ls-main-search-holder-part type3">

			<div class="eltd-ls-main-search-holder-inner">
				<div class="eltd-ls-input-icon">
					<div class="eltd-ls-search-icon">
						<?php echo findme_elated_icon_collections()->renderIcon( 'icon_search', 'font_elegant' ); ?>
					</div>
					<input type="text" class="eltd-ls-main-search-keyword" name="eltd-ls-main-search-keyword" placeholder="<?php echo esc_html_e('Keywords', 'eltd-listing'); ?>">
				</div>
			</div>
			<div class="eltd-ls-main-search-holder-inner">
				<select name="eltd-ls-main-search-listing-region" data-placeholder="<?php esc_html_e('All Locations','eltd-listing') ?>" data-allow-clear="true" data-minimum-results-for-search="5">

					<option value="all">
						<?php esc_html_e('Choose a Location', 'eltd-listing')?>
					</option>

					<?php foreach($region_array as $region_key => $region_value){

						if($region_key !== ''){ ?>
							<option value="<?php echo esc_attr($region_key) ?>">
								<?php echo esc_attr($region_value); ?>
							</option>
						<?php }

					} ?>

				</select>
			</div>
			<div class="eltd-ls-main-search-holder-inner">
				<select name="eltd-ls-main-search-listing-cat" data-placeholder="<?php esc_html_e('All Categories','eltd-listing') ?>" data-allow-clear="true" data-minimum-results-for-search="5">

					<option value="all">
						<?php esc_html_e('All categories', 'eltd-listing')?>
					</option>

					<?php foreach($category_array as $category_key => $category_value){

						if($category_key !== ''){ ?>
							<option value="<?php echo esc_attr($category_key) ?>">
								<?php echo esc_attr($category_value); ?>
							</option>
						<?php }

					} ?>

				</select>
			</div>
			<div class="eltd-ls-main-search-holder-inner">
				<div class="eltd-ls-main-search-holder-button"   >

					<?php echo findme_elated_get_button_html($button_params); ?>

				</div>
			</div>

		</div>
	</div>
</form>