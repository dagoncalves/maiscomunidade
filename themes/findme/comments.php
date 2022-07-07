<?php
$comment_number  = get_comments_number();

if ( post_password_required() ) { ?>

	<p class="eltd-no-password">
		<?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'findme' ); ?>
	</p>

<?php }
else {

	if ( have_comments() ) {
	    ?>

		<div class="eltd-comment-holder clearfix" id="comments">

			<div class="eltd-comment-holder-inner">
				<div class="eltd-comment-number">
                    <h4>
                        <?php
                            comments_number();
                         ?>
                    </h4>
                </div>
                <div class="eltd-comments">
                    <ul class="eltd-comment-list">
						<?php
							wp_list_comments(array( 'callback' => 'findme_elated_comment'));
						?>
					</ul>
				</div>
			</div>

		</div>

	<?php }

	else {

		if ( ! comments_open() ) { ?>
			<p>
				<?php esc_html_e('Sorry, the comment form is closed at this time.', 'findme'); ?>
			</p>
		<?php }
	}
}
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$eltd_consent  = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

$button_params  = array(
	'text' => esc_html__('Write Your Review', 'findme'),
	'custom_class' => 'eltd-rating-form-trigger',
	'type' => 'solid',
	'html_type' => 'button',
	'fullwidth' => 'yes',
    'background_color' => '#2c84cc'
);

$args = array(
	'id_form' => 'commentform',
	'id_submit' => 'submit_comment',
	'title_reply'=> esc_html__( '','findme' ),
	'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
	'title_reply_after' => '</h4>',
	'title_reply_to' => esc_html__( 'Post a Reply to %s','findme' ),
	'cancel_reply_link' => esc_html__( 'cancel reply','findme' ),
	'label_submit' => esc_html__( 'Submit your Review','findme' ),
	'comment_field' => '<textarea id="comment" placeholder="'.esc_attr__( 'Your comment*','findme' ).'" name="comment" cols="45" rows="6" aria-required="true"></textarea>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<input id="author" name="author" placeholder="'. esc_attr__( 'Your Name*','findme' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />',
			'email' => '<input id="email" name="email" placeholder="'. esc_attr__( 'Your E-mail Address*','findme' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' />',
			'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $eltd_consent . ' />' .
                    '<label for="wp-comment-cookies-consent">' . esc_attr__( 'Save my name, email, and website in this browser for the next time I comment.', 'findme' ) . '</label></p>',
		)
	),
	


);

if(get_comment_pages_count() > 1){ ?>
	<div class="eltd-comment-pager">
		<p>
			<?php paginate_comments_links(); ?>
		</p>
	</div>
<?php }

if(comments_open()) {
	$log_class = '';
	if ( is_user_logged_in() ) {
		$log_class = 'logged-in';
	}
	?>
	<div class="eltd-comment-form  <?php echo esc_attr($log_class);?>" >
		<div class="eltd-comment-form-inner">
			<?php comment_form($args); ?>
		</div>
	</div>
<?php }