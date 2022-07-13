<?php
use ElatedListing\Lib\Core;
if (have_posts()) :
	while (have_posts()) : the_post();?>
		<div class="eltd-full-width">
			<div class="eltd-full-width-inner clearfix">

				<div <?php findme_elated_class_attribute($holder_class); ?>>
					<?php
					if(post_password_required()) {
						echo get_the_password_form();
					} else {
						//load proper listing template
						$article = new Core\ListingArticle(get_the_ID());
						$params  = array(
							'article_obj' => $article
						);

						eltd_listing_single_template_part('single', $listing_template, $params);
					} ?>
				</div>

			</div>
		</div>
	<?php endwhile;
endif;