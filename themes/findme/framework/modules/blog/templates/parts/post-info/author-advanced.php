<div class="eltd-post-info-author">
    <div class="eltd-post-author-wrapper">
        <?php echo findme_elated_kses_img(get_avatar(get_the_author_meta( 'ID' ))); ?>
    </div>
    <div class="eltd-post-info-holder">
        <div itemprop="dateCreated" class="eltd-post-info-date entry-date published updated">
            <?php if(empty($title) && findme_elated_blog_item_has_link()) { ?>
            <a itemprop="url" href="<?php the_permalink() ?>">
                <?php } else { ?>
                <a itemprop="url" href="<?php echo get_month_link($year, $month); ?>">
                    <?php } ?>
                    <?php the_time(get_option('date_format')); ?>
                </a>
                <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(findme_elated_get_page_id()); ?>"/>
        </div>
        <div class="eltd-post-info-author-holder">
            <span class="eltd-post-info-author-text">
                <?php esc_html_e('By', 'findme'); ?>
            </span>
            <a itemprop="author" class="eltd-post-info-author-link" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
                <?php the_author_meta('display_name'); ?>
            </a>
        </div>
    </div>
</div>