<?php

/*
   Class: FindmeElatedMultipleImages
   A class that initializes Elated Multiple Images
*/
class FindmeElatedMultipleImages implements iFindmeElatedRender {
	private $name;
	private $label;
	private $description;
	
	function __construct($name,$label="",$description="") {
		global $findme_elated_Framework;
		$this->name = $name;
		$this->label = $label;
		$this->description = $description;
		$findme_elated_Framework->eltdMetaBoxes->addOption($this->name,"");
	}

	public function render($factory) {
		global $post;
		?>

		<div class="eltd-page-form-section">
			<div class="eltd-field-desc">
				<h4><?php echo esc_html($this->label); ?></h4>
				<p><?php echo esc_html($this->description); ?></p>
			</div>
			<div class="eltd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<ul class="eltd-gallery-images-holder clearfix">
								<?php
								$image_gallery_val = get_post_meta( $post->ID, $this->name , true );
								if($image_gallery_val!='' ) $image_gallery_array=explode(',',$image_gallery_val);

								if(isset($image_gallery_array) && count($image_gallery_array)!=0):
									foreach($image_gallery_array as $gimg_id):
										$gimage_wp = wp_get_attachment_image_src($gimg_id,'thumbnail', true);
										echo '<li class="eltd-gallery-image-holder"><img src="'.esc_url($gimage_wp[0]).'"/></li>';
									endforeach;
								endif;
								?>
							</ul>
							<input type="hidden" value="<?php echo esc_attr($image_gallery_val); ?>" id="<?php echo esc_attr( $this->name) ?>" name="<?php echo esc_attr( $this->name) ?>">
							<div class="eltd-gallery-uploader">
								<a class="eltd-gallery-upload-btn btn btn-sm btn-primary" href="javascript:void(0)"><?php esc_html_e('Upload', 'findme'); ?></a>
								<a class="eltd-gallery-clear-btn btn btn-sm btn-default pull-right" href="javascript:void(0)"><?php esc_html_e('Remove All', 'findme'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

/*
   Class: FindmeElatedImagesVideos
   A class that initializes Elated Images Videos
*/
class FindmeElatedImagesVideos implements iFindmeElatedRender {
	private $label;
	private $description;
	
	function __construct($label="",$description="") {
		$this->label = $label;
		$this->description = $description;
	}

	public function render($factory) {
		global $post;
		?>
		
		<div class="eltd_hidden_portfolio_images" style="display: none">
			<div class="eltd-page-form-section">
				<div class="eltd-field-desc">
					<h4><?php echo esc_html($this->label); ?></h4>
					<p><?php echo esc_html($this->description); ?></p>
				</div>
				<div class="eltd-section-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-2">
								<em class="eltd-field-description"><?php esc_html_e('Order Number', 'findme'); ?></em>
								<input type="text" class="form-control eltd-input eltd-form-element" id="portfolioimgordernumber_x" name="portfolioimgordernumber_x" />
							</div>
						</div>
						<div class="row next-row">
							<div class="col-lg-12">
								<em class="eltd-field-description"><?php esc_html_e('Image', 'findme'); ?></em>
								<div class="eltd-media-uploader">
									<div style="display: none" class="eltd-media-image-holder">
										<img src="" alt="<?php esc_attr_e('Image', 'findme'); ?>" class="eltd-media-image img-thumbnail" />
									</div>
									<div style="display: none" class="eltd-media-meta-fields">
										<input type="hidden" class="eltd-media-upload-url" name="portfolioimg_x" id="portfolioimg_x" />
										<input type="hidden" class="eltd-media-upload-height" name="eltd_options_theme[media-upload][height]" value="" />
										<input type="hidden" class="eltd-media-upload-width" name="eltd_options_theme[media-upload][width]" value="" />
									</div>
									<a class="eltd-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e('Select Image', 'findme'); ?>" data-frame-button-text="<?php esc_attr_e('Select Image', 'findme'); ?>"><?php esc_html_e('Upload', 'findme'); ?></a>
									<a style="display: none;" href="javascript: void(0)" class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'findme'); ?></a>
								</div>
							</div>
						</div>
						<div class="row next-row">
							<div class="col-lg-3">
								<em class="eltd-field-description"><?php esc_html_e('Video Type', 'findme'); ?></em>
								<select class="form-control eltd-form-element eltd-portfoliovideotype" name="portfoliovideotype_x" id="portfoliovideotype_x">
									<option value=""></option>
									<option value="youtube"><?php esc_html_e('YouTube', 'findme'); ?></option>
									<option value="vimeo"><?php esc_html_e('Vimeo', 'findme'); ?></option>
									<option value="self"><?php esc_html_e('Self Hosted', 'findme'); ?></option>
								</select>
							</div>
							<div class="col-lg-3">
								<em class="eltd-field-description"><?php esc_html_e('Video ID', 'findme'); ?></em>
								<input type="text" class="form-control eltd-input eltd-form-element" id="portfoliovideoid_x" name="portfoliovideoid_x" />
							</div>
						</div>
						<div class="row next-row">
							<div class="col-lg-12">
								<em class="eltd-field-description"><?php esc_html_e('Video image','findme')?></em>
								<div class="eltd-media-uploader">
									<div style="display: none" class="eltd-media-image-holder">
										<img src="" alt="<?php esc_attr_e('Image', 'findme'); ?>" class="eltd-media-image img-thumbnail" />
									</div>
									<div style="display: none" class="eltd-media-meta-fields">
										<input type="hidden" class="eltd-media-upload-url" name="portfoliovideoimage_x" id="portfoliovideoimage_x" />
										<input type="hidden" class="eltd-media-upload-height" name="eltd_options_theme[media-upload][height]" value="" />
										<input type="hidden" class="eltd-media-upload-width" name="eltd_options_theme[media-upload][width]" value="" />
									</div>
									<a class="eltd-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e('Select Image', 'findme'); ?>" data-frame-button-text="<?php esc_attr_e('Select Image', 'findme'); ?>"><?php esc_html_e('Upload', 'findme'); ?></a>
									<a style="display: none;" href="javascript: void(0)" class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'findme'); ?></a>
								</div>
							</div>
						</div>
						<div class="row next-row">
							<div class="col-lg-4">
								<em class="eltd-field-description"><?php esc_html_e('Video mp4', 'findme'); ?></em>
								<input type="text" class="form-control eltd-input eltd-form-element" id="portfoliovideomp4_x" name="portfoliovideomp4_x" />
							</div>
						</div>
						<div class="row next-row">
							<div class="col-lg-12">
								<a class="eltd_remove_image btn btn-sm btn-primary" href="/" onclick="javascript: return false;"><?php esc_html_e('Remove portfolio image/video', 'findme'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		$no = 1;
		$portfolio_images = get_post_meta( $post->ID, 'eltd_portfolio_images', true );
		if (count($portfolio_images)>1 && findme_elated_core_plugin_installed()) {
			usort($portfolio_images, "eltd_core_compare_portfolio_videos");
		}
		while (isset($portfolio_images[$no-1])) {
			$portfolio_image = $portfolio_images[$no-1];
			?>
			
			<div class="eltd_portfolio_image" rel="<?php echo esc_attr($no); ?>" style="display: block;">
				<div class="eltd-page-form-section">
					<div class="eltd-field-desc">
						<h4><?php echo esc_html($this->label); ?></h4>
						<p><?php echo esc_html($this->description); ?></p>
					</div>
					<div class="eltd-section-content">
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-2">
									<em class="eltd-field-description"><?php esc_html_e('Order Number', 'findme'); ?></em>
									<input type="text" class="form-control eltd-input eltd-form-element" id="portfolioimgordernumber_<?php echo esc_attr($no); ?>" name="portfolioimgordernumber[]" value="<?php echo isset($portfolio_image['portfolioimgordernumber']) ? esc_attr(stripslashes($portfolio_image['portfolioimgordernumber'])) : ""; ?>" />
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-12">
									<em class="eltd-field-description"><?php esc_html_e('Image', 'findme'); ?></em>
									<div class="eltd-media-uploader">
										<div<?php if (stripslashes($portfolio_image['portfolioimg']) == false) { ?> style="display: none"<?php } ?> class="eltd-media-image-holder">
											<img src="<?php if (stripslashes($portfolio_image['portfolioimg']) == true) { echo esc_url(findme_elated_get_attachment_thumb_url(stripslashes($portfolio_image['portfolioimg']))); } ?>" alt="<?php esc_attr_e('Image', 'findme'); ?>" class="eltd-media-image img-thumbnail"/>
										</div>
										<div style="display: none" class="eltd-media-meta-fields">
											<input type="hidden" class="eltd-media-upload-url" name="portfolioimg[]" id="portfolioimg_<?php echo esc_attr($no); ?>" value="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>"/>
											<input type="hidden" class="eltd-media-upload-height" name="eltd_options_theme[media-upload][height]" value="" />
											<input type="hidden" class="eltd-media-upload-width" name="eltd_options_theme[media-upload][width]" value="" />
										</div>
										<a class="eltd-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e('Select Image', 'findme'); ?>" data-frame-button-text="<?php esc_attr_e('Select Image', 'findme'); ?>"><?php esc_html_e('Upload', 'findme'); ?></a>
										<a style="display: none;" href="javascript: void(0)" class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'findme'); ?></a>
									</div>
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-3">
									<em class="eltd-field-description"><?php esc_html_e('Video Type', 'findme'); ?></em>
									<select class="form-control eltd-form-element eltd-portfoliovideotype" name="portfoliovideotype[]" id="portfoliovideotype_<?php echo esc_attr($no); ?>">
										<option value=""></option>
										<option <?php if ($portfolio_image['portfoliovideotype'] == "youtube") { echo "selected='selected'"; } ?>  value="youtube"><?php esc_html_e('YouTube', 'findme'); ?></option>
										<option <?php if ($portfolio_image['portfoliovideotype'] == "vimeo") { echo "selected='selected'"; } ?>  value="vimeo"><?php esc_html_e('Vimeo', 'findme'); ?></option>
										<option <?php if ($portfolio_image['portfoliovideotype'] == "self") { echo "selected='selected'"; } ?>  value="self"><?php esc_html_e('Self Hosted', 'findme'); ?></option>
									</select>
								</div>
								<div class="col-lg-3">
									<em class="eltd-field-description"><?php esc_html_e('Video ID', 'findme'); ?></em>
									<input type="text" class="form-control eltd-input eltd-form-element" id="portfoliovideoid_<?php echo esc_attr($no); ?>" name="portfoliovideoid[]" value="<?php echo isset($portfolio_image['portfoliovideoid']) ? esc_attr(stripslashes($portfolio_image['portfoliovideoid'])) : ""; ?>" />
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-12">
									<em class="eltd-field-description"><?php esc_html_e('Video image','findme')?></em>
									<div class="eltd-media-uploader">
										<div<?php if (stripslashes($portfolio_image['portfoliovideoimage']) == false) { ?> style="display: none"<?php } ?> class="eltd-media-image-holder">
											<img src="<?php if (stripslashes($portfolio_image['portfoliovideoimage']) == true) { echo esc_url(findme_elated_get_attachment_thumb_url(stripslashes($portfolio_image['portfoliovideoimage']))); } ?>" alt="<?php esc_attr_e('Image', 'findme'); ?>" class="eltd-media-image img-thumbnail"/>
										</div>
										<div style="display: none" class="eltd-media-meta-fields">
											<input type="hidden" class="eltd-media-upload-url" name="portfoliovideoimage[]" id="portfoliovideoimage_<?php echo esc_attr($no); ?>" value="<?php echo stripslashes($portfolio_image['portfoliovideoimage']); ?>"/>
											<input type="hidden" class="eltd-media-upload-height" name="eltd_options_theme[media-upload][height]" value=""/>
											<input type="hidden" class="eltd-media-upload-width" name="eltd_options_theme[media-upload][width]" value=""/>
										</div>
										<a class="eltd-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e('Select Image', 'findme'); ?>" data-frame-button-text="<?php esc_attr_e('Select Image', 'findme'); ?>"><?php esc_html_e('Upload', 'findme'); ?></a>
										<a style="display: none;" href="javascript: void(0)" class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'findme'); ?></a>
									</div>
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-4">
									<em class="eltd-field-description"><?php esc_html_e('Video mp4', 'findme'); ?></em>
									<input type="text" class="form-control eltd-input eltd-form-element" id="portfoliovideomp4_<?php echo esc_attr($no); ?>" name="portfoliovideomp4[]" value="<?php echo isset($portfolio_image['portfoliovideomp4']) ? esc_attr(stripslashes($portfolio_image['portfoliovideomp4'])) : ""; ?>" />
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-12">
									<a class="eltd_remove_image btn btn-sm btn-primary" href="/" onclick="javascript: return false;"><?php esc_html_e('Remove portfolio image/video', 'findme'); ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			$no++;
		}
		?>
		<br />
		<a class="eltd_add_image btn btn-sm btn-primary" onclick="javascript: return false;" href="/"><?php esc_html_e('Add portfolio image/video', 'findme'); ?></a>
	<?php
	}
}

