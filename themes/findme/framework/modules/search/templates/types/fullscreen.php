<div class="eltd-fullscreen-search-holder">
	<div class="eltd-fullscreen-search-close-container">
		<div class="eltd-search-close-holder">
			<a class="eltd-fullscreen-search-close" href="javascript:void(0)">
				<span class="icon-arrows-remove"></span>
			</a>
		</div>
	</div>
	<div class="eltd-fullscreen-search-table">
		<div class="eltd-fullscreen-search-cell">
			<div class="eltd-fullscreen-search-inner">
				<form action="<?php echo esc_url(home_url('/')); ?>" class="eltd-fullscreen-search-form" method="get">
					<div class="eltd-form-holder">
						<div class="eltd-form-holder-inner">
							<div class="eltd-field-holder">
								<input type="text"  placeholder="<?php esc_attr_e('Search for...', 'findme'); ?>" name="s" class="eltd-search-field" autocomplete="off" />
							</div>
							<button type="submit" class="eltd-search-submit"><span class="icon_search "></span></button>
							<div class="eltd-line"></div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>