<?php
if ( post_password_required() ) { ?>

	<p class="eltd-no-password">
		<?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'eltd-listing' ); ?>
	</p>

<?php }
else {
	if ( have_comments() ) { ?>

		<div class="eltd-comment-holder clearfix" id="comments">

			<div class="eltd-comment-holder-inner">
				<div class="eltd-comments-title">
                    <h4>
                        <?php esc_html_e('Latest Property Reviews', 'eltd-listing' ); ?>
                    </h4>

                    <select name="eltd-ls-single-sort" class="eltd-ls-single-sort">
                        <option value="date-desc"><?php esc_html_e('Newer First', 'eltd-listing'); ?></option>
                        <option value="date-asc"><?php esc_html_e('Older First', 'eltd-listing'); ?></option>
                        <option value="rating-desc"><?php esc_html_e('Rating (High-Low)', 'eltd-listing'); ?></option>
                        <option value="rating-asc"><?php esc_html_e('Rating (Low-High)', 'eltd-listing'); ?></option>
                    </select>

				</div>
				<div class="eltd-comments">
					<ul class="eltd-comment-list">
						<?php
                            $post_comments = eltd_listing_get_current_post_comments(get_the_ID());
                            echo eltd_listing_post_reviews_html($post_comments, get_the_ID());
						?>
					</ul>
				</div>
			</div>

		</div>

	<?php }

	else {
		if ( ! comments_open() ) { ?>
			<p>
				<?php esc_html_e('Sorry, the comment form is closed at this time.', 'eltd-listing'); ?>
			</p>
		<?php }
	}
}
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$args = array(
	'id_form' => 'commentform',
	'id_submit' => 'submit_comment',
	'title_reply'=> esc_html__( 'POST A COMMENT','eltd-listing' ),
	'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
	'title_reply_after' => '</h4>',
	'title_reply_to' => esc_html__( 'Post a Reply to %s','eltd-listing' ),
	'cancel_reply_link' => esc_html__( 'cancel reply','eltd-listing' ),
	'label_submit' => esc_html__( 'Send Message','eltd-listing' ),
	'comment_field' => '<label>' . esc_html__('Write Your Message','eltd-listing') . '</label><textarea id="comment" placeholder="'.esc_html__( 'Your comment','eltd-listing' ).'" name="comment" cols="45" rows="6" aria-required="true"></textarea>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<label>' . esc_html__('Your Full Name','eltd-listing') . '</label><input id="author" name="author" placeholder="'. esc_html__( 'Your Name','eltd-listing' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />',
			'email' => '<label>' . esc_html__('Your E-mail Address','eltd-listing') . '</label><input id="email" name="email" placeholder="'. esc_html__( 'Your Email','eltd-listing' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' />'
		)
	)
);
$args['comment_field'] = '<textarea id="comment" placeholder="'.esc_html__( 'Your Experience','eltd-listing' ).'" name="comment" cols="45" rows="8" aria-required="true"></textarea>';
$args['fields'] = apply_filters( 'comment_form_default_fields', array(
        'author' => '<input id="author" name="author" placeholder="'. esc_html__( 'Your full name','eltd-listing' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />',
        'url' => '<input id="email" name="email" placeholder="'. esc_html__( 'E-mail address','eltd-listing' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' />',
    )
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

			<?php
			    comment_form($args);
			?>
		</div>
	</div>
<?php }