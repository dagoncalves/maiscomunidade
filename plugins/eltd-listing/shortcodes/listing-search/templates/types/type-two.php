<?php
$this_object = eltd_listing_main_search_class_instance();
$types_array = $this_object->getListingTypes();
$classes = $this_object->getBasicParamByKey('holder_classes');
$region_array = $this_object->getListingRegions();
$category_array = $this_object->getListingCategories();
$first_color = findme_elated_get_first_main_color();

$button_params = array(
	'text' => esc_html__('Search places', 'eltd-listing'),
	'html_type' => 'button',
	'type' => 'solid',
	'size'  => 'large',
	'font_size' => '18',
	'background_color'       => $first_color,
	'border_color'           => $first_color,
	'hover_background_color' => 'transparent',
	'hover_color'            => '#fff',
	'hover_border_color'     => '#fff',
	'icon_pack' => 'font_elegant',
	'fe_icon'   => 'arrow_carrot-right'
);
?>

<form method="get" action="<?php echo esc_url(get_post_type_archive_link( 'job_listing' )); ?>">
	<div class="eltd-ls-main-search-holder clearfix <?php echo esc_attr($classes); ?>">

		<div class="eltd-ls-main-search-holder-part type2">

			<div class="eltd-ls-main-search-holder-inner">
				<select name="eltd-ls-main-search-listing-type" data-placeholder="<?php esc_html_e('All categories','eltd-listing') ?>" data-allow-clear="true" data-minimum-results-for-search="5">

					<option value="all">
						<?php esc_html_e('Choose a category', 'eltd-listing');?>
					</option>
					<?php foreach($types_array as $type_key => $type_value){

						if($type_key !== ''){?>
							<option value="<?php echo esc_attr($type_key) ?>">
								<?php echo esc_attr($type_value); ?>
							</option>
						<?php }

					} ?>
				</select>
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
				<div class="eltd-ls-slider-wrapper eltd-listing-price-holder">

                        <span class="eltd-price-slider-text">
                            <?php echo esc_html_e('Price range', 'eltd-listing')?>
                        </span>

					<div class="eltd-price-slider-holder">
                            <span class="eltd-price-slider-response">
                                <?php esc_html_e('$0', 'eltd-listing'); ?>
                            </span>
						<input class="eltd-price-slider" type="range" min="0" max="100000" step="10" value="0" data-orientation="horizontal" data-rangeslider>
						<input type="hidden" name="eltd-ls-main-search-price-max" class="eltd-price-slider-value" value="">
					</div>
				</div>
			</div>
			<div class="eltd-ls-main-search-holder-inner">
				<div class="eltd-ls-main-search-holder-button">

					<?php echo findme_elated_get_button_html($button_params); ?>

				</div>
			</div>

		</div>
	</div>
</form>