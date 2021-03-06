<?php

class ElatedMembershipPageTemplate {

	/**
	 * A Unique Identifier
	 */
	protected $plugin_slug;

	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;

	/**
	 * The array of templates that this plugin tracks.
	 */
	protected $templates;


	/**
	 * Returns an instance of this class.
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new ElatedMembershipPageTemplate();
		}

		return self::$instance;

	}

	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	private function __construct() {

		$this->templates = array();

		global $wp_version;

		if( version_compare( $wp_version, 4.7, '<' ) )	{
			// Add a filter to the attributes metabox to inject template into the cache.
			add_filter( 'page_attributes_dropdown_pages_args', array( $this, 'eltd_membership_register_directory_templates' ) );

			// Add a filter to the save post to inject out template into the page cache
			add_filter( 'wp_insert_post_data', array( $this, 'eltd_membership_register_directory_templates' ) );

			// Add a filter to the template include to determine if the page has our template assigned and return it's path
			add_filter( 'template_include', array( $this, 'eltd_membership_view_directory_template' ) );

		}
		else {
			// Add a filter to the theme page templates to assigned our custom template into the list
			add_filter('theme_page_templates', array( $this, 'eltd_membership_add_user_dashboard_template' ));

			// Add a filter to the template include to determine if the page has our template assigned and return it's path
			add_filter( 'template_include', array( $this, 'eltd_membership_view_directory_template' ) );
		}

		// Add your templates to this array.
		$this->templates = array(
			'user-dashboard.php' => esc_html__('User Dashboard', 'eltd-membership')
		);

	}

	/**
	 * Adds our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doens't really exist.
	 *
	 * @param $atts
	 * @return mixed
	 */
	public function eltd_membership_register_directory_templates( $atts ) {

		// Create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		// Retrieve the cache list.
		// If it doesn't exist, or it's empty prepare an array
		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		}

		// New cache, therefore remove the old one
		wp_cache_delete( $cache_key, 'themes' );

		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, $this->templates );

		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;

	}

	/**
	 * Checks if the template is assigned to the page
	 */
	public function eltd_membership_view_directory_template( $template ) {

		global $post;
		if ( isset( $post ) ) {
			if ( ! isset( $this->templates[ get_post_meta( $post->ID, '_wp_page_template', true ) ] ) ) {
				return $template;
			}

			$file = plugin_dir_path( __FILE__ ) . 'page-templates/' . get_post_meta( $post->ID, '_wp_page_template', true );

			// Just to be safe, we check if the file exist first
			if ( file_exists( $file ) ) {
				return $file;
			} else {
				echo findme_elated_get_module_part( $file );
			}
			exit;
		}

		return $template;
	}

	/**
	 * Assign our template into the list of templates
	 * Requires 4.7 or above
	 */
	public function eltd_membership_add_user_dashboard_template($post_templates) {
		$templates = $post_templates;
		if ( empty( $templates ) ) {
			$templates = array();
		}

		$templates = array_merge( $templates, $this->templates );

		return $templates;
	}

}

add_action( 'plugins_loaded', array( 'ElatedMembershipPageTemplate', 'get_instance' ) );