<?php
namespace ElatedCore\CPT\Shortcodes\BlogCarousel;

use ElatedCore\Lib;

class BlogCarousel implements Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'eltd_blog_carousel';

        add_action('vc_before_init', array($this,'vcMap'));

        //Category filter
        add_filter( 'vc_autocomplete_eltd_blog_carousel_category_callback', array( &$this, 'blogListCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

        //Category render
        add_filter( 'vc_autocomplete_eltd_blog_carousel_category_render', array( &$this, 'blogListCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
    }

    public function getBase() {
        return $this->base;
    }
    
    public function vcMap() {
        vc_map( array(
            'name' => esc_html__('Elated Blog Carousel', 'findme'),
            'base' => $this->base,
            'icon' => 'icon-wpb-blog-carousel extended-custom-icon',
            'category' => esc_html__('by ELATED', 'findme'),
            'allowed_container_element' => 'vc_row',
            'params' => array(
                array(
                    'type'       => 'textfield',
                    'param_name' => 'number_of_posts',
                    'heading'    => esc_html__('Number of Posts', 'findme')
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'order_by',
                    'heading'     => esc_html__('Order By', 'findme'),
                    'value'       => array_flip(findme_elated_get_query_order_by_array()),
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'order',
                    'heading'     => esc_html__('Order', 'findme'),
                    'value'       => array_flip(findme_elated_get_query_order_array()),
                    'save_always' => true
                ),
                array(
                    'type'        => 'autocomplete',
                    'param_name'  => 'category',
                    'heading'     => esc_html__('Category', 'findme'),
                    'description' => esc_html__('Enter one category slug (leave empty for showing all categories)', 'findme')
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'image_size',
                    'heading'    => esc_html__('Image Size', 'findme'),
                    'value'      => array(
                        esc_html__('Original', 'findme') => 'full',
                        esc_html__('Square', 'findme') => 'square',
                        esc_html__('Landscape', 'findme') => 'landscape',
                        esc_html__('Portrait', 'findme') => 'portrait',
                        esc_html__('Medium', 'findme') => 'medium',
                        esc_html__('Large', 'findme') => 'large'
                    )
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'title_tag',
                    'heading'     => esc_html__('Title Tag', 'findme'),
                    'value'       => array_flip(findme_elated_get_title_tag(true)),
                    'group'       => esc_html__('Post Info', 'findme')
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'post_info_date',
                    'heading'     => esc_html__('Enable Post Info Date', 'findme'),
                    'value'       => array_flip(findme_elated_get_yes_no_select_array(false, true)),
                    'dependency'  => Array('element' => 'post_info_section', 'value' => array('yes')),
                    'group'       => esc_html__('Post Info', 'findme'),
                    'save_always' => true
                ),
                array(
                    'type'        => 'textfield',
                    'param_name'  => 'excerpt_length',
                    'heading'     => esc_html__('Text length', 'findme'),
                    'description' => esc_html__('Number of words', 'findme'),
                    'group'       => esc_html__('Post Info', 'findme')
                ),
            )
        ) );
    }
    
    public function render($atts, $content = null) {
        $default_atts = array(
            'number_of_posts' => '-1',
            'order_by' => 'title',
            'order' => 'ASC',
            'category' => '',
            'image_size' => 'full',
            'title_tag' => 'h2',
            'post_info_date' => 'yes',
            'excerpt_length' => ''
        );

        $params = shortcode_atts($default_atts, $atts);
        extract($params);

        $queryArray = $this->generateBlogQueryArray($params);
        $query_result = new \WP_Query($queryArray);
        $params['query_result'] = $query_result;
	
	    $params['carousel_data']      = $this->getCarouselData($params);
        $params['thumb_image_size'] = $this->generateImageSize($params);

        ob_start();

        findme_elated_get_module_template_part('shortcodes/blog-carousel/holder', 'blog', '', $params);

        $html = ob_get_contents();

        ob_end_clean();

        return $html;
    }

    /**
     * Generates query array
     *
     * @param $params
     *
     * @return array
     */
    public function generateBlogQueryArray($params){
        $queryArray = array(
            'post_status'    => 'publish',
            'post_type'      => 'post',
            'orderby'        => $params['order_by'],
            'order'          => $params['order'],
            'posts_per_page' => $params['number_of_posts'],
            'post__not_in'   => get_option('sticky_posts')
        );

        if(!empty($params['category'])){
            $queryArray['category_name'] = $params['category'];
        }

        return $queryArray;
    }
	
	/**
	 * Return all configuration data for carousel
	 *
	 * @param $params
	 * @return array
	 */
	private function getCarouselData($params) {
		$carousel_data = array();
		
		$carousel_data['data-number-of-items']   = '1';
		$carousel_data['data-slider-margin']   = '15';
		$carousel_data['data-enable-center']     = 'yes';
		$carousel_data['data-enable-navigation'] = 'yes';
		$carousel_data['data-enable-pagination'] = 'no';
		
		return $carousel_data;
	}

    /**
     * Generates image size option
     *
     * @param $params
     *
     * @return string
     */
    private function generateImageSize($params){
        $thumb_size = '';
        $image_size = $params['image_size'];

        switch ($image_size) {
            case 'landscape':
                $thumb_size = 'findme_elated_landscape';
                break;
            case 'portrait':
                $thumb_size = 'findme_elated_portrait';
                break;
            case 'square':
                $thumb_size = 'findme_elated_square';
                break;
            case 'medium':
                $thumb_size = 'medium';
                break;
            case 'large':
                $thumb_size = 'large';
                break;
            case 'full':
                $thumb_size = 'full';
                break;
        }

        return $thumb_size;
    }

    /**
     * Filter categories
     *
     * @param $query
     *
     * @return array
     */
    public function blogListCategoryAutocompleteSuggester( $query ) {
        global $wpdb;
        $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

        $results = array();
        if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
            foreach ( $post_meta_infos as $value ) {
                $data          = array();
                $data['value'] = $value['slug'];
                $data['label'] = ( ( strlen( $value['category_title'] ) > 0 ) ? esc_html__( 'Category', 'findme' ) . ': ' . $value['category_title'] : '' );
                $results[]     = $data;
            }
        }

        return $results;
    }

    /**
     * Find categories by slug
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function blogListCategoryAutocompleteRender( $query ) {
        $query = trim( $query['value'] ); // get value from requested
        if ( ! empty( $query ) ) {
            // get category
            $category = get_term_by( 'slug', $query, 'category' );
            if ( is_object( $category ) ) {

                $category_slug = $category->slug;
                $category_title = $category->name;

                $category_title_display = '';
                if ( ! empty( $category_title ) ) {
                    $category_title_display = esc_html__( 'Category', 'findme' ) . ': ' . $category_title;
                }

                $data          = array();
                $data['value'] = $category_slug;
                $data['label'] = $category_title_display;

                return ! empty( $data ) ? $data : false;
            }

            return false;
        }

        return false;
    }
}
