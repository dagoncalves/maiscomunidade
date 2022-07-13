<?php
$types_obj = eltd_listing_get_listing_types();
$types_array = $types_obj['key_value'];

$selected_type  = '';
if(isset($_GET['eltd-ls-main-search-listing-type'])){
	$selected_type = $_GET['eltd-ls-main-search-listing-type'];
}elseif(is_tax( 'job_listing_type' )){
	$selected_type = get_queried_object_id();
}

if( (is_tax() && is_tax('job_listing_type')) || isset($_GET['eltd-ls-main-search-listing-type']) ) {
?>
<div class="eltd-ls-archive-filter-item">

	<div class="eltd-archive-filter-icon">
		<?php echo findme_elated_icon_collections()->renderIcon( 'icon_globe-2', 'font_elegant' );?>
	</div>

	<select name="eltd-archive-type-search" class="eltd-listing-search-input eltd-archive-type-search">
		<option value="all"><?php esc_html_e('All Categories', 'eltd-listing');?></option>
		<?php foreach($types_array as $type_key => $type_value){
			$selected = '';

			if($type_key == $selected_type){
				$selected = 'selected';
			}

			if($type_key !== ''){ ?>
				<option value="<?php echo esc_attr($type_key); ?>" <?php echo esc_attr($selected) ?>>
					<?php echo esc_attr($type_value); ?>
				</option>
			<?php } ?>

		<?php } ?>
	</select>
</div>
<?php }