<?php
use ElatedListing\Archive;
if(!function_exists('eltd_listing_load_archive_templates')){
	/**
	 * load listing archive templates
	 */
	function eltd_listing_load_archive_templates(){
		new Archive\ArchiveTemplateLoader();
	}
	add_action('init' , 'eltd_listing_load_archive_templates');
}

if(!function_exists('eltd_listing_load_comment_template')){

	function eltd_listing_load_comment_template( $comment_template ) {
		global $post;
		if(isset($post) && $post->post_type === 'job_listing'){
			if ( !( is_singular() && ( have_comments() || 'open' == $post->comment_status ) ) ) {
				return;
			}
			return ELATED_LISTING_ABS_PATH.'/templates/comments.php';
		}else{
			return $comment_template;
		}

	}
	add_filter( 'comments_template', 'eltd_listing_load_comment_template');
}