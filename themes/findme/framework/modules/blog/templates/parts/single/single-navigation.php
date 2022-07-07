<?php
$blog_single_navigation = findme_elated_options()->getOptionValue('blog_single_navigation') === 'no' ? false : true;
$blog_navigation_through_same_category = findme_elated_options()->getOptionValue('blog_navigation_through_same_category') === 'no' ? false : true;
?>
<?php if($blog_single_navigation){ ?>
	<div class="eltd-blog-single-navigation eltd-blog-single-grid eltd-grid eltd-grid-normal-gutter">
		<div class="eltd-blog-single-navigation-inner clearfix">
			<?php
			/* Single navigation section - SETTING PARAMS */
            $prevPost = get_previous_post();
            $nextPost = get_next_post();
            
            if($prevPost !== ''){
                
                $post_navigation['prev']['post'] = $prevPost;	
                
                if($blog_navigation_through_same_category){
					if(get_previous_post(true) !== ""){
						$post_navigation['prev']['post'] = get_previous_post(true);
					}
				}

	            $image_url = get_the_post_thumbnail_url($prevPost->ID, 'large');

	            $image_style = '';
	            if($image_url && $image_url !== ''){
		            $image_style = 'background-image: url('.esc_url($image_url).')';
                }

                $post_navigation['prev']['image'] = '';

                $post_navigation['prev']['classes'] = array(
                    'eltd-blog-single-nav-prev'
                );
                if($image_style !== ''){
                    $post_navigation['prev']['image'] = '<div class="eltd-blog-single-nav-thumbnail" '.findme_elated_get_inline_style($image_style).' ></div>';
                    $post_navigation['prev']['classes'][] = 'eltd-with-image';
                }
                
                
                $post_navigation['prev']['date'] = '<span class="eltd-blog-single-nav-date">'.get_the_date('',$prevPost->ID).'</span>';
                $post_navigation['prev']['title'] = '<h5 class="eltd-blog-single-nav-label">'.get_the_title($prevPost->ID).'</h5>';
               
            }
            
            if($nextPost !== ''){
                
                $post_navigation['next']['post'] = $nextPost;	
                
                if($blog_navigation_through_same_category){
					if(get_next_post(true) !== ""){
						$post_navigation['next']['post'] = get_next_post(true);
					}
				}

	            $image_url = get_the_post_thumbnail_url($nextPost->ID, 'large');
	            $image_style = '';
	            if($image_url && $image_url !== ''){
		            $image_style = 'background-image: url('.esc_url($image_url).')';
	            }
                $post_navigation['next']['image'] = '';
                
                $post_navigation['next']['classes'] = array(
                    'eltd-blog-single-nav-next'
                );

                if($image_style !== ''){
                    $post_navigation['next']['image'] = '<div class="eltd-blog-single-nav-thumbnail" '.findme_elated_get_inline_style($image_style).'></div>';
                    $post_navigation['next']['classes'][] = 'eltd-with-image';
                }
                
                $post_navigation['next']['date'] = '<span class="eltd-blog-single-nav-date">'.get_the_date('',$nextPost->ID).'</span>';
                $post_navigation['next']['title'] = '<h5 class="eltd-blog-single-nav-label">'.get_the_title($nextPost->ID).'</h5>';
                
            }


			/* Single navigation section - RENDERING */
            foreach (array('prev', 'next') as $nav_type) {
                
                if(isset($post_navigation[$nav_type])){ ?>
            
                    <div class="<?php echo implode(' ', $post_navigation[$nav_type]['classes']) ?>">
                        <a itemprop="url" href="<?php echo get_permalink($post_navigation[$nav_type]['post']->ID); ?>">
                            <?php
                                echo findme_elated_get_module_part( $post_navigation[$nav_type]['image'] );
                                echo wp_kses_post($post_navigation[$nav_type]['title']);
                                echo wp_kses_post($post_navigation[$nav_type]['date']); 
                            ?>
                        </a>
                    </div>
            
                <?php }
                                
            }
			
			?>
		</div>
	</div>
<?php } ?>