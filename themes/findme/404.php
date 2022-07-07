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
	
	<div class="eltd-wrapper eltd-404-page">
	    <div class="eltd-wrapper-inner">
		    <?php findme_elated_get_header(); ?>
		    
			<div class="eltd-content" <?php findme_elated_content_elem_style_attr(); ?>>
	            <div class="eltd-content-inner">
					<div class="eltd-page-not-found">

                        <?php
							$eltd_title_image_404 = findme_elated_options()->getOptionValue('404_page_title_image');
							$eltd_title_404       = findme_elated_options()->getOptionValue('404_title');
							$eltd_subtitle_404    = findme_elated_options()->getOptionValue('404_subtitle');
							$eltd_text_404        = findme_elated_options()->getOptionValue('404_text');
							$eltd_button_label    = findme_elated_options()->getOptionValue('404_back_to_home');
						?>

						<?php if (!empty($eltd_title_image_404)) { ?>
							<div class="eltd-404-title-image"><img src="<?php echo esc_url($eltd_title_image_404); ?>" alt="<?php esc_attr_e('404 Title Image', 'findme'); ?>" /></div>
						<?php } ?>

						<h1 class="eltd-page-not-found-title">
							<?php if(!empty($eltd_title_404)) {
								echo esc_html($eltd_title_404);
							} else {
								esc_html_e('404', 'findme');
							} ?>
						</h1>

						<h3 class="eltd-page-not-found-subtitle">
							<?php if(!empty($eltd_subtitle_404)){
								echo esc_html($eltd_subtitle_404);
							} else {
								esc_html_e('Page not found', 'findme');
							} ?>
						</h3>

						<p class="eltd-page-not-found-text">
							<?php if(!empty($eltd_text_404)){
								echo esc_html($eltd_text_404);
							} else {
								esc_html_e('Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'findme');
							} ?>
						</p>

						<?php
							$eltd_params = array();
							$eltd_params['text'] = !empty($eltd_button_label) ? $eltd_button_label : esc_html__('Back To Home', 'findme');
							$eltd_params['link'] = esc_url(home_url('/'));
							$eltd_params['target'] = '_self';
							$eltd_params['size'] = 'large';

						echo findme_elated_execute_shortcode('eltd_button',$eltd_params);?>
					</div>
				</div>	
			</div>
		</div>
	</div>		
	<?php wp_footer(); ?>
</body>
</html>