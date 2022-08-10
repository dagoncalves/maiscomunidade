<div class="eltd-testimonial-content" id="eltd-testimonials-<?php echo esc_attr($current_id) ?>">
    <div class="eltd-testimonial-text-holder">
        <?php if(!empty($title)) { ?>
            <h2 itemprop="name" class="eltd-testimonial-title entry-title"><?php echo esc_html($title); ?></h2>
            <div class="eltd-testimonials-separator"></div>
        <?php } ?>
        <?php if(!empty($author)) { ?>
            <h4 class="eltd-testimonial-author"><?php echo esc_html($author); ?></h4>
            <?php if(!empty($address)) { ?>
                <span class="eltd-testimonial-address"><?php echo esc_html($address); ?></span>
            <?php } ?>
        <?php } ?>
    </div>
</div>