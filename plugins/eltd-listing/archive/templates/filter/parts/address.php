<div class="eltd-ls-archive-filter-item eltd-listing-places-search-holder eltd-full-width-item">

    <div class="eltd-listing-address-holder">

        <div class="eltd-archive-current-location">
			<?php
			    echo findme_elated_icon_collections()->renderIcon( 'icon_pushpin_alt', 'font_elegant');
			?>
		</div>

		<input type="text" id="eltd-archive-places-search" class="eltd-archive-places-search" name="eltd-listing-places-search" placeholder="<?php esc_html_e('Enter Address', 'eltd-listing'); ?>">
	</div>

	<div class="eltd-listing-radius-field">

		<div class="eltd-listing-places-dist-holder">

			<div class="eltd-rangle-slider-response-holder">
                <h5 class="eltd-rangle-slider-response-wrapper">
                    <?php esc_html_e('Choose km radius: ', 'eltd-listing'); ?>
                    <span class="eltd-rangle-slider-response">0</span>
                </h5>
			</div>
			<input	class="eltd-rangle-slider" type="range" min="0" max="100" step="1" value="0" data-orientation="horizontal" data-rangeslider>

			<div class="eltd-listing-places-range eltd-listing-places-min">
				<?php esc_html_e('0km', 'eltd-listing') ?>
			</div>
			<div class="eltd-listing-places-range eltd-listing-places-max">
				<?php esc_html_e('100km', 'eltd-listing') ?>
			</div>
		</div>
	</div>

</div>