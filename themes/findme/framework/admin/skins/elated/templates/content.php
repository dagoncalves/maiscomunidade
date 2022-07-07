<div class="eltd-tabs-content">
    <div class="tab-content">
        <div class="tab-pane fade<?php if ($page->slug == $tab) echo " in active"; ?>">
            <div class="eltd-tab-content">
                <div class="eltd-page-title-holder clearfix">
                    <h2 class="eltd-page-title"><?php echo esc_html($page->title); ?></h2>
                    <?php
	                    if($showAnchors) {
	                        $this->getAnchors($page);
	                    }
                    ?>
                </div>
                <form method="post" class="eltd_ajax_form">
	                <?php wp_nonce_field("eltd_ajax_save_nonce","eltd_ajax_save_nonce") ?>
                    <div class="eltd-page-form">
                        <?php $page->render(); ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>