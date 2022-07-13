<ul class="eltd-membership-dashboard-nav clearfix">
	<?php
	$nav_items = eltd_membership_get_dashboard_navigation_items();
	$action = 'profile';
	if ( isset( $_GET['user-action'] ) ) {
		$action = $_GET['user-action'];
	}
	foreach ( $nav_items as $nav_key => $nav_item ) {
		$active_class = '';
		if ($action == $nav_key){
			$active_class .= 'eltd-active-dash';
		}
		?>
		<li class="<?php echo esc_attr($active_class);?>">
			<a href="<?php echo esc_url($nav_item['url']); ?>">
				<?php if(isset($nav_item['icon'])){ ?>
					<span class="eltd-dash-icon">
						<?php echo findme_elated_get_module_part( $nav_item['icon'] ); ?>
					</span>
				<?php } ?>
                <h5 class="eltd-dash-item-title">
                    <?php echo esc_attr($nav_item['text']); ?>
                </h5>
			</a>
		</li>
	<?php } ?>
	<li>
		<a href="<?php echo wp_logout_url( home_url( '/' ) ); ?>">
            <span class="eltd-dash-icon">
                <?php echo findme_elated_icon_collections()->renderIcon('lnr-pointer-right', 'linear_icons'); ?>
            </span>
            <h5 class="eltd-dash-item-title">
                <?php esc_html_e( 'Log out', 'eltd-membership' ); ?>
            </h5>
		</a>
	</li>
</ul>