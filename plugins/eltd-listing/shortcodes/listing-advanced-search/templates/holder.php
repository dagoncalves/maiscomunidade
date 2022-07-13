<?php
use ElatedListing\Lib\Front;
use ElatedListing\Lib\Core;
$this_object = eltd_listing_adv_search_class_instance();

$query_results = $this_object->getQueryResults();
$type_id = $this_object->getBasicParamByKey('type');
$data_params = $this_object->getBasicParamByKey('data_params');
$holder_classes = $this_object->getBasicParamByKey('holder_classes');
$content_in_grid = $this_object->getBasicParamByKey('content_in_grid') === 'yes' ? true : false;
$grid_class = '';
$search_title = $this_object->getBasicParamByKey('search_title');
$search_subtitle = $this_object->getBasicParamByKey('search_subtitle');
if($content_in_grid){
    $grid_class = 'eltd-grid';
}

$disable_content = $this_object->getBasicParamByKey('disable_content') === 'yes' ? true : false;

$map_flag = $this_object->getBasicParamByKey('enable_map') === 'yes' ? true : false;
$keyword_flag = $this_object->getBasicParamByKey('keyword_search') === 'yes' ? true : false ;

$banner_html = $this_object->getBannerHtml();


$html = '';	?>

<div class="eltd-ls-adv-search-holder clearfix <?php echo esc_attr($holder_classes);?>" <?php echo esc_attr($data_params); ?>>
	<?php

    if($map_flag){
	    echo eltd_listing_get_shortcode_module_template_part('templates/map', 'listing-advanced-search');
	}

	if($type_id !== '' && !$disable_content){ ?>
	    <div class="eltd-ls-adv-search-content <?php echo esc_attr($grid_class);?>" >
		
		<?php 
		   if($keyword_flag && !$map_flag){
		       echo eltd_listing_get_shortcode_module_template_part('templates/keyword', 'listing-advanced-search');
		   }

		   if($search_title !== '' || $search_subtitle !== '') { ?>

                <div class="eltd-ls-adv-title-holder">

                    <?php if($search_title !== '') {?>
                        <h2 class="eltd-ls-adv-title" >
                            <?php echo wp_kses_post($search_title); ?>
                        </h2 >
                    <?php }

                    if($search_subtitle !== '') { ?>
                        <span  class="eltd-ls-adv-subtitle">
                            <?php echo wp_kses_post($search_subtitle); ?>
                        </span>
                    <?php } ?>
                </div>

            <?php } ?>
    
		<div class="eltd-ls-adv-search-fields-holder">

            <?php if($banner_html !== ''){

                echo wp_kses_post($banner_html);

            }
				$object = new Front\ListingTypeFieldCreator($type_id);
				$object->getAdvSearchHtml();
			?>
		</div>

		<div class="eltd-ls-adv-search-items-holder eltd-ls-adr-normal-space eltd-ls-adr-three-columns clearfix">
			<div class="eltd-ls-adv-search-items-holder-inner eltd-ls-adr-inner clearfix">

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
								'article_obj' => $article_obj
							);

							$html .= eltd_listing_get_shortcode_module_template_part('templates/item', 'listing-advanced-search','',$params);
						}
					}
					else{
						$html = eltd_listing_get_shortcode_module_template_part('templates/post-not-found', 'listing-advanced-search');
					}

					wp_reset_postdata();
				echo findme_elated_get_module_part( $html ); ?>
			</div>
			<?php
				echo eltd_listing_get_shortcode_module_template_part('templates/load-more-template', 'listing-advanced-search');
			?>
		</div>
		
	    </div>

	<?php } ?>
</div>