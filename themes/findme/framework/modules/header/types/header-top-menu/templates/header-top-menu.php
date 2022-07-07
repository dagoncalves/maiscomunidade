<?php do_action('findme_elated_before_page_header'); ?>

<header class="eltd-page-header">
	<?php do_action('findme_elated_after_page_header_html_open'); ?>
	
	<div class="eltd-menu-area">
		<?php do_action('findme_elated_after_header_menu_area_html_open'); ?>
		
		<?php if($menu_area_in_grid) : ?>
			<div class="eltd-grid">
		<?php endif; ?>
				
			<div class="eltd-vertical-align-containers">
				<div class="eltd-position-left">
					<div class="eltd-position-left-inner">
						<?php findme_elated_get_main_menu(); ?>
					</div>
				</div>
				<div class="eltd-position-right">
					<div class="eltd-position-right-inner">
						<?php findme_elated_get_header_widget_menu_area(); ?>
					</div>
				</div>
			</div>
				
		<?php if($menu_area_in_grid) : ?>
			</div>
		<?php endif; ?>
	</div>
	
	<div class="eltd-logo-area">
        <?php if($logo_area_in_grid) : ?>
            <div class="eltd-grid">
        <?php endif; ?>
	            
            <div class="eltd-vertical-align-containers">
                <div class="eltd-position-center">
                    <div class="eltd-position-center-inner">
                        <?php if(!$hide_logo) {
                            findme_elated_get_logo();
                        } ?>
                    </div>
                </div>
            </div>
	            
        <?php if($logo_area_in_grid) : ?>
            </div>
        <?php endif; ?>
    </div>
	
	<?php do_action('findme_elated_before_page_header_html_close'); ?>
</header>

<?php do_action('findme_elated_after_page_header'); ?>