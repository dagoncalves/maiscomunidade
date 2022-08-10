<?php
$this_object = eltd_core_process_holder_class_instance();

$classes = $this_object->getBasicParamByKey('classes');
$content = $this_object->getBasicParamByKey('content');

?>

<div <?php findme_elated_class_attribute($classes)?>>
	<?php echo do_shortcode($content); ?>
</div>