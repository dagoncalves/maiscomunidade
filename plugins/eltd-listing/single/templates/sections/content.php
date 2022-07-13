<div class="eltd-ls-single-section eltd-ls-single-content eltd-grid clearfix">

	<div class="eltd-ls-single-section-inner left">
		<?php
            echo eltd_listing_single_template_part('parts/content');
            echo eltd_listing_single_template_part('parts/amenities');
            echo eltd_listing_single_template_part('parts/tags', '', $params);
            echo eltd_listing_single_template_part('parts/video', '', $params);
            echo eltd_listing_single_template_part('parts/comments');
        ?>
	</div>

	<div class="eltd-ls-single-section-inner right">
		<?php
            echo eltd_listing_single_template_part('parts/map', '', $params);
//            echo eltd_listing_single_template_part('parts/views', '', $params);
            echo eltd_listing_single_template_part('parts/booking', '', $params);
            echo eltd_listing_single_template_part('parts/enquiry', '', $params);
		?>
	</div>

</div>