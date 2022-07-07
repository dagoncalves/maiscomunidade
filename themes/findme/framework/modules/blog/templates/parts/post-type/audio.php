<?php
$audio_type = get_post_meta( get_the_ID(), "eltd_audio_type_meta", true );
$has_audio_link = get_post_meta(get_the_ID(), "eltd_post_audio_custom_meta", true) !== '' || get_post_meta(get_the_ID(), "eltd_post_audio_link_meta", true) !== '';
?>
<?php if($has_audio_link) { ?>
    <div class="eltd-blog-audio-holder">
        <?php if ( $audio_type == 'social_networks' ) {
            $audiolink = get_post_meta( get_the_ID(), "eltd_post_audio_link_meta", true );
            $embed     = wp_oembed_get( $audiolink );
            echo wp_kses_post($embed);
        } else if ( $audio_type == 'self' ) { ?>
            <audio class="eltd-blog-audio" src="<?php echo esc_url(get_post_meta(get_the_ID(), "eltd_post_audio_custom_meta", true)) ?>" controls="controls">
                <?php esc_html_e("Your browser don't support audio player","findme"); ?>
            </audio>
        <?php } ?>
    </div>
<?php } ?>