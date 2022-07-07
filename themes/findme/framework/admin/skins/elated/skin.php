<?php

//if accessed directly exit
if(!defined('ABSPATH')) exit;

class ElatedSkin extends FindmeElatedSkinAbstract {
    /**
     * Skin constructor. Hooks to findme_elated_admin_scripts_init and findme_elated_enqueue_admin_styles
     */
    public function __construct() {
        $this->skinName = 'elated';

        //hook to
        add_action('findme_elated_admin_scripts_init', array($this, 'registerStyles'));
        add_action('findme_elated_admin_scripts_init', array($this, 'registerScripts'));

        add_action('findme_elated_enqueue_admin_styles', array($this, 'enqueueStyles'));
        add_action('findme_elated_enqueue_admin_scripts', array($this, 'enqueueScripts'));

        add_action('findme_elated_enqueue_meta_box_styles', array($this, 'enqueueStyles'));
        add_action('findme_elated_enqueue_meta_box_scripts', array($this, 'enqueueScripts'));

		add_action( 'admin_enqueue_scripts', array( $this, 'setShortcodeJSParams' ), 5 ); // 5 is set to be same permission as Gutenberg plugin have

		$this->setIcons();
		$this->setMenuItemPosition();
    }

    /**
     * Method that registers skin scripts
     */
    public function registerScripts() {
        $this->scripts['bootstrap.min'] = 'assets/js/bootstrap.min.js';
        $this->scripts['jquery.nouislider.min'] = 'assets/js/eltd-ui/jquery.nouislider.min.js';
        $this->scripts['eltd-ui-admin'] = 'assets/js/eltd-ui/eltd-ui.js';
        $this->scripts['eltd-bootstrap-select'] = 'assets/js/eltd-ui/eltd-bootstrap-select.min.js';
        $this->scripts['select2'] = 'assets/js/eltd-ui/select2.min.js';

        foreach ($this->scripts as $scriptHandle => $scriptPath) {
            findme_elated_register_skin_script($scriptHandle, $scriptPath);
        }
    }

    /**
     * Method that registers skin styles
     */
    public function registerStyles() {
        $this->styles['eltd-bootstrap'] = 'assets/css/eltd-bootstrap.css';
        $this->styles['eltd-page-admin'] = 'assets/css/eltd-page.css';
        $this->styles['eltd-options-admin'] = 'assets/css/eltd-options.css';
        $this->styles['eltd-meta-boxes-admin'] = 'assets/css/eltd-meta-boxes.css';
        $this->styles['eltd-ui-admin'] = 'assets/css/eltd-ui/eltd-ui.css';
        $this->styles['eltd-forms-admin'] = 'assets/css/eltd-forms.css';
        $this->styles['eltd-import'] = 'assets/css/eltd-import.css';
        $this->styles['font-awesome-admin'] = 'assets/css/font-awesome/css/font-awesome.min.css';
        $this->styles['select2'] = 'assets/css/select2.min.css';

        foreach ($this->styles as $styleHandle => $stylePath) {
            findme_elated_register_skin_style($styleHandle, $stylePath);
        }
    }

	/**
	 * Method that set menu icons
	 */
	public function setIcons() {
		$this->icons = array(
			'slider' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
            'slider-lite' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'carousel' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'testimonial' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'portfolio' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'team' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'masonry-gallery' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'proofing-gallery' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'stock-photography' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
            'course' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
            'lesson' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
            'quiz' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
            'question' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'options' => 'dashicons-admin-generic'
		);
	}

	/**
	 * Method that set menu item position
	 */
	public function setMenuItemPosition() {
		$this->itemPosition = array(
			'carousel' => 4,
			'testimonial' => 4,
			'portfolio' => 4,
			'team' => 4,
			'masonry-gallery' => 4,
			'proofing-gallery' => 4,
            'stock-photography' => 4,
            'course' => 20,
            'lesson' => 21,
            'question' => 22,
            'quiz' => 23,
			'options' => 1000
		);
	}

