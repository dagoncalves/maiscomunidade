<?php
use ElatedListing\Lib\Core;
if(!function_exists('eltd_listing_comment_additional_fields')) {

	function eltd_listing_comment_additional_fields() {

		if (is_singular('job_listing')) {
			$html = '<div class="eltd-rating-form-title-holder">'; //Form title begin
			$html .= '<div class="eltd-rating-form-title">';
			$html .= '<h4>' . esc_html__('Write a Review','eltd-listing') . '</h4>';
			$html .= '</div>';
			$html .= '<div class="eltd-comment-form-rating">
						<label>' . esc_html__('Rate Here', 'eltd-listing') . '<span class="required">*</span></label>
						<span class="eltd-comment-rating-box">';
			for ($i = 1; $i <= 5; $i++) {
				$html .= '<span class="eltd-star-rating" data-value="' . $i . '"></span>';
			}
			$html .= '<input type="hidden" name="eltd_rating" id="eltd-rating" value="3">';
			$html .= '</span></div>';
			$html .= '</div>'; //Form title end

			$html .= '<div class="eltd-comment-input-title">';
			$html .= '<input id="title" name="eltd_comment_title" class="eltd-input-field" type="text" placeholder="' . esc_html__('Title of your Review', 'eltd-listing') . '"/>';
			$html .= '</div>';

			echo findme_elated_get_module_part( $html );
		}
	}

	add_action( 'comment_form_top', 'eltd_listing_comment_additional_fields' );

}

if(!function_exists('eltd_listing_extend_comment_edit_metafields')) {

	function eltd_listing_extend_comment_edit_metafields($comment_id) {

		$comment = get_comment( $comment_id );
		$old_value = get_comment_meta($comment_id, 'eltd_rating', true);
		$post_id = $comment->comment_post_ID ;

		if ((!isset($_POST['extend_comment_update']) || !wp_verify_nonce($_POST['extend_comment_update'], 'extend_comment_update')) && !is_singular('job_listing')) return;

		if ((isset($_POST['eltd_comment_title'])) && ($_POST['eltd_comment_title'] != '')):
			$title = wp_filter_nohtml_kses($_POST['eltd_comment_title']);
			update_comment_meta($comment_id, 'eltd_comment_title', $title);
		else :
			delete_comment_meta($comment_id, 'eltd_comment_title');
		endif;

		if ((isset($_POST['eltd_rating'])) && ($_POST['eltd_rating'] != '')){
			$new_rating = wp_filter_nohtml_kses($_POST['eltd_rating']);
			update_comment_meta($comment_id, 'eltd_rating', $new_rating);

			$rating_obj = new Core\ListingRating($post_id, $new_rating, 'edit_rating', $old_value);
			$rating_obj->editRating();
		}
		else {
			delete_comment_meta($comment_id, 'eltd_rating');
		}
	}

	add_action('edit_comment', 'eltd_listing_extend_comment_edit_metafields');
}

if(!function_exists('eltd_listing_extend_comment_create_meta_box')) {

	function eltd_listing_extend_comment_create_meta_box() {
		add_meta_box('title', esc_html__('Comment - Reviews', 'eltd-listing'), 'eltd_listing_extend_comment_meta_box', 'comment', 'normal', 'high');
	}

	add_action('add_meta_boxes_comment', 'eltd_listing_extend_comment_create_meta_box');

}

if(!function_exists('eltd_listing_extend_comment_meta_box')) {

	function eltd_listing_extend_comment_meta_box($comment) {

		if ($comment->post_type == 'job_listing') {
			$title = get_comment_meta($comment->comment_ID, 'eltd_comment_title', true);
			$rating = get_comment_meta($comment->comment_ID, 'eltd_rating', true);
			wp_nonce_field('extend_comment_update', 'extend_comment_update', false);
			?>
			<p>
				<label for="title"><?php esc_html_e('Comment Title', 'eltd-listing'); ?></label>
				<input type="text" name="eltd_comment_title" value="<?php echo esc_attr($title); ?>" class="widefat"/>
			</p>
			<p>
				<label for="rating"><?php esc_html_e('Rating', 'eltd-listing'); ?>: </label>
				<span class="commentratingbox">
					<?php
					for ($i = 1; $i <= 5; $i++) {
						echo '<span class="commentrating"><input type="radio" name="eltd_rating" id="rating" value="' . $i . '"';
						if ($rating == $i) echo ' checked="checked"';
						echo ' />' . $i . ' </span>';
					}
					?>
				</span>
			</p>
			<?php
		}
	}
}

if(!function_exists('eltd_listing_save_comment_meta_data')) {

	function eltd_listing_save_comment_meta_data($comment_id) {

		$comment = get_comment( $comment_id );
		$post_id = $comment->comment_post_ID;

		if ((isset($_POST['eltd_comment_title'])) && ($_POST['eltd_comment_title'] != '')) {
			$title = wp_filter_nohtml_kses($_POST['eltd_comment_title']);
			add_comment_meta($comment_id, 'eltd_comment_title', $title);
		}

		if ((isset($_POST['eltd_rating'])) && ($_POST['eltd_rating'] != '')) {
			$rating = wp_filter_nohtml_kses($_POST['eltd_rating']);
			add_comment_meta($comment_id, 'eltd_rating', $rating);

			$rating_obj = new Core\ListingRating($post_id, $rating);
			$rating_obj->increaseRating();

		}

	}

	add_action('comment_post', 'eltd_listing_save_comment_meta_data');

}

