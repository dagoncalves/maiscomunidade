<?php do_action('findme_elated_before_page_header'); ?>

<aside class="eltd-vertical-menu-area <?php echo esc_html($holder_class); ?>">
    <div class="eltd-vertical-menu-area-inner">
		<a href="#" class="eltd-vertical-area-opener"><span class="eltd-vertical-area-opener-line"></span></a>
        <div class="eltd-vertical-area-background"></div>
        <?php if(!$hide_logo) {
			findme_elated_get_logo();
        } ?>
        <?php findme_elated_get_header_vertical_closed_main_menu(); ?>
        <div class="eltd-vertical-area-widget-holder">
			<?php findme_elated_get_header_vertical_closed_widget_areas(); ?>
        </div>
    </div>
</aside>
<div class="eltd-vertical-area-bottom-logo">
	<div class="eltd-vertical-area-bottom-logo-inner">
		<?php if(!$hide_logo) {
			findme_elated_get_logo();
		} ?>
	</div>
</div>

<?php do_action('findme_elated_after_page_header'); ?>