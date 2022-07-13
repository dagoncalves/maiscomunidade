<?php
$user_id = get_current_user_id();
$listing_packages = wc_paid_listings_get_user_packages($user_id);
?>

<div class="eltd-membership-dashboard-page">
	<div class="eltd-membership-dashboard-page-content">
		<h2 class="eltd-membership-dashboard-page-title eltd-main-title">
			<?php
				esc_html_e( 'My Packages', 'eltd-listing' );
			?>
		</h2>
		<?php
		    $user_id = get_current_user_id();
			$listing_packages = wc_paid_listings_get_user_packages($user_id);

			if(is_array($listing_packages) && count($listing_packages)){
				$params = array();
				?>

				<ul class="eltd-user-package-holder">
                    <?php foreach($listing_packages as $package){
						$params['package'] = $package;
						echo eltd_listing_get_listing_module_template_part('dashboard', 'package', '', $params);
					}?>
				</ul>

			<?php }
			else{
				echo eltd_listing_get_listing_module_template_part('dashboard', 'package-not-found', '', $params);
            }
		?>
	</div>
</div>