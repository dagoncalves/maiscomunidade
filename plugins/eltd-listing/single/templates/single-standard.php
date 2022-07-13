<article class="eltd-ls-single-item" id="<?php echo get_the_ID();?>">
	<?php
        echo eltd_listing_single_template_part('sections/header-top', '', $params);
        echo eltd_listing_single_template_part('sections/header', '', $params);
        echo eltd_listing_single_template_part('sections/content', '', $params);
        echo eltd_listing_single_template_part('sections/footer', '', $params);
        echo eltd_listing_single_template_part('sections/content-bottom', '', $params);
	?>
</article>
