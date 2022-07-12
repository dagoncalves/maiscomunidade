<?php
$galery_imgs = $article_obj->getPostMeta('_listing_gallery_images');
$data_params = array(
	'data-number-of-items' => '3',
	'data-enable-navigation' => 'no',
	'data-enable-pagination' => 'no',
	'data-enable-loop' => 'yes',
	'data-enable-auto-width' => 'yes',
	'data-enable-center' => 'yes',
	'data-slider-animate-in' => 'fadeIn',
	'data-slider-animate-out' => 'fadeOut',
	'data-slider-speed' => '2000',
	'data-enable-autoplay' => 'yes',
	'data-slider-margin' => '5',
    'data-pretty_photo' => 'yes'
);

if(is_array($galery_imgs) && count($galery_imgs)){ ?>
	<style>
		.tamanho-img {
			height: 400px;
		}
	</style>
	<div class="tamanho-box eltd-ls-single-gallery-holder eltd-owl-slider " <?php echo findme_elated_get_inline_attrs($data_params); ?>>
		<?php foreach($galery_imgs as $img_url){
			if($img_url !== ''){ ?>
				<div class="eltd-ls-single-gallery-item">
                    <a itemprop="image" class="eltd-ls-single-lightbox" href="<?php echo esc_url($img_url)?>" data-rel="prettyPhoto[single_pretty_photo]">
					    <img class="tamanho-img" src="<?php echo esc_url($img_url); ?>" alt="<?php esc_html_e('Image','eltd-listing') ?>"/>
                    </a>
				</div>
			<?php }
		} ?>
	</div>

<?php }