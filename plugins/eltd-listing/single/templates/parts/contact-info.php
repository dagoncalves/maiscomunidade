<?php
$phone = $article_obj->getPostMeta('_listing_phone');
$web_site = $article_obj->getPostMeta('_company_website');
$mail = $article_obj->getPostMeta('_listing_mail');
$website_target = findme_elated_options()->getOptionValue('listing_website_target');
if($phone !== '' || $web_site !== '' || $mail !== ''){ ?>

	<div class="eltd-ls-contact-info-holder">
		<?php if($phone !== ''){ ?>

			<div class="eltd-ls-contact-info phone">
				<div class="eltd-ls-contact-info-inner left">
					<?php echo findme_elated_icon_collections()->renderIcon( 'icon_phone' , 'font_elegant' );?>
				</div>
				<div class="eltd-ls-contact-info-inner right">
					<span>
						<?php echo wp_kses_post($phone); ?>
					</span>
				</div>
			</div>

		<?php }

		if($web_site !== ''){ ?>

			<div class="eltd-ls-contact-info website">
				<div class="eltd-ls-contact-info-inner left">
					<?php echo findme_elated_icon_collections()->renderIcon( 'icon_genius', 'font_elegant' );?>
				</div>
				<div class="eltd-ls-contact-info-inner right">
					<a href="<?php echo esc_url($web_site) ?>" target="<?php echo esc_attr($website_target); ?>">
						<?php echo wp_kses_post( $web_site ); ?>
					</a>
				</div>
			</div>

		<?php }

		if($mail !== ''){ ?>

			<div class="eltd-ls-contact-info email">
				<div class="eltd-ls-contact-info-inner left">
					<?php echo findme_elated_icon_collections()->renderIcon( 'icon_mail_alt', 'font_elegant' );?>
				</div>
				<div class="eltd-ls-contact-info-inner right">
					<a href="<?php echo esc_url( 'mailto:' . $mail ); ?>">
						<?php echo wp_kses_post( $mail ); ?>
					</a>
				</div>
			</div>

		<?php } ?>
	</div>

<?php }