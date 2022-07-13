<?php
$this_object = eltd_listing_main_search_class_instance();
$classes = $this_object->getBasicParamByKey('holder_classes');
$first_color = findme_elated_get_first_main_color();

$button_params = array(
	'text' =>  esc_html__('Search places', 'eltd-listing'),
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

		<div class="eltd-ls-main-search-holder-part type1">

			<div class="eltd-ls-input-icon">
				<div class="eltd-ls-search-icon">
					<?php echo findme_elated_icon_collections()->renderIcon( 'icon_search', 'font_elegant' ); ?>
				</div>
				<input type="text" class="eltd-ls-main-search-keyword" name="eltd-ls-main-search-keyword" placeholder="<?php echo esc_html_e('Search by keyword', 'eltd-listing'); ?>">
			</div>

			<div class="eltd-ls-main-search-holder-button">

				<?php echo findme_elated_get_button_html($button_params); ?>

			</div>

		</div>
	</div>
</form>