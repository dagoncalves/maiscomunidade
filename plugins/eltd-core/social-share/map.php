<?php

if ( ! function_exists( 'findme_elated_core_social_options_map' ) ) {

	function findme_elated_core_social_options_map() {

		findme_elated_add_admin_page(
			array(
				'slug'  => '_social_page',
				'title' => esc_html__( 'Social', 'eltd-core' ),
				'icon'  => 'fa fa-share-alt'
			)
		);

		/**
		 * Enable Social Share
		 */
		$panel_social_share = findme_elated_add_admin_panel(
			array(
				'page'  => '_social_page',
				'name'  => 'panel_social_share',
				'title' => esc_html__( 'Enable Social Share', 'eltd-core' )
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Social Share', 'eltd-core' ),
				'description'   => esc_html__( 'Enabling this option will allow social share on networks of your choice', 'eltd-core' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_panel_social_networks, #eltd_panel_show_social_share_on'
				),
				'parent'        => $panel_social_share
			)
		);

		$panel_show_social_share_on = findme_elated_add_admin_panel(
			array(
				'page'            => '_social_page',
				'name'            => 'panel_show_social_share_on',
				'title'           => esc_html__( 'Show Social Share On', 'eltd-core' ),
				'hidden_property' => 'enable_social_share',
				'hidden_value'    => 'no'
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_post',
				'default_value' => 'no',
				'label'         => esc_html__( 'Posts', 'eltd-core' ),
				'description'   => esc_html__( 'Show Social Share on Blog Posts', 'eltd-core' ),
				'parent'        => $panel_show_social_share_on
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_page',
				'default_value' => 'no',
				'label'         => esc_html__( 'Pages', 'eltd-core' ),
				'description'   => esc_html__( 'Show Social Share on Pages', 'eltd-core' ),
				'parent'        => $panel_show_social_share_on
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_portfolio-item',
				'default_value' => 'no',
				'label'         => esc_html__( 'Portfolio Item', 'eltd-core' ),
				'description'   => esc_html__( 'Show Social Share for Portfolio Items', 'eltd-core' ),
				'parent'        => $panel_show_social_share_on
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_job_listing',
				'default_value' => 'no',
				'label'         => esc_html__( 'Listing Item', 'eltd-core' ),
				'description'   => esc_html__( 'Show Social Share for Listing Items', 'eltd-core' ),
				'parent'        => $panel_show_social_share_on
			)
		);

		if ( findme_elated_is_woocommerce_installed() ) {
			findme_elated_add_admin_field(
				array(
					'type'          => 'yesno',
					'name'          => 'enable_social_share_on_product',
					'default_value' => 'no',
					'label'         => esc_html__( 'Product', 'eltd-core' ),
					'description'   => esc_html__( 'Show Social Share for Product Items', 'eltd-core' ),
					'parent'        => $panel_show_social_share_on
				)
			);
		}

		/**
		 * Social Share Networks
		 */
		$panel_social_networks = findme_elated_add_admin_panel(
			array(
				'page'            => '_social_page',
				'name'            => 'panel_social_networks',
				'title'           => esc_html__( 'Social Networks', 'eltd-core' ),
				'hidden_property' => 'enable_social_share',
				'hidden_value'    => 'no'
			)
		);

		/**
		 * Facebook
		 */
		findme_elated_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'facebook_title',
				'title'  => esc_html__( 'Share on Facebook', 'eltd-core' )
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_facebook_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'eltd-core' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Facebook', 'eltd-core' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_enable_facebook_share_container'
				),
				'parent'        => $panel_social_networks
			)
		);

		$enable_facebook_share_container = findme_elated_add_admin_container(
			array(
				'name'            => 'enable_facebook_share_container',
				'hidden_property' => 'enable_facebook_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'facebook_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'eltd-core' ),
				'parent'        => $enable_facebook_share_container
			)
		);

		/**
		 * Twitter
		 */
		findme_elated_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'twitter_title',
				'title'  => esc_html__( 'Share on Twitter', 'eltd-core' )
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_twitter_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'eltd-core' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Twitter', 'eltd-core' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_enable_twitter_share_container'
				),
				'parent'        => $panel_social_networks
			)
		);

		$enable_twitter_share_container = findme_elated_add_admin_container(
			array(
				'name'            => 'enable_twitter_share_container',
				'hidden_property' => 'enable_twitter_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'twitter_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'eltd-core' ),
				'parent'        => $enable_twitter_share_container
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'twitter_via',
				'default_value' => '',
				'label'         => esc_html__( 'Via', 'eltd-core' ),
				'parent'        => $enable_twitter_share_container
			)
		);

		/**
		 * Google Plus
		 */
		findme_elated_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'google_plus_title',
				'title'  => esc_html__( 'Share on Google Plus', 'eltd-core' )
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_google_plus_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'eltd-core' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Google Plus', 'eltd-core' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_enable_google_plus_container'
				),
				'parent'        => $panel_social_networks
			)
		);

		$enable_google_plus_container = findme_elated_add_admin_container(
			array(
				'name'            => 'enable_google_plus_container',
				'hidden_property' => 'enable_google_plus_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'google_plus_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'eltd-core' ),
				'parent'        => $enable_google_plus_container
			)
		);

		/**
		 * Linked In
		 */
		findme_elated_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'linkedin_title',
				'title'  => esc_html__( 'Share on LinkedIn', 'eltd-core' )
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_linkedin_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'eltd-core' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via LinkedIn', 'eltd-core' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_enable_linkedin_container'
				),
				'parent'        => $panel_social_networks
			)
		);

		$enable_linkedin_container = findme_elated_add_admin_container(
			array(
				'name'            => 'enable_linkedin_container',
				'hidden_property' => 'enable_linkedin_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'linkedin_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'eltd-core' ),
				'parent'        => $enable_linkedin_container
			)
		);

		/**
		 * Tumblr
		 */
		findme_elated_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'tumblr_title',
				'title'  => esc_html__( 'Share on Tumblr', 'eltd-core' )
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_tumblr_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'eltd-core' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Tumblr', 'eltd-core' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_enable_tumblr_container'
				),
				'parent'        => $panel_social_networks
			)
		);

		$enable_tumblr_container = findme_elated_add_admin_container(
			array(
				'name'            => 'enable_tumblr_container',
				'hidden_property' => 'enable_tumblr_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'tumblr_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'eltd-core' ),
				'parent'        => $enable_tumblr_container
			)
		);

		/**
		 * Pinterest
		 */
		findme_elated_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'pinterest_title',
				'title'  => esc_html__( 'Share on Pinterest', 'eltd-core' )
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_pinterest_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'eltd-core' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Pinterest', 'eltd-core' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_enable_pinterest_container'
				),
				'parent'        => $panel_social_networks
			)
		);

		$enable_pinterest_container = findme_elated_add_admin_container(
			array(
				'name'            => 'enable_pinterest_container',
				'hidden_property' => 'enable_pinterest_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'pinterest_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'eltd-core' ),
				'parent'        => $enable_pinterest_container
			)
		);

		/**
		 * VK
		 */
		findme_elated_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'vk_title',
				'title'  => esc_html__( 'Share on VK', 'eltd-core' )
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_vk_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'eltd-core' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via VK', 'eltd-core' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_enable_vk_container'
				),
				'parent'        => $panel_social_networks
			)
		);

		$enable_vk_container = findme_elated_add_admin_container(
			array(
				'name'            => 'enable_vk_container',
				'hidden_property' => 'enable_vk_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'vk_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'eltd-core' ),
				'parent'        => $enable_vk_container
			)
		);

		if ( defined( 'ELATED_TWITTER_FEED_VERSION' ) ) {
			$twitter_panel = findme_elated_add_admin_panel(
				array(
					'title' => esc_html__( 'Twitter', 'eltd-core' ),
					'name'  => 'panel_twitter',
					'page'  => '_social_page'
				)
			);

			findme_elated_add_admin_twitter_button(
				array(
					'name'   => 'twitter_button',
					'parent' => $twitter_panel
				)
			);
		}

		if ( defined( 'ELATED_INSTAGRAM_FEED_VERSION' ) ) {
			$instagram_panel = findme_elated_add_admin_panel(
				array(
					'title' => esc_html__( 'Instagram', 'eltd-core' ),
					'name'  => 'panel_instagram',
					'page'  => '_social_page'
				)
			);

			findme_elated_add_admin_instagram_button(
				array(
					'name'   => 'instagram_button',
					'parent' => $instagram_panel
				)
			);
		}

		/**
		 * Open Graph
		 */
		$panel_open_graph = findme_elated_add_admin_panel(
			array(
				'page'  => '_social_page',
				'name'  => 'panel_open_graph',
				'title' => esc_html__( 'Open Graph', 'eltd-core' ),
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_open_graph',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Open Graph', 'eltd-core' ),
				'description'   => esc_html__( 'Enabling this option will allow usage of Open Graph protocol on your site', 'eltd-core' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_enable_open_graph_container'
				),
				'parent'        => $panel_open_graph
			)
		);

		$enable_open_graph_container = findme_elated_add_admin_container(
			array(
				'name'            => 'enable_open_graph_container',
				'hidden_property' => 'enable_open_graph',
				'hidden_value'    => 'no',
				'parent'          => $panel_open_graph
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'open_graph_image',
				'default_value' => ELATED_ASSETS_ROOT . '/img/open_graph.jpg',
				'label'         => esc_html__( 'Default Share Image', 'eltd-core' ),
				'parent'        => $enable_open_graph_container,
				'description'   => esc_html( 'Used when featured image is not set. Make sure that image is at least 1200 x 630 pixels, up to 8MB in size', 'eltd-core' ),
			)
		);
	}

	add_action( 'findme_elated_options_map', 'findme_elated_core_social_options_map', 18);
}