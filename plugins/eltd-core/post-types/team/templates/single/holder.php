<div class="eltd-container">
	<div class="eltd-container-inner clearfix">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php if(post_password_required()) {
				echo get_the_password_form();
			} else { ?>
				<div class="eltd-team-single-holder">
					<div class="eltd-grid-row">
						<div <?php echo findme_elated_get_content_sidebar_class(); ?>>
							<div class="eltd-team-single-outer">
								<?php
								//load team info
								eltd_core_get_cpt_single_module_template_part('templates/single/parts/info', 'team', '', $params);
								
								//load content
								eltd_core_get_cpt_single_module_template_part('templates/single/parts/content', 'team', '', $params);
								?>
							</div>
						</div>
						<?php if($sidebar_layout !== 'no-sidebar') { ?>
							<div <?php echo findme_elated_get_sidebar_holder_class(); ?>>
								<?php get_sidebar(); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		<?php endwhile;	endif; ?>
	</div>
</div>