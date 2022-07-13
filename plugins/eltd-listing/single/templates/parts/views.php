<?php
use ElatedListing\Lib\Core;

$views_obj = new Core\ListingViews(get_the_ID());
$view_count = $views_obj->getViewCount();

?>
<div class="eltd-ls-item-view-holder">
	<div class="eltd-ls-item-view-icon">
		<?php echo findme_elated_icon_collections()->renderIcon('fa-eye', 'font_awesome'); ?>
	</div>
	<div class="eltd-ls-item-view-text">
		<span class="eltd-ls-view-count">
			<?php echo esc_attr($view_count)?>
		</span>
		<span class="eltd-ls-view-text-inner">
			<?php esc_attr_e('Views', 'eltd-listing');?>
		</span>
	</div>
</div>