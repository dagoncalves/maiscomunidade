<?php
$cats_obj = eltd_listing_get_listing_cats();
$cats_array = $cats_obj['key_value'];

$selected_cat  = '';
if(isset($_GET['eltd-ls-main-search-listing-cat'])){
	$selected_cat = $_GET['eltd-ls-main-search-listing-cat'];
}elseif(is_tax( 'job_listing_category' )){
	$selected_cat = get_queried_object_id();
}

if( (is_tax() && is_tax('job_listing_category')) || isset($_GET['eltd-ls-main-search-listing-cat']) ) {
?>
<div class="eltd-ls-archive-filter-item">

	<div class="eltd-archive-filter-icon">
		<?php echo findme_elated_icon_collections()->renderIcon( 'icon_globe-2', 'font_elegant' );?>
	</div>

	<select name="eltd-archive-cat-search" class="eltd-listing-search-input eltd-archive-cat-search">
		<option value="all"><?php esc_html_e('All Categories', 'eltd-listing');?></option>
		<?php foreach($cats_array as $cat_key => $cat_value){
			$selected = '';

			if($cat_key == $selected_cat){
				$selected = 'selected';
			}

			if($cat_key !== ''){ ?>
				<option value="<?php echo esc_attr($cat_key); ?>" <?php echo esc_attr($selected) ?>>
					<?php echo esc_attr($cat_value); ?>
				</option>
			<?php } ?>

		<?php } ?>
	</select>
</div>
<?php }