<?php
$featured_image_size = isset($featured_image_size) ? $featured_image_size : 'full';
$featured_image_meta = get_post_meta(get_the_ID(), 'eltd_blog_list_featured_image_meta', true);
$image_url = $image_style = '';

if($featured_image_meta !== ''){
	$image_url = $featured_image_meta;
}
else{
	$image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
}

if($image_url && $image_url !== ''){
	$image_style = 'background-image: url('.esc_url($image_url).')';
}


$has_featured = false;
if($image_url && $image_url !== ''){
	$has_featured = true;
}


?>

<?php if ( $has_featured ) { ?>

    <div class="eltd-post-image">
        <div class="eltd-post-image-inner" <?php echo findme_elated_get_inline_style($image_style);?> >

            <?php if(findme_elated_blog_item_has_link()) { ?>

                <a class="mkg-blog-simple-overlay" itemprop="url" href="<?php echo get_the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>

            <?php } ?>

        </div>
    </div>

<?php }