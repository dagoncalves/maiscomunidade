<?php
use ElatedListing\Lib\Front;
$listing_types = eltd_listing_get_listing_types_by_listing_id(get_the_ID());

if(count($listing_types)){ ?>

<div class="eltd-listing-single-amenities clearfix">
    <?php
	foreach($listing_types as $type){
		$object = new Front\ListingTypeFieldCreator($type['id'], get_the_ID());

		$object->getSingleListingAmenities();

	} ?>
	</div>
<?php } ?>
