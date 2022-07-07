<?php if(comments_open()) { ?>
    <div class="eltd-post-info-comments-holder">
        <a itemprop="url" class="eltd-post-info-comments" href="<?php comments_link(); ?>" target="_self">
            <?php echo findme_elated_icon_collections()->renderIcon('icon-speech', 'simple_line_icons'); ?>
            <?php comments_number('0', '1', '%'); ?>
        </a>
    </div>
<?php } ?>