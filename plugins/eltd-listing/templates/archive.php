<?php
get_header();
?>
	<div class="eltd-full-width">
		<?php do_action('eltd_listing_action_after_container_open'); ?>
		<div class="eltd-full-width-inner">
			<?php
			    eltd_listing_get_listing_archive_pages();
			?>
		</div>
		<?php do_action('eltd_listing_action_before_container_close'); ?>
	</div>
<?php get_footer();