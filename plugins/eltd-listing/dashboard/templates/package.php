<?php
$product_id = false;
$title = '';
$price = '';
$disc_price = '';
if(isset($package->product_id)){
	$product_id = $package->product_id;
}
if($product_id){
	$title = get_the_title($product_id);
	$disc_price = get_post_meta($product_id, '_price', true);
	$price = get_post_meta($product_id, '_regular_price', true);
}
if($package && $product_id){ ?>
	<li class="eltd-user-package">

        <?php if($title !== '') { ?>
			<div class="eltd-user-package-title eltd-ls-package-part">
				<h4 class="eltd-ls-package-text">
                    <?php
                        esc_html_e('Title','eltd-listing');
                    ?>
                </h4>
                <p class="eltd-ls-package-value">
					<?php echo esc_attr($title); ?>
				</p>
			</div>
		<?php }

		if(isset($package->package_duration)){ ?>
			<div class="eltd-user-package-duration eltd-ls-package-part">
                <h4 class="eltd-ls-package-text">
                    <?php
                    esc_html_e('Duration','eltd-listing');
                    ?>
                </h4>
                <p class="eltd-ls-package-value">
					<?php echo esc_attr($package->package_duration);?>
				</p>
			</div>
		<?php }

		if(isset($package->package_count)){ ?>
			<div class="eltd-user-package-count eltd-ls-package-part">

                <h4 class="eltd-ls-package-text">
                    <?php
                    esc_html_e('Count','eltd-listing');
                    ?>
                </h4>
                <p class="eltd-ls-package-value">
					<?php echo esc_attr($package->package_count); ?>
				</p>

			</div>
		<?php }

		if(isset($package->package_limit)){ ?>
			<div class="eltd-user-package-limit eltd-ls-package-part">

                <h4 class="eltd-ls-package-text">
                    <?php
                    esc_html_e('Limit','eltd-listing');
                    ?>
                </h4>

                <p class="eltd-ls-package-value">
					<?php echo esc_attr($package->package_limit);?>
				</p>

			</div>
		<?php }

		if($price !== ''){ ?>
			<div class="eltd-user-package-price eltd-ls-package-part">

                <h4 class="eltd-ls-package-text">
                    <?php
                        esc_html_e('Regular Price','eltd-listing');
                    ?>
                </h4>

                <p class="eltd-ls-package-value">
					<?php echo esc_attr($price);?>
				</p>

			</div>
		<?php }

		if($disc_price !== '' && ($price !== $disc_price)){ ?>
			<div class="eltd-user-package-price eltd-ls-package-part">

                <h4 class="eltd-ls-package-text">
                    <?php
                        esc_html_e('Discount Price','eltd-listing');
                    ?>
                </h4>

                <p class="eltd-ls-package-value">
					<?php echo esc_attr($disc_price); ?>
				</p>

			</div>
		<?php } ?>

	</li>
<?php }