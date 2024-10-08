<?php

/**
 * The template for Create Custom Post Type - Laten Beleggen used in WP-admin
 *
 * Author: Dicky Saputra
 *
 * @package HelloElementor
 */

class AcfInit
{
    public function __construct()
    {
        add_filter('acf/settings/show_admin', [$this, 'filter_acf_show_admin'], 10, 1);
        add_filter('acf/settings/save_json', [$this, 'save_json']);
        add_filter('acf/settings/load_json', [$this, 'load_json']);
    }

    public function save_json()
    {
        return dirname(__FILE__) . '/acf-json';
    }

    public function load_json()
    {
        $paths[] = dirname(__FILE__) . '/acf-json';
        return $paths;
    }

    public function filter_acf_show_admin($is_allowed)
    {
        $is_allowed = defined('IS_LOCAL') && IS_LOCAL ? true : false;
        return $is_allowed;
    }
}

new AcfInit();
