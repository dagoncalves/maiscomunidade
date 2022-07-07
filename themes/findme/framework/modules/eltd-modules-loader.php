<?php

if(!function_exists('findme_elated_load_modules')) {
    /**
     * Loades all modules by going through all folders that are placed directly in modules folder
     * and loads load.php file in each. Hooks to findme_elated_after_options_map action
     *
     * @see http://php.net/manual/en/function.glob.php
     */
    function findme_elated_load_modules() {
        foreach(glob(ELATED_FRAMEWORK_ROOT_DIR.'/modules/*/load.php') as $module_load) {
            include_once $module_load;
        }
    }

    add_action('findme_elated_before_options_map', 'findme_elated_load_modules');
}