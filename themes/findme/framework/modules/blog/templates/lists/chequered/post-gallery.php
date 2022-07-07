<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <a itemprop="url" class="eltd-blog-masonry-gallery-link" href="<?php the_permalink(); ?>"></a>
    <div class="eltd-post-content">
        <div class="eltd-post-heading">
            <?php findme_elated_get_module_template_part('templates/parts/post-type/gallery', 'blog', '', $part_params); ?>
        </div>
    </div>
</article>