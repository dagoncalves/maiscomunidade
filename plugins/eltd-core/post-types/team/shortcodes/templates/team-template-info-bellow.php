<div class="eltd-team <?php echo esc_attr($team_member_layout) ?>">
	<div class="eltd-team-inner">
		<?php if (get_the_post_thumbnail($member_id) !== '') { ?>
			<div class="eltd-team-image">
                <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>">
                    <?php echo get_the_post_thumbnail($member_id, 'full'); ?>
                </a>
			</div>
		<?php } ?>
		<div class="eltd-team-info">
            <div class="eltd-team-title-holder">
                <h4 itemprop="name" class="eltd-team-name entry-title">
                    <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>"><?php echo esc_html($title) ?></a>
                </h4>

                <?php if (!empty($position)) { ?>
                    <h6 class="eltd-team-position"><?php echo esc_html($position); ?></h6>
                <?php } ?>
            </div>
			<?php if (!empty($excerpt)) { ?>
				<div class="eltd-team-text">
					<div class="eltd-team-text-inner">
						<div class="eltd-team-description">
							<p itemprop="description" class="eltd-team-excerpt"><?php echo esc_html($excerpt); ?></p>
						</div>
					</div>
				</div>
			<?php } ?>
			<div class="eltd-team-social-holder-between">
				<div class="eltd-team-social">
					<div class="eltd-team-social-inner">
						<div class="eltd-team-social-wrapp">
							<?php foreach ($team_social_icons as $team_social_icon) {
								echo findme_elated_get_module_part( $team_social_icon );
							} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>