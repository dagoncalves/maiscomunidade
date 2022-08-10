<?php
namespace ElatedCore\CPT\Testimonials;

use ElatedCore\Lib;

/**
 * Class TestimonialsRegister
 * @package ElatedCore\CPT\Testimonials
 */
class TestimonialsRegister implements Lib\PostTypeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'testimonials';
        $this->taxBase = 'testimonials-category';
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
     * Regsiters custom post type with WordPress
     */
    private function registerPostType() {
        global $findme_elated_Framework;

        $menuPosition = 5;
        $menuIcon = 'dashicons-admin-post';

        if(eltd_core_theme_installed()) {
            $menuPosition = $findme_elated_Framework->getSkin()->getMenuItemPosition('testimonial');
            $menuIcon = $findme_elated_Framework->getSkin()->getMenuIcon('testimonial');
        }

        register_post_type('testimonials',
            array(
                'labels' 		    => array(
	                'menu_name' 	=> esc_html__( 'Elated Testimonials','eltd-core' ),
                	'name' 			=> esc_html__( 'Elated Testimonials','eltd-core' ),
                    'singular_name' => esc_html__( 'Testimonial','eltd-core' ),
                    'add_item'		=> esc_html__( 'New Testimonial','eltd-core' ),
                    'add_new_item' 	=> esc_html__( 'Add New Testimonial','eltd-core' ),
                    'edit_item' 	=> esc_html__( 'Edit Testimonial','eltd-core' )
                ),
                'public'		=>	false,
                'show_in_menu'	=>	true,
                'rewrite' 		=> 	array('slug' => 'testimonials'),
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
            'name'              => esc_html__('Testimonials Categories', 'eltd-core'),
            'singular_name'     => esc_html__('Testimonial Category', 'eltd-core'),
            'search_items'      => esc_html__('Search Testimonials Categories','eltd-core'),
            'all_items'         => esc_html__('All Testimonials Categories','eltd-core'),
            'parent_item'       => esc_html__('Parent Testimonial Category','eltd-core'),
            'parent_item_colon' => esc_html__('Parent Testimonial Category:','eltd-core'),
            'edit_item'         => esc_html__('Edit Testimonials Category','eltd-core'),
            'update_item'       => esc_html__('Update Testimonials Category','eltd-core'),
            'add_new_item'      => esc_html__('Add New Testimonials Category','eltd-core'),
            'new_item_name'     => esc_html__('New Testimonials Category Name','eltd-core'),
            'menu_name'         => esc_html__('Testimonials Categories','eltd-core')
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'query_var'         => true,
            'show_admin_column' => true,
            'rewrite'           => array('slug' => 'testimonials-category')
        ));
    }
}