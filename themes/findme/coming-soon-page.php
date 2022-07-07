<?php
/*
Template Name: Coming Soon Page
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
	    <?php
	    /**
	     * findme_elated_header_meta hook
	     *
	     * @see findme_elated_header_meta() - hooked with 10
	     * @see findme_elated_user_scalable_meta() - hooked with 10
	     */
	    do_action('findme_elated_header_meta');

	    wp_head(); ?>
    </head>
	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
		<?php
		/**
		 * findme_elated_after_body_tag hook
		 *
		 * @see findme_elated_get_side_area() - hooked with 10
		 * @see findme_elated_smooth_page_transitions() - hooked with 10
		 */
		do_action('findme_elated_after_body_tag'); ?>

		<div class="eltd-wrapper">
			<div class="eltd-wrapper-inner">
				<div class="eltd-content">
		            <div class="eltd-content-inner">
						<div class="eltd-full-width">
							<div class="eltd-full-width-inner">
								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									<?php the_content(); ?>
								<?php endwhile; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>