<?php
$ratingCount = findme_elated_check_listing_item_rating();
if($ratingCount > 0) {
	$sort_params = array(
		'date-desc'   => esc_html__('Date Desc', 'eltd-listing'),
		'date-asc'    => esc_html__('Date Asc', 'eltd-listing'),
		'name-desc'   => esc_html__('Name Desc', 'eltd-listing'),
		'name-asc'    => esc_html__('Name Asc', 'eltd-listing'),
		'rating-desc' => esc_html__('Rating Desc', 'eltd-listing'),
		'rating-asc'  => esc_html__('Rating Asc', 'eltd-listing')
	);
}
else{
	$sort_params = array(
		'date-desc'   => esc_html__('Date Desc', 'eltd-listing'),
		'date-asc'    => esc_html__('Date Asc', 'eltd-listing'),
		'name-desc'   => esc_html__('Name Desc', 'eltd-listing'),
		'name-asc'    => esc_html__('Name Asc', 'eltd-listing')
	);
}
?>

<div class="eltd-ls-archive-filter-item eltd-full-width-item eltd-results-holder">
	<!--		this is holder where goes current number of items(added via js) -->
	<div class="eltd-archive-section eltd-ls-archive-items-number left">
		<h6 class="eltd-ls-archive-item-title">
			<span class="eltd-count"></span>
			<span class="eltd-text">
                        <?php esc_html_e(' Results Found','eltd-listing');?>
                </span>
		</h6>
	</div>

	<div class="eltd-ls-archive-sort-holder eltd-archive-section right">

		<div class="eltd-ls-archive-inner-section left">
			<p>
				<?php esc_html_e('Sort by', 'eltd-listing'); ?>
			</p>
		</div>

		<div class="eltd-ls-archive-inner-section right">

			<div class="eltd-ls-inner-section">
				<select class="eltd-ls-archive-sort" name="eltd-ls-archive-sort"  data-placeholder="<?php esc_html_e('Sort', 'eltd-listing'); ?>" data-allow-clear="true">
					<?php foreach($sort_params as $option_key => $option_value){ ?>

						<option value="<?php echo esc_attr($option_key)?>" >
							<?php echo esc_attr($option_value); ?>
						</option>

					<?php } ?>
				</select>
			</div>
		</div>
	</div>
</div>
