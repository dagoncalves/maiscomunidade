<?php
use ElatedListing\Lib\Front;
use ElatedListing\Lib\Core;
$this_object = eltd_listing_categories_class_instance();
$query_results = $this_object->getQueryResults();
$holder_classes = $this_object->getBasicParamByKey('holder_classes');
$html = '';
?>

<div class="<?php echo esc_attr($holder_classes); ?>">
	<div class="eltd-ls-gallery-inner clearfix">
		<div class="eltd-ls-gallery-sizer"></div>
		<?php
			if(is_array($query_results) && count($query_results)){
				foreach($query_results as $tax){

				    $tax_params = array(
						'tax' => $tax
					);
					$html .= eltd_listing_get_shortcode_module_template_part('templates/item', 'listing-categories', $tax['gallery_type'] ,$tax_params);
				}
			}
			else{
				$html = eltd_listing_get_shortcode_module_template_part('templates/post-not-found', 'listing-categories');
			}
			wp_reset_postdata();
		echo findme_elated_get_module_part( $html );
		?>
	</div>
	<?php
		echo eltd_listing_get_shortcode_module_template_part('templates/load-more-template', 'listing-categories');
	?>
</div>