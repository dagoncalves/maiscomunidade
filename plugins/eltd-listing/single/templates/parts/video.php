<?php
$self_hosted_video = $article_obj->getPostMeta('_listing_self_hosted_video');
$video_url_soc_net = $article_obj->getPostMeta('_listing_video');

if($self_hosted_video !== '' || $video_url_soc_net){ ?>

	<div class="eltd-ls-content-part-holder eltd-ls-content-video-holder clearfix">

		<div class="eltd-ls-content-part">
			<?php if($video_url_soc_net !== ''){
				echo wp_oembed_get($video_url_soc_net);
			} elseif($self_hosted_video !== ''){ ?>

				<div class="eltd-self-hosted-video-holder">
					<div class="eltd-video-wrap">
						<video class="eltd-self-hosted-video" poster="<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_image", true));  ?>" preload="auto">
							<source type="video/mp4" src="<?php echo esc_url($self_hosted_video);  ?>">
							<object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo esc_url(get_template_directory_uri().'/assets/js/flashmediaelement.swf'); ?>">
								<param name="movie" value="<?php echo esc_url(get_template_directory_uri().'/assets/js/flashmediaelement.swf'); ?>" />
								<param name="flashvars" value="controls=true&file=<?php echo esc_url($self_hosted_video);  ?>" />
							</object>
						</video>
					</div>
				</div>

			<?php } ?>

		</div>

	</div>

<?php }