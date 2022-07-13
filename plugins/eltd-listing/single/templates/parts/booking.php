<?php
$open_table_id = $article_obj->getPostMeta('_open_table_id');

if ( $open_table_id !== '' ) { ?>
	<div class="eltd-ls-single-booking">
		<h5><?php esc_html_e('Book a table online', 'eltd-listing'); ?></h5>
		<?php
		if ( eltd_listing_booking_plugin_installed() ) {
			echo findme_elated_execute_shortcode( 'eltd_reservation_form', array(
				'open_table_id' => $open_table_id
			) );
		} else { ?>
			<p><?php esc_html_e('Please install Elated Booking Plugin', 'eltd-listing'); ?></p>
			<?php
		}
		?>
	</div>
<?php }