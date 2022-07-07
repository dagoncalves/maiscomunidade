<?php

class FindmeElatedSearchOpener extends FindmeElatedWidget {
    public function __construct() {
        parent::__construct(
            'eltd_search_opener',
	        esc_html__('Elated Search Opener', 'findme'),
	        array( 'description' => esc_html__( 'Display a "search" icon that opens the search form', 'findme'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
	            'type'        => 'textfield',
	            'name'        => 'search_icon_size',
                'title'       => esc_html__('Icon Size (px)', 'findme'),
                'description' => esc_html__('Define size for search icon', 'findme')
            ),
            array(
	            'type'        => 'textfield',
	            'name'        => 'search_icon_color',
                'title'       => esc_html__('Icon Color', 'findme'),
                'description' => esc_html__('Define color for search icon', 'findme')
            ),
            array(
	            'type'        => 'textfield',
	            'name'        => 'search_icon_hover_color',
                'title'       => esc_html__('Icon Hover Color', 'findme'),
                'description' => esc_html__('Define hover color for search icon', 'findme')
            ),
	        array(
		        'type' => 'textfield',
		        'name' => 'search_icon_margin',
		        'title' => esc_html__('Icon Margin', 'findme'),
		        'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'findme')
	        ),
            array(
	            'type'        => 'dropdown',
	            'name'        => 'show_label',
                'title'       => esc_html__('Enable Search Icon Text', 'findme'),
                'description' => esc_html__('Enable this option to show search text next to search icon in header', 'findme'),
                'options'     => findme_elated_get_yes_no_select_array()
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {
        global $findme_elated_options, $findme_elated_IconCollections;

	    $search_type_class    = 'eltd-search-opener eltd-icon-has-hover';
	    $styles = array();
	    $show_search_text     = $instance['show_label'] == 'yes' || $findme_elated_options['enable_search_icon_text'] == 'yes' ? true : false;

	    if(!empty($instance['search_icon_size'])) {
		    $styles[] = 'font-size: '.intval($instance['search_icon_size']).'px';
	    }

	    if(!empty($instance['search_icon_color'])) {
		    $styles[] = 'color: '.$instance['search_icon_color'].';';
	    }

	    if (!empty($instance['search_icon_margin'])) {
		    $styles[] = 'margin: ' . $instance['search_icon_margin'].';';
	    }
	    ?>

	    <a <?php findme_elated_inline_attr($instance['search_icon_hover_color'], 'data-hover-color'); ?> <?php findme_elated_inline_style($styles); ?>
		    <?php findme_elated_class_attribute($search_type_class); ?> href="javascript:void(0)">
            <span class="eltd-search-opener-wrapper">
                <?php if(isset($findme_elated_options['search_icon_pack'])) {
	                $findme_elated_IconCollections->getSearchIcon($findme_elated_options['search_icon_pack'], false);
                } ?>
	            <?php if($show_search_text) { ?>
		            <span class="eltd-search-icon-text"><?php esc_html_e('Search', 'findme'); ?></span>
	            <?php } ?>
            </span>
	    </a>
    <?php }
}