/*
   Class: FindmeElatedImagesVideos
   A class that initializes Elated Images Videos
*/
class FindmeElatedImagesVideosFramework implements iFindmeElatedRender {
	private $label;
	private $description;

	function __construct($label="",$description="") {
		$this->label = $label;
		$this->description = $description;
	}

	public function render($factory) {
		global $post;
		?>
		
		<div class="eltd-hidden-portfolio-images"  style="display: none">
			<div class="eltd-portfolio-toggle-holder">
				<div class="eltd-portfolio-toggle eltd-toggle-desc">
					<span class="number">1</span><span class="eltd-toggle-inner"><?php esc_html_e('Image - ', 'findme'); ?><em><?php esc_html_e('Order Number', 'findme'); ?></em></span>
				</div>
				<div class="eltd-portfolio-toggle eltd-portfolio-control">
					<span class="toggle-portfolio-media"><i class="fa fa-caret-up"></i></span>
					<a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
				</div>
			</div>
			<div class="eltd-portfolio-toggle-content">
				<div class="eltd-page-form-section">
					<div class="eltd-section-content">
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-2">
									<div class="eltd-media-uploader">
										<em class="eltd-field-description"><?php esc_html_e('Image', 'findme'); ?></em>
										<div style="display: none" class="eltd-media-image-holder">
											<img src="" alt="<?php esc_attr_e('Image', 'findme'); ?>" class="eltd-media-image img-thumbnail">
										</div>
										<div class="eltd-media-meta-fields">
											<input type="hidden" class="eltd-media-upload-url" name="portfolioimg_x" id="portfolioimg_x">
											<input type="hidden" class="eltd-media-upload-height" name="eltd_options_theme[media-upload][height]" value="">
											<input type="hidden" class="eltd-media-upload-width" name="eltd_options_theme[media-upload][width]" value="">
										</div>
										<a class="eltd-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e('Select Image', 'findme'); ?>" data-frame-button-text="<?php esc_attr_e('Select Image', 'findme'); ?>"><?php esc_html_e('Upload', 'findme'); ?></a>
										<a style="display: none;" href="javascript: void(0)" class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'findme'); ?></a>
									</div>
								</div>
								<div class="col-lg-2">
									<em class="eltd-field-description"><?php esc_html_e('Order Number', 'findme'); ?></em>
									<input type="text" class="form-control eltd-input eltd-form-element" id="portfolioimgordernumber_x" name="portfolioimgordernumber_x">
								</div>
							</div>
							<input type="hidden" name="portfoliovideoimage_x" id="portfoliovideoimage_x">
							<input type="hidden" name="portfoliovideotype_x" id="portfoliovideotype_x">
							<input type="hidden" name="portfoliovideoid_x" id="portfoliovideoid_x">
							<input type="hidden" name="portfoliovideomp4_x" id="portfoliovideomp4_x">
							<input type="hidden" name="portfolioimgtype_x" id="portfolioimgtype_x" value="image">
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="eltd-hidden-portfolio-videos"  style="display: none">
			<div class="eltd-portfolio-toggle-holder">
				<div class="eltd-portfolio-toggle eltd-toggle-desc">
					<span class="number">2</span><span class="eltd-toggle-inner"><?php esc_html_e('Video - ', 'findme'); ?><em><?php esc_html_e('Order Number', 'findme'); ?></em></span>
				</div>
				<div class="eltd-portfolio-toggle eltd-portfolio-control">
					<span class="toggle-portfolio-media"><i class="fa fa-caret-up"></i></span> <a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
				</div>
			</div>
			<div class="eltd-portfolio-toggle-content">
				<div class="eltd-page-form-section">
					<div class="eltd-section-content">
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-2">
									<div class="eltd-media-uploader">
										<em class="eltd-field-description"><?php esc_html_e('Cover Video Image', 'findme'); ?></em>
										<div style="display: none" class="eltd-media-image-holder">
											<img src="" alt="<?php esc_attr_e('Image', 'findme'); ?>" class="eltd-media-image img-thumbnail">
										</div>
										<div style="display: none" class="eltd-media-meta-fields">
											<input type="hidden" class="eltd-media-upload-url" name="portfoliovideoimage_x" id="portfoliovideoimage_x">
											<input type="hidden" class="eltd-media-upload-height" name="eltd_options_theme[media-upload][height]" value="">
											<input type="hidden" class="eltd-media-upload-width" name="eltd_options_theme[media-upload][width]" value="">
										</div>
										<a class="eltd-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e('Select Image', 'findme'); ?>" data-frame-button-text="<?php esc_attr_e('Select Image', 'findme'); ?>"><?php esc_html_e('Upload', 'findme'); ?></a>
										<a style="display: none;" href="javascript: void(0)" class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'findme'); ?></a>
									</div>
								</div>
								<div class="col-lg-10">
									<div class="row">
										<div class="col-lg-2">
											<em class="eltd-field-description"><?php esc_html_e('Order Number', 'findme'); ?></em>
											<input type="text" class="form-control eltd-input eltd-form-element" id="portfolioimgordernumber_x" name="portfolioimgordernumber_x">
										</div>
									</div>
									<div class="row next-row">
										<div class="col-lg-2">
											<em class="eltd-field-description"><?php esc_html_e('Video Type', 'findme'); ?></em>
											<select class="form-control eltd-form-element eltd-portfoliovideotype" name="portfoliovideotype_x" id="portfoliovideotype_x">
												<option value=""></option>
												<option value="youtube"><?php esc_html_e('YouTube', 'findme'); ?></option>
												<option value="vimeo"><?php esc_html_e('Vimeo', 'findme'); ?></option>
												<option value="self"><?php esc_html_e('Self Hosted', 'findme'); ?></option>
											</select>
										</div>
										<div class="col-lg-2 eltd-video-id-holder">
											<em class="eltd-field-description" id="videoId"><?php esc_html_e('Video ID', 'findme'); ?></em>
											<input type="text" class="form-control eltd-input eltd-form-element" id="portfoliovideoid_x" name="portfoliovideoid_x">
										</div>
									</div>
									<div class="row next-row eltd-video-self-hosted-path-holder">
										<div class="col-lg-4">
											<em class="eltd-field-description"><?php esc_html_e('Video mp4', 'findme'); ?></em>
											<input type="text" class="form-control eltd-input eltd-form-element" id="portfoliovideomp4_x" name="portfoliovideomp4_x">
										</div>
									</div>
								</div>
							</div>
							<input type="hidden" name="portfolioimg_x" id="portfolioimg_x">
							<input type="hidden" name="portfolioimgtype_x" id="portfolioimgtype_x" value="video">
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		$no = 1;
		$portfolio_images = get_post_meta( $post->ID, 'eltd_portfolio_images', true );
		if ( !empty( $portfolio_images) ) {
			if (count($portfolio_images)>1 && findme_elated_core_plugin_installed()) {
				usort($portfolio_images, "eltd_core_compare_portfolio_videos");
			}
			while (isset($portfolio_images[$no-1])) {
				$portfolio_image = $portfolio_images[$no-1];
				if (isset($portfolio_image['portfolioimgtype']))
					$portfolio_img_type = $portfolio_image['portfolioimgtype'];
				else {
					if (stripslashes($portfolio_image['portfolioimg']) == true)
						$portfolio_img_type = "image";
					else
						$portfolio_img_type = "video";
				}
				if ($portfolio_img_type == "image") {
					?>

					<div class="eltd-portfolio-images eltd-portfolio-media" rel="<?php echo esc_attr($no); ?>">
						<div class="eltd-portfolio-toggle-holder">
							<div class="eltd-portfolio-toggle eltd-toggle-desc">
								<span class="number"><?php echo esc_html($no); ?></span><span class="eltd-toggle-inner"><?php esc_html_e('Image - ', 'findme'); ?><em><?php echo stripslashes($portfolio_image['portfolioimgordernumber']); ?></em></span>
							</div>
							<div class="eltd-portfolio-toggle eltd-portfolio-control">
								<a href="#" class="toggle-portfolio-media"><i class="fa fa-caret-down"></i></a>
								<a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<div class="eltd-portfolio-toggle-content" style="display: none">
							<div class="eltd-page-form-section">
								<div class="eltd-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-2">
												<div class="eltd-media-uploader">
													<em class="eltd-field-description"><?php esc_html_e('Image', 'findme'); ?></em>
													<div<?php if (stripslashes($portfolio_image['portfolioimg']) == false) { ?> style="display: none"<?php } ?> class="eltd-media-image-holder">
														<img src="<?php if (stripslashes($portfolio_image['portfolioimg']) == true) { echo esc_url(findme_elated_get_attachment_thumb_url(stripslashes($portfolio_image['portfolioimg']))); } ?>" alt="<?php esc_attr_e('Image', 'findme'); ?>" class="eltd-media-image img-thumbnail"/>
													</div>
													<div style="display: none" class="eltd-media-meta-fields">
														<input type="hidden" class="eltd-media-upload-url" name="portfolioimg[]" id="portfolioimg_<?php echo esc_attr($no); ?>" value="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>"/>
														<input type="hidden" class="eltd-media-upload-height" name="eltd_options_theme[media-upload][height]" value=""/>
														<input type="hidden" class="eltd-media-upload-width" name="eltd_options_theme[media-upload][width]" value=""/>
													</div>
													<a class="eltd-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e('Select Image', 'findme'); ?>" data-frame-button-text="<?php esc_attr_e('Select Image', 'findme'); ?>"><?php esc_html_e('Upload', 'findme'); ?></a>
													<a style="display: none;" href="javascript: void(0)" class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'findme'); ?></a>
												</div>
											</div>
											<div class="col-lg-2">
												<em class="eltd-field-description"><?php esc_html_e('Order Number', 'findme'); ?></em>
												<input type="text" class="form-control eltd-input eltd-form-element" id="portfolioimgordernumber_<?php echo esc_attr($no); ?>" name="portfolioimgordernumber[]" value="<?php echo isset($portfolio_image['portfolioimgordernumber']) ? esc_attr(stripslashes($portfolio_image['portfolioimgordernumber'])) : ""; ?>">
											</div>
										</div>
										<input type="hidden" id="portfoliovideoimage_<?php echo esc_attr($no); ?>" name="portfoliovideoimage[]">
										<input type="hidden" id="portfoliovideotype_<?php echo esc_attr($no); ?>" name="portfoliovideotype[]">
										<input type="hidden" id="portfoliovideoid_<?php echo esc_attr($no); ?>" name="portfoliovideoid[]">
										<input type="hidden" id="portfoliovideomp4_<?php echo esc_attr($no); ?>" name="portfoliovideomp4[]">
										<input type="hidden" id="portfolioimgtype_<?php echo esc_attr($no); ?>" name="portfolioimgtype[]" value="image">
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
				} else {
					?>
					<div class="eltd-portfolio-videos eltd-portfolio-media" rel="<?php echo esc_attr($no); ?>">
						<div class="eltd-portfolio-toggle-holder">
							<div class="eltd-portfolio-toggle eltd-toggle-desc">
								<span class="number"><?php echo esc_html($no); ?></span><span class="eltd-toggle-inner"><?php esc_html_e('Video - ', 'findme'); ?><em><?php echo stripslashes($portfolio_image['portfolioimgordernumber']); ?></em></span>
							</div>
							<div class="eltd-portfolio-toggle eltd-portfolio-control">
								<a href="#" class="toggle-portfolio-media"><i class="fa fa-caret-down"></i></a> <a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<div class="eltd-portfolio-toggle-content" style="display: none">
							<div class="eltd-page-form-section">
								<div class="eltd-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-2">
												<div class="eltd-media-uploader">
													<em class="eltd-field-description"><?php esc_html_e('Cover Video Image', 'findme'); ?></em>
													<div<?php if (stripslashes($portfolio_image['portfoliovideoimage']) == false) { ?> style="display: none"<?php } ?> class="eltd-media-image-holder">
														<img src="<?php if (stripslashes($portfolio_image['portfoliovideoimage']) == true) { echo esc_url(findme_elated_get_attachment_thumb_url(stripslashes($portfolio_image['portfoliovideoimage']))); } ?>" alt="<?php esc_attr_e('Image', 'findme'); ?>" class="eltd-media-image img-thumbnail"/>
													</div>
													<div style="display: none" class="eltd-media-meta-fields">
														<input type="hidden" class="eltd-media-upload-url" name="portfoliovideoimage[]" id="portfoliovideoimage_<?php echo esc_attr($no); ?>" value="<?php echo stripslashes($portfolio_image['portfoliovideoimage']); ?>"/>
														<input type="hidden" class="eltd-media-upload-height" name="eltd_options_theme[media-upload][height]" value=""/>
														<input type="hidden" class="eltd-media-upload-width" name="eltd_options_theme[media-upload][width]" value=""/>
													</div>
													<a class="eltd-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e('Select Image', 'findme'); ?>" data-frame-button-text="<?php esc_attr_e('Select Image', 'findme'); ?>"><?php esc_html_e('Upload', 'findme'); ?></a>
													<a style="display: none;" href="javascript: void(0)" class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'findme'); ?></a>
												</div>
											</div>
											<div class="col-lg-10">
												<div class="row">
													<div class="col-lg-2">
														<em class="eltd-field-description"><?php esc_html_e('Order Number', 'findme'); ?></em>
														<input type="text" class="form-control eltd-input eltd-form-element" id="portfolioimgordernumber_<?php echo esc_attr($no); ?>" name="portfolioimgordernumber[]" value="<?php echo isset($portfolio_image['portfolioimgordernumber']) ? esc_attr(stripslashes($portfolio_image['portfolioimgordernumber'])) : ""; ?>">
													</div>
												</div>
												<div class="row next-row">
													<div class="col-lg-2">
														<em class="eltd-field-description"><?php esc_html_e('Video Type', 'findme'); ?></em>
														<select class="form-control eltd-form-element eltd-portfoliovideotype" name="portfoliovideotype[]" id="portfoliovideotype_<?php echo esc_attr($no); ?>">
															<option value=""></option>
															<option <?php if ($portfolio_image['portfoliovideotype'] == "youtube") { echo "selected='selected'"; } ?>  value="youtube"><?php esc_html_e('YouTube', 'findme'); ?></option>
															<option <?php if ($portfolio_image['portfoliovideotype'] == "vimeo") { echo "selected='selected'"; } ?>  value="vimeo"><?php esc_html_e('Vimeo', 'findme'); ?></option>
															<option <?php if ($portfolio_image['portfoliovideotype'] == "self") { echo "selected='selected'"; } ?>  value="self"><?php esc_html_e('Self Hosted', 'findme'); ?></option>
														</select>
													</div>
													<div class="col-lg-2 eltd-video-id-holder">
														<em class="eltd-field-description"><?php esc_html_e('Video ID', 'findme'); ?></em>
														<input type="text" class="form-control eltd-input eltd-form-element" id="portfoliovideoid_<?php echo esc_attr($no); ?>" name="portfoliovideoid[]" value="<?php echo isset($portfolio_image['portfoliovideoid']) ? esc_attr(stripslashes($portfolio_image['portfoliovideoid'])) : ""; ?>" />
													</div>
												</div>
												<div class="row next-row eltd-video-self-hosted-path-holder">
													<div class="col-lg-4">
														<em class="eltd-field-description"><?php esc_html_e('Video mp4', 'findme'); ?></em>
														<input type="text" class="form-control eltd-input eltd-form-element" id="portfoliovideomp4_<?php echo esc_attr($no); ?>" name="portfoliovideomp4[]" value="<?php echo isset($portfolio_image['portfoliovideomp4']) ? esc_attr(stripslashes($portfolio_image['portfoliovideomp4'])) : ""; ?>" />
													</div>
												</div>
											</div>
										</div>
										<input type="hidden" id="portfolioimg_<?php echo esc_attr($no); ?>" name="portfolioimg[]">
										<input type="hidden" id="portfolioimgtype_<?php echo esc_attr($no); ?>" name="portfolioimgtype[]" value="video">
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
				$no++;
			}
		}
		?>

		<div class="eltd-portfolio-add">
			<a class="eltd-add-image btn btn-sm btn-primary" href="#"><i class="fa fa-camera"></i><?php esc_html_e('Add Image', 'findme'); ?></a>
			<a class="eltd-add-video btn btn-sm btn-primary" href="#"><i class="fa fa-video-camera"></i><?php esc_html_e('Add Video', 'findme'); ?></a>
			<a class="eltd-toggle-all-media btn btn-sm btn-default pull-right" href="#"><?php esc_html_e('Expand All', 'findme'); ?></a>
		</div>
	<?php
	}
}

