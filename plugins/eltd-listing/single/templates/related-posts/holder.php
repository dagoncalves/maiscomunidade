<?php
use ElatedListing\Lib\Core;
if($query){
	if($query->have_posts()){
		$extra_class = '';
		
        $data_params = array(
            'data-number-of-items' => '3',
            'data-enable-navigation' => 'yes',
            'data-enable-pagination' => 'yes',
            'data-enable-loop' => 'yes',
            'data-slider-animate-in' => 'fadeIn',
            'data-slider-animate-out' => 'fadeOut',
            'data-slider-speed-animation' => '600',
            'data-slider-speed' => '5000',
            'data-enable-autoplay' => 'yes',
            'data-slider-margin' => '36'
        );

        $slider_class = '';
        if($query->found_posts >= 4){
	        $slider_class = 'eltd-owl-slider';
        }
        else{
	        $slider_class = 'eltd-no-slider';
        }
		?>

		<div class="eltd-ls-single-related-posts-holder">

			<h4 class="eltd-ls-related-post-title">
				<?php esc_html_e('Similar Properties', 'eltd-listing'); ?>
			</h4>

			<div class="eltd-related-post-holder eltd-ls-related-normal-space eltd-ls-related-three-columns clearfix">
				<div class="eltd-ls-related-inner <?php echo esc_attr($slider_class);?>" <?php echo findme_elated_get_inline_attrs($data_params); ?>>
					<?php
						while($query->have_posts()){
							$query->the_post();

							$article_obj = new Core\ListingArticle(get_the_ID());

							$related_params  = array(
								'type_html' => $article_obj->getTaxHtml('job_listing_type', 'eltd-listing-type-wrapper'),
								'cat_html' => $article_obj->getTaxHtml('job_listing_category', 'eltd-listing-cat-wrapper'),
								'rating_html' => $article_obj->getListingAverageRating(),
								'address_html' => $article_obj->getAddressIconHtml(),
								'article_obj' => $article_obj
							);

							echo eltd_listing_single_template_part('related-posts/item', '', $related_params);
						}
						wp_reset_postdata();
					?>
				</div>
			</div>
		</div>

	<?php }
	else{
		echo eltd_listing_single_template_part('related-posts/no-post-found');
	}
}
else{
	echo eltd_listing_single_template_part('related-posts/no-post-found');
}