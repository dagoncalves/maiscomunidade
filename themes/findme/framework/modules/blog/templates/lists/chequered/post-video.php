<?php
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
    <a itemprop="url" class="eltd-blog-masonry-gallery-link" href="<?php the_permalink(); ?>"></a>
    <div class="eltd-post-content">
        <div class="eltd-post-heading">
            <?php findme_elated_get_module_template_part('templates/parts/image', 'blog', '', $part_params); ?>
        </div>
        <a class="eltd-video-post-link" href="<?php echo esc_url($video_link); ?>"
           <?php if($video_link !== '#') { ?> data-rel="prettyPhoto[<?php the_ID(); ?>]" <?php } ?>>
            <?php echo findme_elated_icon_collections()->renderIcon('arrow_triangle-right_alt2', 'font_elegant', array('icon_attributes' => array('class' => 'eltd-vb-play-icon'))); ?>
        </a>
    </div>
</article>