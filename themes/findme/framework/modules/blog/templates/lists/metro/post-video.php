<?php
$image_proportion = findme_elated_get_meta_field_intersect('blog_list_featured_image_proportion', findme_elated_get_page_id());
$image_proportion_value = get_post_meta(get_the_ID(), 'eltd_blog_masonry_gallery_' . $image_proportion .'_dimensions_meta', true);

if (isset($image_proportion_value) && $image_proportion_value !== '') {
    $size = $image_proportion_value !== '' ? $image_proportion_value : 'default';
    $post_classes[] = 'eltd-post-size-'. $size;
}
else {
    $size = 'default';
    $post_classes[] = 'eltd-post-size-default';
}
if($image_proportion == 'original') {
    $part_params['featured_image_size'] = 'full';
}
else {
    switch ($size):
        case 'default':
            $part_params['featured_image_size'] = 'findme_elated_square';
            break;
        case 'large-width':
            $part_params['featured_image_size'] = 'findme_elated_landscape';
            break;
        case 'large-height':
            $part_params['featured_image_size'] = 'findme_elated_portrait';
            break;
        case 'large-width-height':
            $part_params['featured_image_size'] = 'findme_elated_huge';
            break;
        default:
            $part_params['featured_image_size'] = 'findme_elated_square';
            break;
    endswitch;
}

$video_link = '#';
$video_type = get_post_meta(get_the_ID(), "eltd_video_type_meta", true);
if ($video_type == 'social_networks') {
    $video_link_meta =  get_post_meta(get_the_ID(), "eltd_post_video_link_meta", true);
    $video_link = $video_link_meta !== '' ? $video_link_meta : '#';
} elseif ($video_type == "self") {
    $video_link_meta =  get_post_meta(get_the_ID(), "eltd_post_video_custom_meta", true);
    $video_link = $video_link_meta !== '' ? get_post_meta(get_the_ID(), "eltd_post_video_custom_meta", true) . '?iframe=true&width50%&height=50%' : '#';
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
        <?php findme_elated_get_module_template_part('templates/parts/image', 'blog', '', $part_params); ?>
        <div class="eltd-post-info">
            <?php findme_elated_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
            <?php findme_elated_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
        </div>
        <a class="eltd-video-post-link" href="<?php echo esc_uel($video_link); ?>"
            <?php if($video_link !== '#') { ?> data-rel="prettyPhoto[<?php the_ID(); ?>]" <?php } ?>>
            <?php echo findme_elated_icon_collections()->renderIcon('arrow_triangle-right_alt2', 'font_elegant', array('icon_attributes' => array('class' => 'eltd-vb-play-icon'))); ?>
        </a>
</article>