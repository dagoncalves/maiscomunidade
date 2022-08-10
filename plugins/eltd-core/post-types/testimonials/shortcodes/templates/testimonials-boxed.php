<div class="eltd-testimonial-content" id="eltd-testimonials-<?php echo esc_attr($current_id) ?>"   <?php findme_elated_inline_style($box_styles); ?>>
    <?php if(has_post_thumbnail() || !empty($author)) { ?>
        <div class="eltd-testimonials-author-holder clearfix">
            <?php if(has_post_thumbnail()) { ?>
                <div class="eltd-testimonial-image">
                    <?php echo findme_elated_icon_collections()->renderIcon('fa-quote-right', 'font_awesome') ?>
                    <?php echo get_the_post_thumbnail(get_the_ID(), array(85, 85)); ?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="eltd-testimonial-text-holder">
        <?php if(!empty($title)) { ?>
            <h6 itemprop="name" class="eltd-testimonial-title entry-title"><?php echo esc_html($title); ?></h6>
        <?php } ?>
        <?php if(!empty($author)) { ?>
            <h4 class="eltd-testimonial-author"><span class="eltd-testimonial-author-inner"><?php echo esc_html($author); ?></span></h4>
            <?php if(!empty($website)) { ?>
                <h6 class="eltd-testimonials-website"><a href="<?php echo esc_url($website); ?>"><?php echo esc_html($website); ?></a></h6>
            <?php } ?>
        <?php } ?>
        <?php if(!empty($text)) { ?>
            <p class="eltd-testimonial-text"><?php echo esc_html($text); ?></p>
        <?php } ?>
    </div>
</div>