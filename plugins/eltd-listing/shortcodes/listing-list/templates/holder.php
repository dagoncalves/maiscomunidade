<?php
use ElatedListing\Lib\Front;
use ElatedListing\Lib\Core;
$this_object = eltd_listing_list_class_instance();
$query_results = $this_object->getQueryResults();
$holder_classes = $this_object->getBasicParamByKey('holder_classes');
$html = '';	?>

<div class="eltd-ls-list-holder clearfix">

	<div class="eltd-ls-list-items-holder clearfix <?php echo esc_attr($holder_classes); ?>">
		<div class="eltd-ls-list-items-holder-inner eltd-ls-list-inner clearfix">
			<?php
				if($query_results->have_posts()){
					while ( $query_results->have_posts() ) {
						$query_results->the_post();
						$article_obj = new Core\ListingArticle(get_the_ID());

						$params  = array(
							'type_html' => $article_obj->getTaxHtml('job_listing_type', 'eltd-listing-type-wrapper'),
							'cat_html' => $article_obj->getTaxHtml('job_listing_category', 'eltd-listing-cat-wrapper'),
							'rating_html' => $article_obj->getListingAverageRating(),
							'address_html' => $article_obj->getAddressIconHtml(),
							'article_obj' => $article_obj,
                            'price_html'  => $article_obj->getActualPriceHtml()
						);

						$html .= eltd_listing_get_shortcode_module_template_part('templates/item', 'listing-list','',$params);
					}
				}
				else{
					$html = eltd_listing_get_shortcode_module_template_part('templates/post-not-found', 'listing-list');
				}

				wp_reset_postdata();
				echo wp_kses_post($html);
			?>
		</div>
	</div>
</div>