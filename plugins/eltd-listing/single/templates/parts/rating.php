<?php
use ElatedListing\Lib\Core;
$rating_obj = new Core\ListingRating(get_the_ID(), false, 'get_average_rating' ); ?>

<div class="eltd-ratings-holder">
	<div class="eltd-current-rate">

        <span>
			<?php esc_html_e('Current rate is: ') ?>
		</span>

		<span class="eltd-rating-value">
			<?php echo esc_attr($rating_obj->getAverageRating()); ?>
		</span>

	</div>

	<div class="eltd-title-holder eltd-ratings-text-title">
		<h5 class="eltd-title-line-head">
            <?php esc_html_e('Rate This Article:', 'eltd-listing' ); ?>
        </h5>
	</div>

	<div class="eltd-ratings-stars-holder">
		<div class="eltd-ratings-stars-inner">
			<span id="eltd-rating-1" ></span>
			<span id="eltd-rating-2" ></span>
			<span id="eltd-rating-3" ></span>
			<span id="eltd-rating-4" ></span>
			<span id="eltd-rating-5" ></span>
		</div>
	</div>

	<div class="eltd-ratings-message-holder">
		<div class="eltd-rating-message"></div>
	</div>

</div>