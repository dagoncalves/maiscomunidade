<div class="eltd-ls-enquiry-holder">
	<div class="eltd-ls-enquiry-inner">
		<form class="eltd-ls-enquiry-form" method="POST">

            <h3 class="eltd-ls-enquiry-title">
                <?php esc_html_e('Contact the property', 'eltd-listing'); ?>
            </h3>

			<input type="text" name="enquiry-name" id="enquiry-name" placeholder="<?php esc_html_e( 'Your Name*', 'eltd-listing' );?>" required pattern=".{6,}">
			<input type="email" name="enquiry-email" id="enquiry-email" placeholder="<?php esc_html_e( 'Your E-mail Address*', 'eltd-listing' );?>" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
            <input type="text" name="enquiry-website" id="enquiry-website" placeholder="<?php esc_html_e( 'Website URL', 'eltd-listing' );?>" required pattern=".{6,}">
			<textarea name="enquiry-message" id="enquiry-message" placeholder="<?php esc_html_e( 'Write Your Message*', 'eltd-listing' );?>" required></textarea>

            <?php echo findme_elated_get_button_html(array(
				'text' => esc_html__('add to listing', 'eltd-listing'),
				'html_type' => 'button',
				'type' => 'solid',
				'custom_class' => 'eltd-ls-single-enquiry-submit',
                'icon_pack'    => 'font_elegant',
                'fe_icon'      => 'icon_plus'
			)); ?>

			<input type="hidden" id="enquiry-item-id" value="<?php echo get_the_ID(); ?>">
			<?php wp_nonce_field('eltd_validate_listing_item_enquiry', 'eltd_nonce_listing_item_enquiry'); ?>
		</form>
		<div class="eltd-listing-enquiry-response"></div>
	</div>
</div>