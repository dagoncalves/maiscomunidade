<?php do_action('findme_elated_before_page_header'); ?>

<header class="eltd-page-header">
	<?php do_action('findme_elated_after_page_header_html_open'); ?>
	
	<?php if($show_fixed_wrapper) : ?>
		<div class="eltd-fixed-wrapper">
	<?php endif; ?>
		
	<div class="eltd-menu-area">
		<?php do_action('findme_elated_after_header_menu_area_html_open'); ?>
		
        <div class="eltd-vertical-align-containers">
            <div class="eltd-position-left">
                <div class="eltd-position-left-inner">
                    <?php if(!$hide_logo) {
                        findme_elated_get_logo();
                    } ?>
                </div>
            </div>
            <div class="eltd-position-center">
                <div class="eltd-position-center-inner">
                    <?php findme_elated_get_main_menu(); ?>
                </div>
            </div>
            <div class="eltd-position-right">
                <div class="eltd-position-right-inner">
					<?php findme_elated_get_header_widget_menu_area(); ?>
                </div>
            </div>
        </div>
	</div>
		
	<?php if($show_fixed_wrapper) { ?>
		</div>
	<?php } ?>
	
	<?php if($show_sticky) {
		findme_elated_get_sticky_header();
	} ?>
	
	<?php do_action('findme_elated_before_page_header_html_close'); ?>
</header>

<?php do_action('findme_elated_after_page_header'); ?>