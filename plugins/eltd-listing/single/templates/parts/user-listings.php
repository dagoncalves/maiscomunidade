<?php
$user_id = get_the_author_meta( 'ID' );
$params = array(
	'user_id' => $user_id,
	'post_number' => 4,
	'post_not_in' => array(
		get_the_ID()
	)
);
$user_listings = eltd_listing_get_listing_query_results($params);
$month = get_the_time('m');
$year = get_the_time('Y');

if($user_listings->have_posts()){ ?>

	<div class="eltd-ls-user-listing-holder">
		<div class="eltd-ls-user-listing-header">
			<h5 class="eltd-ls-user-listing-title">
				<?php esc_html_e('More from this employer','eltd-listing'); ?>
			</h5>
			<form class="eltd-ls-user-listing-link" method="get" action="<?php echo esc_url(get_post_type_archive_link( 'job_listing' )); ?>">

				<input type="hidden" name="eltd-ls-user-id" value="<?php echo esc_attr($user_id) ?>">
				<?php echo findme_elated_get_button_html(array(
					'text' => esc_html__('See All', 'eltd-listing'),
					'html_type' => 'button',
                    'type'  => 'simple',
					'size'  => 'medium',
					'font_size' => '14',
                    'color'     => '#7dc50f',
                    'margin'    => '0'
				)); ?>
			</form>
		</div>
		<?php while($user_listings->have_posts()){

			$user_listings->the_post();
			$image_url = get_the_post_thumbnail_url();
			$image_style = 'background-image: url('.esc_url($image_url).')';
			?>

			<div class="eltd-ls-user-listing-item">

                <div class="eltd-ls-user-listing-item-image">
					<a href="<?php echo get_the_permalink(); ?>" class="eltd-ls-user-listing-item-image-inner" <?php echo findme_elated_get_inline_style($image_style) ?>></a>
				</div>

				<div class="eltd-ls-user-listing-item-text">
					<div class="eltd-ls-user-listing-title">
						<a href="<?php echo get_the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</div>
					<div class="eltd-ls-user-listing-date">
						<?php the_time(get_option('date_format')); ?>
					</div>
				</div>

			</div>
		<?php }
		wp_reset_postdata(); ?>
	</div>

<?php }