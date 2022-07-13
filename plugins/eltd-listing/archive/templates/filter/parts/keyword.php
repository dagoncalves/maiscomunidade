<?php
$keyword  = '';
if(isset($_GET['eltd-ls-main-search-keyword'])){
	$keyword = $_GET['eltd-ls-main-search-keyword'];
}
?>
<div class="eltd-ls-archive-filter-item">

	<div class="eltd-archive-filter-icon">
		<?php echo findme_elated_icon_collections()->renderIcon( 'icon_key_alt', 'font_elegant' );?>
	</div>

	<input type="text" name="eltd-archive-keyword-search"
	       class="eltd-listing-search-input eltd-archive-keyword-search"
	       placeholder = "<?php esc_html_e('Keywords', 'eltd-listing');?>"
	       value="<?php echo esc_attr($keyword) ?>" />
</div>