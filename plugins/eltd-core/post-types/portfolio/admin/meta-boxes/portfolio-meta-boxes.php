<?php

if (!function_exists('eltd_core_map_portfolio_meta')) {
    function eltd_core_map_portfolio_meta() {
        global $findme_elated_Framework;

        $eltd_pages = array();
        $pages = get_pages();
        foreach ($pages as $page) {
            $eltd_pages[$page->ID] = $page->post_title;
        }

        //Portfolio Images

        $eltdPortfolioImages = new FindmeElatedMetaBox('portfolio-item', esc_html__('Portfolio Images (multiple upload)', 'eltd-core'), '', '', 'portfolio_images');
        $findme_elated_Framework->eltdMetaBoxes->addMetaBox('portfolio_images', $eltdPortfolioImages);

        $eltd_portfolio_image_gallery = new FindmeElatedMultipleImages('eltd-portfolio-image-gallery', esc_html__('Portfolio Images', 'eltd-core'), esc_html__('Choose your portfolio images', 'eltd-core'));
        $eltdPortfolioImages->addChild('eltd-portfolio-image-gallery', $eltd_portfolio_image_gallery);

        //Portfolio Images/Videos 2

        $eltdPortfolioImagesVideos2 = new FindmeElatedMetaBox('portfolio-item', esc_html__('Portfolio Images/Videos (single upload)', 'eltd-core'));
        $findme_elated_Framework->eltdMetaBoxes->addMetaBox('portfolio_images_videos2', $eltdPortfolioImagesVideos2);

        $eltd_portfolio_images_videos2 = new FindmeElatedImagesVideosFramework('', '');
        $eltdPortfolioImagesVideos2->addChild('eltd_portfolio_images_videos2', $eltd_portfolio_images_videos2);

        //Portfolio Additional Sidebar Items

        $eltdAdditionalSidebarItems = findme_elated_create_meta_box(
            array(
                'scope' => array('portfolio-item'),
                'title' => esc_html__('Additional Portfolio Sidebar Items', 'eltd-core'),
                'name' => 'portfolio_properties'
            )
        );

        $eltd_portfolio_properties = findme_elated_add_options_framework(
            array(
                'label' => esc_html__('Portfolio Properties', 'eltd-core'),
                'name' => 'eltd_portfolio_properties',
                'parent' => $eltdAdditionalSidebarItems
            )
        );
    }

    add_action('findme_elated_meta_boxes_map', 'eltd_core_map_portfolio_meta', 40);
}