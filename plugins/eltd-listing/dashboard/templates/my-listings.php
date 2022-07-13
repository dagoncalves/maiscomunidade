<div class="eltd-membership-dashboard-page">
	<div class="eltd-membership-dashboard-page-content">
		<h2 class="eltd-membership-dashboard-page-title eltd-main-title">
			<?php
			    esc_html_e( 'My listings', 'eltd-listing' );
			?>
		</h2>
		<?php
			echo findme_elated_execute_shortcode('job_dashboard', '');
		?>
	</div>
</div>