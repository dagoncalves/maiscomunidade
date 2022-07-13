<div class="eltd-ls-single-header">
	<div class="eltd-ls-single-section-holder top">
		<div class="eltd-ls-single-section eltd-grid clearfix">
			<div class="eltd-ls-single-section-inner  left">
				<div class="eltd-ls-single-part-holder right">

                    <div class="eltd-ls-single-part-inner top">
						<?php
                            echo eltd_listing_single_template_part('parts/title');
						    echo eltd_listing_single_template_part('parts/short-desc' , '', $params);
						?>
					</div>

					<div class="eltd-ls-single-part-inner bottom">
						<?php
							echo eltd_listing_single_template_part('parts/info/rating-stars', '', $params);
							echo eltd_listing_single_template_part('parts/info/like');
							echo eltd_listing_single_template_part('parts/info/share');
						?>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>