class FindmeElatedTwitterFramework implements  iFindmeElatedRender {
    public function render($factory) {
        $twitterApi = ElatedTwitterApi::getInstance();
        $message = '';

        if(!empty($_GET['oauth_token']) && !empty($_GET['oauth_verifier'])) {
            if(!empty($_GET['oauth_token'])) {
                update_option($twitterApi::AUTHORIZE_TOKEN_FIELD, $_GET['oauth_token']);
            }

            if(!empty($_GET['oauth_verifier'])) {
                update_option($twitterApi::AUTHORIZE_VERIFIER_FIELD, $_GET['oauth_verifier']);
            }

            $responseObj = $twitterApi->obtainAccessToken();
            if($responseObj->status) {
                $message = esc_html__('You have successfully connected with your Twitter account. If you have any issues fetching data from Twitter try reconnecting.', 'findme');
            } else {
                $message = $responseObj->message;
            }
        }

        $buttonText = $twitterApi->hasUserConnected() ? esc_html__('Re-connect with Twitter', 'findme') : esc_html__('Connect with Twitter', 'findme');
    ?>
        <?php if($message !== '') { ?>
            <div class="alert alert-success" style="margin-top: 20px;">
                <span><?php echo esc_html($message); ?></span>
            </div>
        <?php } ?>
        <div class="eltd-page-form-section" id="eltd_enable_social_share">
            <div class="eltd-field-desc">
                <h4><?php esc_html_e('Connect with Twitter', 'findme'); ?></h4>
                <p><?php esc_html_e('Connecting with Twitter will enable you to show your latest tweets on your site', 'findme'); ?></p>
            </div>
            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <a id="eltd-tw-request-token-btn" class="btn btn-primary" href="#"><?php echo esc_html($buttonText); ?></a>
                            <input type="hidden" data-name="current-page-url" value="<?php echo esc_url($twitterApi->buildCurrentPageURI()); ?>"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
}

class FindmeElatedInstagramFramework implements  iFindmeElatedRender {
	public function render( $factory ) {
		$instagram_api = ElatedInstagramApi::getInstance();
		$message       = '';

		//check if code parameter and instagram parameter is set in URL
		if ( ! empty( $_GET['code'] ) && ! empty( $_GET['instagram'] ) ) {
			//update code option so we can use it later
			$instagram_api->setConnectionType( 'instagram' );
			$instagram_api->instagramStoreCode();
			$instagram_api->instagramExchangeCodeForToken();
			$message = esc_html__( 'You have successfully connected with your Instagram Personal account.', 'findme' );
		}

		//check if code parameter and instagram parameter is set in URL
		if ( ! empty( $_GET['access_token'] ) && ! empty( $_GET['facebook'] ) ) {
			//update code option so we can use it later
			$instagram_api->setConnectionType( 'facebook' );
			$instagram_api->facebookStoreToken();
			$message = esc_html__( 'You have successfully connected with your Instagram Business account.', 'findme' );
		}

		//check if code parameter and instagram parameter is set in URL
		if ( ! empty( $_GET['disconnect'] ) ) {
			//update code option so we can use it later
			$instagram_api->disconnect();
			$message = esc_html__( 'You have have been disconnected from all Instagram accounts.', 'findme' );

		}
		?>

		<?php if ( $message !== '' ) { ?>
			<div class="alert alert-success">
				<span><?php echo esc_html( $message ); ?></span>
			</div>
		<?php } ?>
		<div class="eltd-page-form-section" id="eltd_enable_social_share">
			<div class="eltd-field-desc">
				<h4><?php esc_html_e( 'Connect with Instagram', 'findme' ); ?></h4>
				<p><?php esc_html_e( 'Connecting with Instagram will enable you to show your latest photos on your site', 'findme' ); ?></p>
			</div>
			<div class="eltd-section-content">
				<div class="container-fluid">
					<?php
					$instagram_user_id = get_option( $instagram_api::INSTAGRAM_USER_ID );
					$connection_type   = get_option( $instagram_api::CONNECTION_TYPE );
					if ( $instagram_user_id ) { ?>
						<div class="row">
							<div class="col-lg-12">
								<p><?php echo esc_html__( 'You are currently connected to Instagram ID: ', 'findme' );
									echo esc_attr( $instagram_user_id ) ?></p>
							</div>
						</div>
					<?php } ?>
					<div class="row">
						<?php if ( ! empty( $_GET['disconnect'] ) ) { ?>
							<div class="col-lg-4">
								<a class="btn btn-primary" href="<?php echo esc_url( $instagram_api->reloadURL() ); ?>"><?php echo esc_html__( 'Reload Page', 'findme' ); ?></a>
							</div>
						<?php } else if ( empty( $connection_type ) ) { ?>
							<div class="col-lg-4">
								<a class="btn btn-primary" href="<?php echo esc_url( $instagram_api->instagramRequestCode() ); ?>"><?php echo esc_html__( 'Connect with Instagram Personal account', 'findme' ); ?></a>
							</div>
							<div class="col-lg-4">
								<a class="btn btn-primary" href="<?php echo esc_url( $instagram_api->facebookRequestCode() ); ?>"><?php echo esc_html__( 'Connect with Instagram Business account', 'findme' ); ?></a>
							</div>
						<?php } else { ?>
							<div class="col-lg-4">
								<a class="btn btn-primary" href="<?php echo esc_url( $instagram_api->disconnectURL() ); ?>"><?php echo esc_html__( 'Disconnect Instagram account', 'findme' ) ?></a>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	<?php }
}

/*
   Class: FindmeElatedImagesVideos
   A class that initializes Elated Images Videos
*/
class FindmeElatedOptionsFramework implements iFindmeElatedRender {
	private $label;
	private $description;


