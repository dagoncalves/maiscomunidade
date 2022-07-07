<?php
$tags = get_the_tags();
?>
<?php if($tags) { ?>
<div class="eltd-tags-holder">
    <div class="eltd-tags">
        <?php the_tags('', '', ''); ?>
    </div>
</div>
<?php } ?>