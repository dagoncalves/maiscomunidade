<?php
namespace ElatedCore\CPT\Portfolio;

use ElatedCore\Lib\PostTypeInterface;

/**
 * Class PortfolioRegister
 * @package ElatedCore\CPT\Portfolio
 */
class PortfolioRegister implements PostTypeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'portfolio-item';
        $this->taxBase = 'portfolio-category';
	
	    add_filter('archive_template', array($this, 'registerArchiveTemplate'));
        add_filter('single_template', array($this, 'registerSingleTemplate'));
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
        $this->registerTagTax();
    }
	
	/**
	 * Registers portfolio archive template if one does'nt exists in theme.
	 * Hooked to archive_template filter
	 * @param $archive string current template
	 * @return string string changed template
	 */
	public function registerArchiveTemplate($archive) {
		global $post;
		
		if($post && $post !== null && $post->post_type == $this->base) {
			if(!file_exists(get_template_directory().'/archive-'.$this->base.'.php')) {
				return ELATED_CORE_CPT_PATH.'/portfolio/templates/archive-'.$this->base.'.php';
			}
		}
		
		return $archive;
	}

    /**
     * Registers portfolio single template if one does'nt exists in theme.
     * Hooked to single_template filter
     * @param $single string current template
     * @return string string changed template
     */
    public function registerSingleTemplate($single) {
        global $post;

        if($post && $post !== null && $post->post_type == $this->base) {
            if(!file_exists(get_template_directory().'/single-portfolio-item.php')) {
                return ELATED_CORE_CPT_PATH.'/portfolio/templates/single-'.$this->base.'.php';
            }
        }

        return $single;
    }

    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {
        global $findme_elated_Framework, $findme_elated_options;

        $menuPosition = 5;
        $menuIcon = 'dashicons-admin-post';
        $slug = $this->base;

        if(eltd_core_theme_installed()) {
            $menuPosition = $findme_elated_Framework->getSkin()->getMenuItemPosition('portfolio');
            $menuIcon = $findme_elated_Framework->getSkin()->getMenuIcon('portfolio');

            if(isset($findme_elated_options['portfolio_single_slug'])) {
                if($findme_elated_options['portfolio_single_slug'] != ""){
                    $slug = $findme_elated_options['portfolio_single_slug'];
                }
            }
        }

        register_post_type( $this->base,
            array(
                'labels' => array(
                    'name'          => esc_html__( 'Elated Portfolio','eltd-core' ),
                    'singular_name' => esc_html__( 'Elated Portfolio Item','eltd-core' ),
                    'add_item'      => esc_html__( 'New Portfolio Item','eltd-core' ),
                    'add_new_item'  => esc_html__( 'Add New Portfolio Item','eltd-core' ),
                    'edit_item'     => esc_html__( 'Edit Portfolio Item','eltd-core' )
                ),
                'public'        => true,
                'has_archive'   => true,
                'rewrite'       => array('slug' => $slug),
                'menu_position' => $menuPosition,
                'show_ui'       => true,
                'supports'      => array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments'),
                'menu_icon'     =>  $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name'              => esc_html__('Portfolio Categories', 'eltd-core'),
            'singular_name'     => esc_html__('Portfolio Category', 'eltd-core'),
            'search_items'      => esc_html__('Search Portfolio Categories','eltd-core'),
            'all_items'         => esc_html__('All Portfolio Categories','eltd-core'),
            'parent_item'       => esc_html__('Parent Portfolio Category','eltd-core'),
            'parent_item_colon' => esc_html__('Parent Portfolio Category:','eltd-core'),
            'edit_item'         => esc_html__('Edit Portfolio Category','eltd-core'),
            'update_item'       => esc_html__('Update Portfolio Category','eltd-core'),
            'add_new_item'      => esc_html__('Add New Portfolio Category','eltd-core'),
            'new_item_name'     => esc_html__('New Portfolio Category Name','eltd-core'),
            'menu_name'         => esc_html__('Portfolio Categories','eltd-core')
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'query_var'         => true,
            'show_admin_column' => true,
            'rewrite'           => array('slug' => 'portfolio-category')
        ));
    }

    /**
     * Registers custom tag taxonomy with WordPress
     */
    private function registerTagTax() {
        $labels = array(
            'name'              => esc_html__('Portfolio Tags', 'eltd-core'),
            'singular_name'     => esc_html__('Portfolio Tag', 'eltd-core'),
            'search_items'      => esc_html__('Search Portfolio Tags','eltd-core'),
            'all_items'         => esc_html__('All Portfolio Tags','eltd-core'),
            'parent_item'       => esc_html__('Parent Portfolio Tag','eltd-core'),
            'parent_item_colon' => esc_html__('Parent Portfolio Tags:','eltd-core'),
            'edit_item'         => esc_html__('Edit Portfolio Tag','eltd-core'),
            'update_item'       => esc_html__('Update Portfolio Tag','eltd-core'),
            'add_new_item'      => esc_html__('Add New Portfolio Tag','eltd-core'),
            'new_item_name'     => esc_html__('New Portfolio Tag Name','eltd-core'),
            'menu_name'         => esc_html__('Portfolio Tags','eltd-core')
        );

        register_taxonomy('portfolio-tag', array($this->base), array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'query_var'         => true,
            'show_admin_column' => true,
            'rewrite'           => array('slug' => 'portfolio-tag')
        ));
    }
}