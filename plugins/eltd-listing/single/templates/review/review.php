<li itemprop="review" itemscope itemtype="http://schema.org/Review">
	<div class="<?php echo esc_attr($comment_class); ?>">

		<?php if(!$is_pingback_comment) {
		    ?>

            <div class="eltd-comment-author">

                <div class="eltd-comment-image" itemprop="author" itemscope itemtype="http://schema.org/Person">
                    <?php echo findme_elated_kses_img(get_avatar($comment, 98)); ?>
                </div>

            </div>

		<?php } ?>

		<div class="eltd-comment-text">

			<div class="eltd-comment-info">
				<?php
				$review_rating = get_comment_meta( $comment->comment_ID, 'eltd_rating', true );
				$review_title = get_comment_meta( $comment->comment_ID, 'eltd_comment_title', true );
				?>

				<div class="eltd-review-title">
					<span>"<?php echo esc_html( $review_title ); ?>"</span>
				</div>

                <div class="eltd-comment-author-name">
                    <a itemprop="author" class="eltd-post-info-author-link" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
                        <?php
                        echo wp_kses_post($comment->comment_author);
                        ?>
                    </a>
                </div>

			</div>

			<?php if(!$is_pingback_comment) { ?>

				<div class="eltd-text-holder" id="comment-<?php echo findme_elated_get_module_part( $comment->comment_ID ); ?>"  itemprop="reviewBody">
					<?php echo findme_elated_get_module_part( $comment->comment_content ); ?>
				</div>

				<?php
					$commentMetaDate = $comment->comment_date_gmt;
				?>

                <div class="eltd-average-rating">
					<span>
						<?php echo esc_attr($review_rating);?>
					</span>
                </div>

                <div class="eltd-review-rating">
                    <span class="rating-inner" <?php echo findme_elated_get_inline_style($review_rating_style) ?>></span>
                </div>

				<div class="eltd-comment-bottom-info">
					<span class="eltd-comment-date" itemprop="datePublished" content="<?php echo esc_attr($commentMetaDate); ?>">
						<?php echo human_time_diff(strtotime($commentMetaDate), current_time('timestamp')) . ' ' . esc_html__('ago', 'cityrama'); ?>
					</span>
				</div>

			<?php } ?>
		</div>
	</div>
</li>