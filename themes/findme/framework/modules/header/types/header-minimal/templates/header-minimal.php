<?php do_action('findme_elated_before_page_header'); ?>

<header class="eltd-page-header">
	<?php do_action('findme_elated_after_page_header_html_open'); ?>
	
	<?php if($show_fixed_wrapper) : ?>
		<div class="eltd-fixed-wrapper">
	<?php endif; ?>
			
	<div class="eltd-menu-area">
		<?php do_action('findme_elated_after_header_menu_area_html_open'); ?>
		
		<?php if($menu_area_in_grid) : ?>
			<div class="eltd-grid">
		<?php endif; ?>
				
			<div class="eltd-vertical-align-containers">
				<div class="eltd-position-left">
					<div class="eltd-position-left-inner">
						<?php if(!$hide_logo) {
							findme_elated_get_logo();
						} ?>
					</div>
				</div>
				<div class="eltd-position-right">
					<div class="eltd-position-right-inner">
						<a href="javascript:void(0)" class="eltd-fullscreen-menu-opener">
							<span class="eltd-fm-lines">
								<span class="eltd-fm-line eltd-line-1"></span>
								<span class="eltd-fm-line eltd-line-2"></span>
								<span class="eltd-fm-line eltd-line-3"></span>
							</span>
						</a>
					</div>
				</div>
			</div>
				
		<?php if($menu_area_in_grid) : ?>
			</div>
		<?php endif; ?>
	</div>
			
	<?php if($show_fixed_wrapper) { ?>
		</div>
	<?php } ?>
	
	<?php if($show_sticky) {
		findme_elated_get_sticky_header('minimal', 'header/types/header-minimal');
	} ?>
	
	<?php do_action('findme_elated_before_page_header_html_close'); ?>
</header>

<?php do_action('findme_elated_after_page_header'); ?>