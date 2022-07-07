<?php
$eltd_sidebar_layout  = findme_elated_sidebar_layout();

get_header();
findme_elated_get_title();
get_template_part('slider');
?>
<div class="eltd-container eltd-default-page-template">
	<?php do_action('findme_elated_after_container_open'); ?>
	<div class="eltd-container-inner clearfix">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="eltd-grid-row">
				<div <?php echo findme_elated_get_content_sidebar_class(); ?>>
					<?php
						the_content();
						do_action('findme_elated_page_after_content');
					?>
				</div>
				<?php if($eltd_sidebar_layout !== 'no-sidebar') { ?>
					<div <?php echo findme_elated_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		<?php endwhile; endif; ?>
	</div>
	<?php do_action('findme_elated_before_container_close'); ?>
</div>
<?php get_footer(); ?>