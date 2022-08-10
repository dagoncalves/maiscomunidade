<div class="eltd-team-single-info-holder">
	<div class="eltd-grid-row">
		<div class="eltd-ts-image-holder eltd-grid-col-6">
			<?php the_post_thumbnail(); ?>
		</div>
		<div class="eltd-ts-details-holder eltd-grid-col-6">
			<h3 itemprop="name" class="eltd-name entry-title"><?php the_title(); ?></h3>
			<p class="eltd-position"><?php echo esc_html($position); ?>
				<?php foreach ($social_icons as $social_icon) {
					echo wp_kses_post($social_icon);
				} ?>
			</p>
			<div class="eltd-ts-bio-holder">
				<?php if(!empty($birth_date)) { ?>
					<div class="eltd-ts-info-row">
						<span aria-hidden="true" class="icon_calendar eltd-ts-bio-icon"></span>
						<span class="eltd-ts-bio-info"><?php echo esc_html__('born on: ', 'eltd-core').esc_html($birth_date); ?></span>
					</div>
				<?php } ?>
				<?php if(!empty($email)) { ?>
					<div class="eltd-ts-info-row">
						<span aria-hidden="true" class="icon_mail_alt eltd-ts-bio-icon"></span>
						<span itemprop="email" class="eltd-ts-bio-info"><?php echo esc_html__('email: ', 'eltd-core').sanitize_email(esc_html($email)); ?></span>
					</div>
				<?php } ?>
				<?php if(!empty($phone)) { ?>
					<div class="eltd-ts-info-row">
						<span aria-hidden="true" class="icon_phone eltd-ts-bio-icon"></span>
						<span class="eltd-ts-bio-info"><?php echo esc_html__('phone: ', 'eltd-core').esc_html($phone); ?></span>
					</div>
				<?php } ?>
				<?php if(!empty($address)) { ?>
					<div class="eltd-ts-info-row">
						<span aria-hidden="true" class="icon_building_alt eltd-ts-bio-icon"></span>
						<span class="eltd-ts-bio-info"><?php echo esc_html__('lives in: ', 'eltd-core').esc_html($address); ?></span>
					</div>
				<?php } ?>
				<?php if(!empty($education)) { ?>
					<div class="eltd-ts-info-row">
						<span aria-hidden="true" class="icon_ribbon_alt eltd-ts-bio-icon"></span>
						<span class="eltd-ts-bio-info"><?php echo esc_html__('education: ', 'eltd-core').esc_html($education); ?></span>
					</div>
				<?php } ?>
				<?php if(!empty($resume)) { ?>
					<div class="eltd-ts-info-row">
						<span aria-hidden="true" class="icon_document_alt eltd-ts-bio-icon"></span>
						<a href="<?php echo esc_url($resume); ?>" download target="_blank"><span class="eltd-ts-bio-info"><?php echo esc_html__('Download Resume', 'eltd-core'); ?></span></a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>