<?php
namespace ElatedCore\CPT\MasonryGallery;

use ElatedCore\Lib;

/**
 * Class MasonryGalleryRegister
 * @package ElatedCore\CPT\MasonryGallery
 */
class MasonryGalleryRegister implements Lib\PostTypeInterface  {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base     = 'masonry-gallery';
        $this->taxBase  = 'masonry-gallery-category';
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Registers custom post type with WordPress
     */
    public function register() {
        $this->registerPostType();
        $this->registerTax();
    }

    /**
     * Registers custom post type with WordPress
     */
	private function registerPostType() {
	   global $findme_elated_Framework;
	
	   $menuPosition = 5;
	   $menuIcon = 'dashicons-admin-post';
	
	   if(eltd_core_theme_installed()) {
		   $menuPosition = $findme_elated_Framework->getSkin()->getMenuItemPosition('masonry-gallery');
		   $menuIcon = $findme_elated_Framework->getSkin()->getMenuIcon('masonry-gallery');
	   }
	
	    register_post_type($this->base,
	        array(
	            'labels' 		=> array(
	                'name' 				=> esc_html__( 'Elated Masonry Gallery', 'eltd-core' ),
	                'all_items'			=> esc_html__( 'Elated Masonry Gallery Items', 'eltd-core' ),
	                'singular_name' 	=> esc_html__( 'Masonry Gallery Item', 'eltd-core' ),
	                'add_item'			=> esc_html__( 'New Masonry Gallery Item', 'eltd-core' ),
	                'add_new_item' 		=> esc_html__( 'Add New Masonry Gallery Item', 'eltd-core' ),
	                'edit_item' 		=> esc_html__( 'Edit Masonry Gallery Item', 'eltd-core' )
	            ),
	            'public'		=>	false,
	            'show_in_menu'	=>	true,
	            'rewrite' 		=> 	array('slug' => 'masonry-gallery'),
				'menu_position' => 	$menuPosition,
	            'show_ui'		=>	true,
	            'has_archive'	=>	false,
	            'hierarchical'	=>	false,
	            'supports'		=>	array('title', 'thumbnail'),
				'menu_icon'     =>  $menuIcon
	        )
	    );
	}

	/**
	* Registers custom taxonomy with WordPress
	*/
	private function registerTax() {
		$labels = array(
			'name'              => esc_html__('Masonry Gallery Categories', 'eltd-core'),
			'singular_name'     => esc_html__('Masonry Gallery Category', 'eltd-core'),
			'search_items'      => esc_html__('Search Masonry Gallery Categories', 'eltd-core'),
			'all_items'         => esc_html__('All Masonry Gallery Categories', 'eltd-core'),
			'parent_item'       => esc_html__('Parent Masonry Gallery Category', 'eltd-core'),
			'parent_item_colon' => esc_html__('Parent Masonry Gallery Category:', 'eltd-core'),
			'edit_item'         => esc_html__('Edit Masonry Gallery Category', 'eltd-core'),
			'update_item'       => esc_html__('Update Masonry Gallery Category', 'eltd-core'),
			'add_new_item'      => esc_html__('Add New Masonry Gallery Category', 'eltd-core'),
			'new_item_name'     => esc_html__('New Masonry Gallery Category Name', 'eltd-core'),
			'menu_name'         => esc_html__('Masonry Gallery Categories', 'eltd-core')
		);
		
		register_taxonomy($this->taxBase, array($this->base), array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite'           => array('slug' => 'masonry-gallery-category')
		));
	}
}