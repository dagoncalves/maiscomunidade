<?php if(findme_elated_options()->getOptionValue('portfolio_single_hide_date') === 'yes') : ?>
    <div class="eltd-ps-info-item eltd-ps-date">
        <h4 class="eltd-ps-info-title"><?php esc_html_e('Date:', 'eltd-core'); ?></h4>
        <p itemprop="dateCreated" class="eltd-ps-info-date entry-date updated"><?php the_time(get_option('date_format')); ?></p>
        <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(findme_elated_get_page_id()); ?>"/>
    </div>
<?php endif; ?>