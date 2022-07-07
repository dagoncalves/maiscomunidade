<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php
    /**
     * findme_elated_header_meta hook
     *
     * @see findme_elated_header_meta() - hooked with 10
     * @see findme_elated_user_scalable_meta - hooked with 10
     */
    do_action('findme_elated_header_meta');

    wp_head(); ?>
</head>
<body <?php body_class();?> itemscope itemtype="http://schema.org/WebPage">
    <?php
    /**
     * findme_elated_after_body_tag hook
     *
     * @see findme_elated_get_side_area() - hooked with 10
     * @see findme_elated_smooth_page_transitions() - hooked with 10
     */
    do_action('findme_elated_after_body_tag'); ?>

    <div class="eltd-wrapper">
        <div class="eltd-wrapper-inner">
            <?php findme_elated_get_header(); ?>
	
	        <?php
	        /**
	         * findme_elated_after_header_area hook
	         *
	         * @see findme_elated_back_to_top_button() - hooked with 10
	         * @see findme_elated_get_full_screen_menu() - hooked with 10
	         */
	        do_action('findme_elated_after_header_area'); ?>
	        
            <div class="eltd-content" <?php findme_elated_content_elem_style_attr(); ?>>
                <div class="eltd-content-inner">