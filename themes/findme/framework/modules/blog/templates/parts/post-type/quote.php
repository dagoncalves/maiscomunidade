<?php
$title_tag = isset($quote_tag) ? $quote_tag : 'h4';
$quote_text_meta = get_post_meta(get_the_ID(), "eltd_post_quote_text_meta", true );

$post_title = !empty($quote_text_meta) ? $quote_text_meta : get_the_title();

$post_author = get_post_meta(get_the_ID(), "eltd_post_quote_author_meta", true );
?>

<div class="eltd-post-quote-holder">
    <div class="eltd-post-quote-holder-inner">
        <<?php echo esc_attr($title_tag);?> itemprop="name" class="eltd-quote-title eltd-post-title">
        <?php if(findme_elated_blog_item_has_link()) { ?>
            <a itemprop="url" href="<?php echo get_the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php } ?>
            <?php echo esc_html($post_title); ?>
        <?php if(findme_elated_blog_item_has_link()) { ?>
            </a>
        <?php } ?>
        </<?php echo esc_attr($title_tag);?>>
        <?php if($post_author != '') { ?>
            <span class="eltd-quote-author">
                <?php echo esc_html($post_author); ?>
            </span>
        <?php } ?>
    </div>
</div>