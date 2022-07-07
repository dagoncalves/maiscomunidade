<?php do_action('findme_elated_before_page_header'); ?>

<aside class="eltd-vertical-menu-area eltd-with-scroll">
    <div class="eltd-vertical-menu-area-inner">
        <div class="eltd-vertical-area-background"></div>
        <?php if(!$hide_logo) {
            findme_elated_get_logo();
        } ?>
        <?php findme_elated_get_header_vertical_compact_main_menu(); ?>
        <div class="eltd-vertical-area-widget-holder">
			<?php findme_elated_get_header_vertical_compact_widget_areas(); ?>
        </div>
    </div>
</aside>

<?php do_action('findme_elated_after_page_header'); ?>