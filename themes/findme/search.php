<?php
$eltd_sidebar_layout = findme_elated_sidebar_layout();

get_header();
findme_elated_get_title();
?>
<div class="eltd-container">
    <?php do_action('findme_elated_after_container_open'); ?>
    <div class="eltd-container-inner clearfix">
        <div class="eltd-container">
            <?php do_action('findme_elated_after_container_open'); ?>
            <div class="eltd-container-inner">
	            <div class="eltd-grid-row">
		            <div <?php echo findme_elated_get_content_sidebar_class(); ?>>
                        <div class="eltd-search-page-holder">
                            <form action="<?php echo esc_url(home_url('/')); ?>" class="eltd-search-page-form" method="get">
                                <h2 class="eltd-search-title"><?php esc_html_e('Search results:', 'findme'); ?></h2>
                                <div class="eltd-form-holder">
                                    <div class="eltd-column-left">
                                        <input type="text" name="s" class="eltd-search-field" autocomplete="off" value="" placeholder="<?php esc_attr_e('Type here', 'findme'); ?>"/>
                                    </div>
                                    <div class="eltd-column-right">
                                        <button type="submit" class="eltd-search-submit"><span class="icon_search"></span></button>
                                    </div>
                                </div>
                                <div class="eltd-search-label">
                                    <?php esc_html_e("If you are not happy with the results below please do another search", "findme"); ?>
                                </div>
                            </form>
                            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="eltd-post-content">
                                        <?php if (has_post_thumbnail()) { ?>
                                            <div class="eltd-post-image">
                                                <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                    <?php the_post_thumbnail('thumbnail'); ?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                        <div class="eltd-post-title-area <?php if (!has_post_thumbnail()) { echo esc_attr('eltd-no-thumbnail'); } ?>">
                                            <div class="eltd-post-title-area-inner">
                                                <h4 itemprop="name" class="eltd-post-title entry-title">
                                                    <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                </h4>
                                                <?php
                                                $eltd_my_excerpt = get_the_excerpt();
                                                if ($eltd_my_excerpt != '') { ?>
                                                    <p itemprop="description" class="eltd-post-excerpt"><?php echo esc_html($eltd_my_excerpt); ?></p>
                                                <?php }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                            <?php else: ?>
                                <p class="eltd-blog-no-posts"><?php esc_html_e('No posts were found.', 'findme'); ?></p>
                            <?php endif; ?>
                            <?php
                                if ( get_query_var('paged') ) { $eltd_paged = get_query_var('paged'); }
                                elseif ( get_query_var('page') ) { $eltd_paged = get_query_var('page'); }
                                else { $eltd_paged = 1; }

                                $eltd_params['max_num_pages'] = findme_elated_get_max_number_of_pages();
                                $eltd_params['paged'] = $eltd_paged;
                                findme_elated_get_module_template_part('templates/parts/pagination/standard', 'blog', '', $eltd_params);
                            ?>
                        </div>
                        <?php do_action('findme_elated_page_after_content'); ?>
                    </div>
		            <?php if($eltd_sidebar_layout !== 'no-sidebar') { ?>
			            <div <?php echo findme_elated_get_sidebar_holder_class(); ?>>
				            <?php get_sidebar(); ?>
			            </div>
		            <?php } ?>
                </div>
				<?php do_action('findme_elated_before_container_close'); ?>
            </div>
        </div>
    </div>
    <?php do_action('findme_elated_before_container_close'); ?>
</div>
<?php get_footer(); ?>