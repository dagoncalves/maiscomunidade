<?php
$html = $article_obj->getListingAverageRating();
if($html !== ''){ ?>
	<div itemprop="ratingStars" class="eltd-ls-header-info rating-stars  entry-rating-stars published updated">
		<?php
			echo wp_kses_post($html);
		?>
	</div>
<?php }