<?php

/**
 * Description : add all functionalities here
 */
defined('ABSPATH') || die("Can't access directly");


class Class_Functions
{
    public $settings;

    public function __construct()
    {
        $this->hook();
        $this->initialize();
    }

    /**
     * call all functions
     */


    public function hook()
    {
        add_filter("upload_mimes", [$this, "addFileTypesToUploads"]);
    }


    /**
     * Allow .svg upload
     */

    public function addFileTypesToUploads($file_types)
    {
        $new_filetypes = [];
        $new_filetypes["svg"] = "image/svg+xml";
        $file_types = array_merge($file_types, $new_filetypes);
        return $file_types;
    }

    /**
     * Load Script
     */
    private function autoloadScript($file_path)
    {
        foreach ($file_path as $path) {
            foreach (glob($path) as $file) {
                require_once $file;
            }
        }
    }

    /**
     * initialize
     */
    public function initialize()
    {
        $theme = wp_get_theme();

        // vars.
        $this->settings = array(

            // basic.
            'name'     => $theme->get('Hello Elementor Child'),
            'domain'   => $theme->get('HelloElementorChild'),
            'version'  => $theme->get('2.0.0'),

            // urls.
            'file'     => __FILE__,
            'basename' => plugin_basename(__FILE__),
            'path'     => get_stylesheet_directory(),
            'url'      => get_stylesheet_directory_uri(),
        );

        // constant
        define('BASE_URL', get_site_url());
        define('BASE_DIR', rtrim(ABSPATH, '/'));

        define('THEME_URL', $this->settings['url']);
        define('THEME_DIR', $this->settings['path']);
        define('THEME_VERSION', $this->settings['version']);
        define('THEME_DOMAIN', $this->settings['domain']);

        define('INCLUDES_URL', THEME_URL . '/starter-hello-elementor-child/includes');
        define('INCLUDES_DIR', THEME_DIR . '/starter-hello-elementor-child/includes');

        define('MODULES_URL', THEME_URL . '/starter-hello-elementor-child/modules');
        define('MODULES_DIR', THEME_DIR . '/starter-hello-elementor-child/modules');

        define('ASSET_IMAGE_URL', THEME_URL . '/starter-hello-elementor-child/assets/images');

        $this->autoloadScript(
            [
                MODULES_DIR . '/*/autoload.php',
                __DIR__ . '/setup/autoload.php'
            ]
        );
    }
}

/**
 * init class Class_Functions()
 */

new Class_Functions();
