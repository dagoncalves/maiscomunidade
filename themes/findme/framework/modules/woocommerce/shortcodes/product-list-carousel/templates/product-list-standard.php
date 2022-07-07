<div class="eltd-plc-holder <?php echo esc_attr($holder_classes) ?>">
	<div class="eltd-plc-outer eltd-owl-slider" <?php echo findme_elated_get_inline_attrs($holder_data); ?>>
		<?php if($query_result->have_posts()): while ($query_result->have_posts()) : $query_result->the_post(); ?>
			<div class="eltd-plc-item">
				<div class="eltd-plc-image-outer">
					<div class="eltd-plc-image">
						<?php findme_elated_get_module_template_part('templates/parts/image', 'woocommerce', '', $params); ?>
					</div>
					<div class="eltd-plc-text" <?php echo findme_elated_get_inline_style($shader_styles); ?>>
						<div class="eltd-plc-text-outer">
							<div class="eltd-plc-text-inner">
								<?php findme_elated_get_module_template_part('templates/parts/title', 'woocommerce', '', $params); ?>
								
								<?php findme_elated_get_module_template_part('templates/parts/category', 'woocommerce', '', $params); ?>
								
								<?php findme_elated_get_module_template_part('templates/parts/excerpt', 'woocommerce', '', $params); ?>
								
								<?php findme_elated_get_module_template_part('templates/parts/rating', 'woocommerce', '', $params); ?>
								
								<?php findme_elated_get_module_template_part('templates/parts/price', 'woocommerce', '', $params); ?>
								
								<?php findme_elated_get_module_template_part('templates/parts/add-to-cart', 'woocommerce', '', $params); ?>
							</div>
						</div>
					</div>
					<a class="eltd-plc-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
				</div>
			</div>
		<?php endwhile;	else:
			findme_elated_get_module_template_part('templates/parts/no-posts', 'woocommerce', '', $params);
		endif;
			wp_reset_postdata();
		?>
	</div>
</div>