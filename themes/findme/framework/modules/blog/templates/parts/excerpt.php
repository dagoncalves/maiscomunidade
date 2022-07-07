<?php
$excerpt_length = isset($params['excerpt_length']) ? $params['excerpt_length'] : '';
$excerpt = findme_elated_excerpt($excerpt_length);
?>
<?php if($excerpt !== '') { ?>
    <div class="eltd-bli-excerpt">
        <div class="eltd-post-excerpt-holder">
            <p itemprop="description" class="eltd-post-excerpt">
                <?php echo wp_kses_post( $excerpt ); ?>
            </p>
        </div>
    </div>
<?php } ?>
