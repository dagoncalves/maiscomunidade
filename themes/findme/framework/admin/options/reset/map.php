<?php

if ( ! function_exists( 'findme_elated_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function findme_elated_reset_options_map() {
		
		findme_elated_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'findme' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = findme_elated_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'findme' )
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'findme' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'findme' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'findme_elated_options_map', 'findme_elated_reset_options_map', 100 );
}