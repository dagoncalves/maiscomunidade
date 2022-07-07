<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <a itemprop="url" class="eltd-blog-masonry-gallery-link" href="<?php the_permalink(); ?>"></a>
    <div class="eltd-post-content">
        <div class="eltd-post-heading">
            <?php findme_elated_get_module_template_part('templates/parts/image', 'blog', '', $part_params); ?>
            <?php findme_elated_get_module_template_part('templates/parts/post-type/audio', 'blog', '', $part_params); ?>
        </div>
        <?php echo findme_elated_icon_collections()->renderIcon('icon_music', 'font_elegant', array('icon_attributes' => array('class' => 'eltd-vb-play-icon'))); ?>
    </div>
</article>