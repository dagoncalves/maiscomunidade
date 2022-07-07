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
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <?php findme_elated_get_module_template_part('templates/parts/post-type/gallery', 'blog', '', $part_params); ?>
</article>