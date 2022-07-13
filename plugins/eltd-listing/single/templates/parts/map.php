<?php
$params_address = eltd_listing_get_address_params(get_the_ID());
extract($params_address);
$get_directions_link = '';
if ( $address_lat !== '' && $address_long !== '' ) {
	$get_directions_link = '//maps.google.com/maps?daddr=' . $address_lat . ',' . $address_long;
}?>

<div class="eltd-ls-single-map-holder" itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">

	<?php if($address_lat !== '' && $address_long !== ''){

	    echo eltd_listing_get_listing_item_map($address_lat, $address_long); ?>

		<!-- render map overlay-->
		<div class="eltd-ls-single-map-address-info" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			<h3 class="eltd-ls-address-title">
				<?php echo get_the_title(); ?>
			</h3>
			<p class="eltd-ls-address-info">
				<a href="<?php echo esc_url($get_directions_link) ?>" target="_blank">
					<?php echo esc_html( $address ); ?>
				</a>
			</p>
		</div>

	<?php }
	echo eltd_listing_single_template_part('parts/contact-info', '',$params);
	echo eltd_listing_single_template_part('parts/social-networks', '', $params);
	?>

</div>