	function __construct($label="",$description="") {
		$this->label = $label;
		$this->description = $description;
	}

	public function render($factory) {
		global $post;
		?>

		<div class="eltd-portfolio-additional-item-holder" style="display: none">
			<div class="eltd-portfolio-toggle-holder">
				<div class="eltd-portfolio-toggle eltd-toggle-desc">
					<span class="number">1</span><span class="eltd-toggle-inner"><?php esc_html_e('Additional Sidebar Item','findme')?> <em><?php esc_html_e('(Order Number, Item Title)', 'findme'); ?></em></span>
				</div>
				<div class="eltd-portfolio-toggle eltd-portfolio-control">
					<span class="toggle-portfolio-item"><i class="fa fa-caret-up"></i></span>
					<a href="#" class="remove-portfolio-item"><i class="fa fa-times"></i></a>
				</div>
			</div>
			<div class="eltd-portfolio-toggle-content">
				<div class="eltd-page-form-section">
					<div class="eltd-section-content">
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-2">
									<em class="eltd-field-description"><?php esc_html_e('Order Number', 'findme'); ?></em>
									<input type="text" class="form-control eltd-input eltd-form-element" id="optionlabelordernumber_x" name="optionlabelordernumber_x">
								</div>
								<div class="col-lg-10">
									<em class="eltd-field-description"><?php esc_html_e('Item Title', 'findme'); ?></em>
									<input type="text" class="form-control eltd-input eltd-form-element" id="optionLabel_x" name="optionLabel_x">
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-12">
									<em class="eltd-field-description"><?php esc_html_e('Item Text', 'findme'); ?></em>
									<textarea class="form-control eltd-input eltd-form-element" id="optionValue_x" name="optionValue_x"></textarea>
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-12">
									<em class="eltd-field-description"><?php esc_html_e('Enter Full URL for Item Text Link', 'findme'); ?></em>
									<input type="text" class="form-control eltd-input eltd-form-element" id="optionUrl_x" name="optionUrl_x">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		$no = 1;
		$portfolios = get_post_meta( $post->ID, 'eltd_portfolios', true );
		if ( !empty( $portfolios) ) {
			if (count($portfolios)>1 && findme_elated_core_plugin_installed()) {
				usort($portfolios, "eltd_core_compare_portfolio_options");
			}
			while (isset($portfolios[$no-1])) {
				$portfolio = $portfolios[$no-1];
				?>
				<div class="eltd-portfolio-additional-item" rel="<?php echo esc_attr($no); ?>">
					<div class="eltd-portfolio-toggle-holder">
						<div class="eltd-portfolio-toggle eltd-toggle-desc">
							<span class="number"><?php echo esc_html($no); ?></span><span class="eltd-toggle-inner"><?php esc_html_e('Additional Sidebar Item','findme')?> - <em>(<?php echo stripslashes($portfolio['optionlabelordernumber']); ?>, <?php echo stripslashes($portfolio['optionLabel']); ?>)</em></span>
						</div>
						<div class="eltd-portfolio-toggle eltd-portfolio-control">
							<span class="toggle-portfolio-item"><i class="fa fa-caret-down"></i></span>
							<a href="#" class="remove-portfolio-item"><i class="fa fa-times"></i></a>
						</div>
					</div>
					<div class="eltd-portfolio-toggle-content" style="display: none">
						<div class="eltd-page-form-section">
							<div class="eltd-section-content">
								<div class="container-fluid">
									<div class="row">
										<div class="col-lg-2">
											<em class="eltd-field-description"><?php esc_html_e('Order Number', 'findme'); ?></em>
											<input type="text" class="form-control eltd-input eltd-form-element" id="optionlabelordernumber_<?php echo esc_attr($no); ?>" name="optionlabelordernumber[]" value="<?php echo isset($portfolio['optionlabelordernumber']) ? esc_attr(stripslashes($portfolio['optionlabelordernumber'])) : ""; ?>">
										</div>
										<div class="col-lg-10">
											<em class="eltd-field-description"><?php esc_html_e('Item Title', 'findme'); ?></em>
											<input type="text" class="form-control eltd-input eltd-form-element" id="optionLabel_<?php echo esc_attr($no); ?>" name="optionLabel[]" value="<?php echo esc_attr(stripslashes($portfolio['optionLabel'])); ?>">
										</div>
									</div>
									<div class="row next-row">
										<div class="col-lg-12">
											<em class="eltd-field-description"><?php esc_html_e('Item Text', 'findme'); ?></em>
											<textarea class="form-control eltd-input eltd-form-element" id="optionValue_<?php echo esc_attr($no); ?>" name="optionValue[]"><?php echo esc_attr(stripslashes($portfolio['optionValue'])); ?></textarea>
										</div>
									</div>
									<div class="row next-row">
										<div class="col-lg-12">
											<em class="eltd-field-description"><?php esc_html_e('Enter Full URL for Item Text Link', 'findme'); ?></em>
											<input type="text" class="form-control eltd-input eltd-form-element" id="optionUrl_<?php echo esc_attr($no); ?>" name="optionUrl[]" value="<?php echo stripslashes($portfolio['optionUrl']); ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				$no++;
			}
		}
		?>

		<div class="eltd-portfolio-add">
			<a class="eltd-add-item btn btn-sm btn-primary" href="#"><?php esc_html_e('Add New Item', 'findme'); ?></a>
			<a class="eltd-toggle-all-item btn btn-sm btn-default pull-right" href="#"><?php esc_html_e('Expand All', 'findme'); ?></a>
		</div>
	<?php
	}
}