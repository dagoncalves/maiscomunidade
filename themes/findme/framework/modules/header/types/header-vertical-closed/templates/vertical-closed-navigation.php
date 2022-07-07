<?php do_action('findme_elated_before_top_navigation'); ?>
<div class="eltd-vertical-menu-outer">
	<nav class="eltd-vertical-menu eltd-vertical-dropdown-on-click">
		<?php
			wp_nav_menu(array(
				'theme_location'  => 'vertical-navigation',
				'container'       => '',
				'container_class' => '',
				'menu_class'      => '',
				'menu_id'         => '',
				'fallback_cb'     => 'top_navigation_fallback',
				'link_before'     => '<span>',
				'link_after'      => '</span>',
				'walker'          => new FindmeElatedTopNavigationWalker()
			));
		?>
	</nav>
</div>
<?php do_action('findme_elated_after_top_navigation'); ?>