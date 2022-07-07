<form action="<?php echo esc_url(home_url('/')); ?>" class="eltd-search-cover" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="eltd-container">
		<div class="eltd-container-inner clearfix">
			<?php } ?>
			<div class="eltd-form-holder-outer">
				<div class="eltd-form-holder">
					<div class="eltd-form-holder-inner">
						<input type="text" placeholder="<?php esc_attr_e('Search', 'findme'); ?>" name="s" class="eltd_search_field" autocomplete="off" />
						<div class="eltd-search-close">
							<a href="#">
								<?php
                                echo wp_kses($search_icon_close, array(
									'span' => array(
										'aria-hidden' => true,
										'class' => true
									),
									'i' => array(
										'class' => true
									)
								)); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
			<?php if ( $search_in_grid ) { ?>
		</div>
	</div>
	<?php } ?>
</form>