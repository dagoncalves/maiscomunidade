<?php
if($show_header_top) {
	do_action('findme_elated_before_header_top');
	?>
	
	<?php if($show_header_top_background_div){ ?>
		<div class="eltd-top-bar-background"></div>
	<?php } ?>
	
	<div class="eltd-top-bar">
		<?php do_action( 'findme_elated_after_header_top_html_open' ); ?>
		
		<?php if($top_bar_in_grid) : ?>
			<div class="eltd-grid">
		<?php endif; ?>
				
			<div class="eltd-vertical-align-containers">
				<div class="eltd-position-left">
					<div class="eltd-position-left-inner">
						<?php if(is_active_sidebar('eltd-top-bar-left')) : ?>
							<?php dynamic_sidebar('eltd-top-bar-left'); ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="eltd-position-right">
					<div class="eltd-position-right-inner">
						<?php if(is_active_sidebar('eltd-top-bar-right')) : ?>
							<?php dynamic_sidebar('eltd-top-bar-right'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
				
		<?php if($top_bar_in_grid) : ?>
			</div>
		<?php endif; ?>
		
		<?php do_action( 'findme_elated_before_header_top_html_close' ); ?>
	</div>
	
	<?php do_action('findme_elated_after_header_top');
}