if(!function_exists('eltd_listing_verify_comment_meta_data')) {

	function eltd_listing_verify_comment_meta_data($commentdata) {

		if ( is_singular('job_listing') ) {
			if (!isset($_POST['eltd_rating'])) {
				wp_die(esc_html__('Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.', 'eltd-listing'));
			}
		}
		return $commentdata;
	}

	add_filter('preprocess_comment', 'eltd_listing_verify_comment_meta_data');

}


if(!function_exists('eltd_listing_get_current_post_comments')){

	function eltd_listing_get_current_post_comments($post_id, $order_by = 'comment_date_gmt' , $order = 'desc'){

		$meta_key  = '';
		if($order_by === 'rating'){
			$order_by = 'meta_value';
			$meta_key  = 'eltd_rating';
		}elseif($order_by === 'date'){
			$order_by = 'comment_date_gmt';
		};

		$comment_args = array(
			'post_id' => $post_id,
			'status' => 'approve',
			'orderby' => $order_by,
			'meta_key'  => $meta_key,
			'order' => $order
		);
		if ( is_user_logged_in() ) {
			$comment_args['include_unapproved'] = get_current_user_id();
		} else {
			$commenter = wp_get_current_commenter();
			if ( $commenter['comment_author_email'] ) {
				$comment_args['include_unapproved'] = $commenter['comment_author_email'];
			}
		}

		$comments  = get_comments($comment_args);
		return $comments;

	}
}

if ( ! function_exists( 'eltd_listing_post_reviews_html' ) ) {

	function eltd_listing_post_reviews_html($reviews = array(), $post_id) {

		$post = get_post($post_id);
		$html = '';

		if(count($reviews)){

			foreach ($reviews as $comment){

				$is_pingback_comment = $comment->comment_type == 'pingback';
				$is_author_comment  = $post->post_author == $comment->user_id;

				$comment_class = 'eltd-comment clearfix';

				if($is_author_comment) {
					$comment_class .= ' eltd-post-author-comment';
				}

				if($is_pingback_comment) {
					$comment_class .= ' eltd-pingback-comment';
				}
				$review_rating = get_comment_meta( $comment->comment_ID, 'eltd_rating', true );
				$review_rating_style  = 'width: '.esc_attr($review_rating*20).'%';
				$review_title = get_comment_meta( $comment->comment_ID, 'eltd_comment_title', true );

				$comment_params = array(
					'comment'   => $comment,
					'is_pingback_comment' => $is_pingback_comment,
					'is_author_comment' => $is_author_comment,
					'comment_class' => $comment_class,
					'review_rating_style' => $review_rating_style,
					'review_title' => $review_title,
				);
				$html .= eltd_listing_single_template_part('review/review', '', $comment_params);

			}
		}
		return $html;
	}
}

if(!function_exists('eltd_listing_get_post_reviews_ajax')){

	function eltd_listing_get_post_reviews_ajax(){

		if(isset($_POST)) {
			$html = '';

			foreach($_POST as $key => $value) {
				if($key !== '') {
					$addUnderscoreBeforeCapitalLetter  = preg_replace('/([A-Z])/', '_$1', $key);
					$setAllLettersToLowercase          = strtolower($addUnderscoreBeforeCapitalLetter);
					$params[$setAllLettersToLowercase] = $value;
				}
			}
			extract($params);
			if(isset($order) && $order !== '' && isset($order_by) && $order_by !== '' && isset($post_id) && $post_id !== ''){
				$post_comments = eltd_listing_get_current_post_comments($post_id, $order_by, $order );
				ob_start();
				eltd_listing_post_reviews_html($post_comments, $post_id);
				$html = ob_get_clean();
			}

			$return_obj = array(
				'html' => $html
			);
			echo json_encode($return_obj); exit;
		}

	}

	add_action('wp_ajax_nopriv_eltd_listing_get_post_reviews_ajax', 'eltd_listing_get_post_reviews_ajax');
	add_action( 'wp_ajax_eltd_listing_get_post_reviews_ajax', 'eltd_listing_get_post_reviews_ajax' );
}


if ( ! function_exists( 'eltd_rating_criteria' ) ) {
    function eltd_rating_criteria($post_type = '') {
        $rating_criteria = array();
        $global_rating   = array(
            'key'   => 'eltd_rating',
            'label' => esc_html__( 'Rating', 'eltd-listing' ),
            'show'  => true
        );

        $rating_criteria[] = $global_rating;

        $rating_criteria = apply_filters( 'eltd_rating_criteria', $rating_criteria, $post_type );

        return $rating_criteria;
    }
}