<?php
use ElatedListing\Lib\Front;
use ElatedListing\Lib\Core;
$this_object = eltd_listing_slider_class_instance();
$query_results = $this_object->getQueryResults();
$holder_classes = $this_object->getBasicParamByKey('holder_classes');
$data_params = $this_object->getBasicParamByKey('data_params');
$html = '';
?>

<div class="eltd-ls-slider-holder clearfix">

	<div class="eltd-ls-slider-items-holder clearfix <?php echo esc_attr($holder_classes); ?>">
		<div class="eltd-ls-slider-items-holder-inner eltd-ls-slider-inner eltd-owl-slider clearfix" <?php echo findme_elated_get_inline_attrs($data_params); ?>>
			<?php
				if($query_results->have_posts()){
					while ( $query_results->have_posts() ) {
						$query_results->the_post();
						$article_obj = new Core\ListingArticle(get_the_ID());

						$params  = array(
                            'type_html' => $article_obj->getTaxHtml('job_listing_type', 'eltd-listing-type-wrapper'),
                            'rating_html' => $article_obj->getListingAverageRating(),
                            'address_html' => $article_obj->getAddressIconHtml(),
                            'article_obj' => $article_obj,
                            'price_html'  => $article_obj->getActualPriceHtml()
						);

						$html .= eltd_listing_get_shortcode_module_template_part('templates/item', 'listing-slider','',$params);
					}
				}
				else{
					$html = eltd_listing_get_shortcode_module_template_part('templates/post-not-found', 'listing-slider');
				}

				wp_reset_postdata();
				echo wp_kses_post($html);
			?>
		</div>
	</div>
</div>