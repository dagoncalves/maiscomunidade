<?php
use ElatedListing\Lib\Core;
?>
<div class="eltd-ls-archive-holder clearfix">

	<div class="eltd-ls-archive-map-holder">
		<?php echo eltd_listing_get_listing_multiple_map(); ?>
	</div>

	<div class="eltd-ls-archive-items-wrapper">

		<?php
		eltd_listing_get_archive_module_template_part('filter/filter');
		?>

		<div class="eltd-ls-archive-items eltd-ls-archive-normal-space eltd-ls-archive-two-columns clearfix">
			<div class="eltd-ls-archive-items-inner clearfix">
				<?php
				if($featured_query_results->have_posts()) {

					while($featured_query_results->have_posts()) {
						$featured_query_results->the_post();
						$article = new Core\ListingArticle(get_the_ID());
						$title = strtolower(get_the_title());
						$title = str_replace( ' ', '-', $title );

						$params = array(
							'rating_html'  => $article->getListingAverageRating(),
							'address_html' => $article->getAddressIconHtml(),
							'price_html'   => $article->getPriceHtml(),
							'article_class'=> 'eltd-ls-item-featured',
							'cat_html'     => $article->getTaxHtml('job_listing_category', 'eltd-listing-cat-wrapper'),
							'title'        => $title
						);
						eltd_listing_get_archive_module_template_part('single', '', $params);
					}
					wp_reset_postdata();
				}
				if($no_featured_query_results->have_posts()) {

					while($no_featured_query_results->have_posts()) {
						$no_featured_query_results->the_post();
						$article = new Core\ListingArticle(get_the_ID());
						$title = strtolower(get_the_title());
						$title = str_replace( ' ', '-', $title );

						$params = array(
							'rating_html'  => $article->getListingAverageRating(),
							'address_html' => $article->getAddressIconHtml(),
							'price_html'   => $article->getPriceHtml(),
							'article_class'=> '',
							'cat_html'     => $article->getTaxHtml('job_listing_category', 'eltd-listing-cat-wrapper'),
							'title'        => $title
						);
						eltd_listing_get_archive_module_template_part('single', '', $params);
					}
					wp_reset_postdata();
				}
				else{
					eltd_listing_get_archive_module_template_part('post-not-found');
				}?>
			</div>
		</div>
		<?php
		eltd_listing_get_archive_module_template_part('load-more-template');
		?>
	</div>
</div>