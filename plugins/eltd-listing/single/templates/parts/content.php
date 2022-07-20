<?php
if(get_the_content() !== ''){?>
	<div class="eltd-ls-content-part-holder clearfix">

		<div class="eltd-ls-content-part">
			<?php
			if(get_the_content()):
			?>
				<h1><?php esc_html_e( 'Sobre o projeto', 'eltd-listing' );?></h1>
				<?php echo do_shortcode(wpautop(get_the_content())); ?>
			<?php
			endif;
			?>
			<?php
			if(get_post_meta( get_the_ID(), '_job_motivacao', true )!==''):
			?>
				<h2><?php esc_html_e( 'O que motivou a comunidade a realizar o projeto?', 'eltd-listing' );?></h2>
				<?php echo get_post_meta( get_the_ID(), '_job_motivacao', true ); ?>
			<?php
			endif;
			if(get_post_meta( get_the_ID(), '_job_acoes', true )!==''):
			?>
				<h2><?php esc_html_e( 'Quais ações foram desenvolvidas nesse projeto?', 'eltd-listing' );?></h2>
				<?php echo do_shortcode(wpautop(get_post_meta( get_the_ID(), '_job_acoes', true ))); ?>
			<?php
			endif;
			if(get_post_meta( get_the_ID(), '_job_parcerias', true )!==''):
			?>
				<h2><?php esc_html_e( 'Houve parcerias no projeto?', 'eltd-listing' );?></h2>
				<?php echo get_post_meta( get_the_ID(), '_job_parcerias', true ); ?>
			<?php
			endif;
			if(get_post_meta( get_the_ID(), '_job_parcerias', true )!==''):
			?>
				<h2><?php esc_html_e( 'Quais foram os resultados deste projeto? E nos conte um pouco da avaliação dele!', 'eltd-listing' );?></h2>
				<?php echo get_post_meta( get_the_ID(), '_job_resultados', true ); ?>
			<?php
			endif;
			?>
		</div>

	</div>
<?php }