    /**
     * Method that renders options page
     *
     * @see SelectSkin::getHeader()
     * @see SelectSkin::getPageNav()
     * @see SelectSkin::getPageContent()
     */
    public function renderOptions() {
        global $findme_elated_Framework;
        $tab    		= findme_elated_get_admin_tab();
        $active_page 	= $findme_elated_Framework->eltdOptions->getAdminPageFromSlug($tab);
        $current_theme 	= wp_get_theme();

        if ($active_page == null) return;
        ?>
        <div class="eltd-options-page eltd-page">
            <?php $this->getHeader($current_theme->get('Name'), $current_theme->get('Version')); ?>
            <div class="eltd-page-content-wrapper">
                <div class="eltd-page-content">
                    <div class="eltd-page-navigation eltd-tabs-wrapper vertical left clearfix">
                        <?php $this->getPageNav($tab); ?>
                        <?php $this->getPageContent($active_page, $tab); ?>
                    </div>
                </div>
            </div>
        </div>
        <a id='back_to_top' href='#'>
            <span class="fa-stack">
                <span class="fa fa-angle-up"></span>
            </span>
        </a>
    <?php }

    /**
     * Method that renders header of options page.
     * @param string theme name to display
     * @param string theme version to display
     * @param bool whether to show save button or not
     *
     * @see EltdSkinAbstract::loadTemplatePart()
     */
    public function getHeader($themeName = '', $themeVersion, $showSaveButton = true) {
        $this->loadTemplatePart('header', array(
            'themeName' => $themeName,
            'themeVersion' => $themeVersion,
            'showSaveButton' => $showSaveButton)
        );
    }

    /**
     * Method that loads page navigation
     * @param string $tab current tab
     * @param bool $isImportPage if is import page highlighted that tab
     *
     * @see EltdSkinAbstract::loadTemplatePart()
     */
    public function getPageNav($tab, $isImportPage = false, $isBackupOptionsPage = false) {
        $this->loadTemplatePart('navigation', array(
            'tab' => $tab,
            'isImportPage' => $isImportPage,
            'isBackupOptionsPage' => $isBackupOptionsPage
        ));
    }

    /**
     * Method that loads current page content
     *
     * @param FindmeElatedAdminPage $page current page to load
     * @param string $tab current page slug
     * @param bool $showAnchors whether to show anchors template or not
     *
     * @see EltdSkinAbstract::loadTemplatePart()
     */
    public function getPageContent($page, $tab, $showAnchors = true) {
        $this->loadTemplatePart('content', array(
            'page' => $page,
            'tab' => $tab,
            'showAnchors' => $showAnchors
        ));
    }

    /**
     * Method that loads content for import page
     */
    public function getImportContent() {
        $this->loadTemplatePart('content-import');
    }

	/**
     * Method that loads content for import page
     */
    public function getBackupOptionsContent() {
        $this->loadTemplatePart('backup-options');
    }

    /**
     * Method that loads anchors and save button template part
     *
	 * @param FindmeElatedAdminPage $page current page to load
     *
     * @see EltdSkinAbstract::loadTemplatePart()
     */
    public function getAnchors($page) {
        $this->loadTemplatePart('anchors', array('page' => $page));
    }

	/**
	 * Method that renders backup options page
	 *
	 * @see SelectSkin::getHeader()
	 * * @see SelectSkin::getPageNav()
	 * * @see SelectSkin::getImportContent()
	 */
	public function renderBackupOptions() { ?>
		<div class="eltd-options-page eltd-page">
			<?php $this->getHeader(findme_elated_get_theme_info_item('Name'), findme_elated_get_theme_info_item('Version'), false); ?>
			<div class="eltd-page-content-wrapper">
				<div class="eltd-page-content">
					<div class="eltd-page-navigation eltd-tabs-wrapper vertical left clearfix">
						<?php $this->getPageNav('backup_options', false, true); ?>
						<?php $this->getBackupOptionsContent(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php }
	
    /**
     * Method that renders import page
     *
     * @see SelectSkin::getHeader()
     * * @see SelectSkin::getPageNav()
     * * @see SelectSkin::getImportContent()
     */
    public function renderImport() { ?>
        <div class="eltd-options-page eltd-page">
            <?php $this->getHeader(findme_elated_get_theme_info_item('Name'), findme_elated_get_theme_info_item('Version'), false); ?>
            <div class="eltd-page-content-wrapper">
                <div class="eltd-page-content">
                    <div class="eltd-page-navigation eltd-tabs-wrapper vertical left clearfix">
                        <?php $this->getPageNav('tabimport', true); ?>
                        <?php $this->getImportContent(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }
}
?>