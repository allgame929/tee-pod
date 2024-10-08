<?php

/**
 * Plugin dependency management
 *
 * @package BornDigital
 */

namespace MI\Setup;

/**
 * Dependencies class to manage plugin dependency
 */
class Dependencies
{
    /**
     * Main flow
     */
    public function __construct()
    {
        add_action('tgmpa_register', [$this, 'plugin_dependencies'], 11);
    }

    /**
     * Plugin dependecies
     */
    public function plugin_dependencies()
    {
        $plugins = array(
            array(
                'name'               => 'Advanced Custom Fields Pro', // The plugin name.
                'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
                'source'             => get_stylesheet_directory() . '/libraries/plugins/advanced-custom-fields-pro.zip', // The plugin source.
                'required'           => true, // If false, the plugin is only 'recommended' instead of required.
                'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented.
                'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
                'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
                'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            ),
        );

        /**
         * Array of configuration settings. Amend each line as needed.
         * If you want the default strings to be available under your own theme domain,
         * leave the strings uncommented.
         * Some of the strings are added into a sprintf, so see the comments at the
         * end of each line for what each argument will be.
         */
        $config = array(
            'domain'       => 'hello-theme-child', // Text domain - likely want to be the same as your theme.
            'default_path' => '', // Default absolute path to pre-packaged plugins.
            'parent_slug'  => 'themes.php', // Default parent menu slug.
            'menu'         => 'install-required-plugins', // Menu slug.
            'has_notices'  => true, // Show admin notices or not.
            'is_automatic' => false, // Automatically activate plugins after installation or not.
            'message'      => '', // Message to output right before the plugins table.
            'strings'      => array(
                'page_title'                      => __('Install Required Plugins', 'themedomain'),
                'menu_title'                      => __('Install Plugins', 'themedomain'),
                // translators: %s: plugin name.
                'installing'                      => __('Installing Plugin: %s', 'themedomain'),
                'oops'                            => __('Something went wrong with the plugin API.', 'themedomain'),
                // translators: %1$s: plugin name(s).
                'notice_can_install_required'     => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.'),
                // translators: %1$s: plugin name(s).
                'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'),
                // translators: %1$s: plugin name(s).
                'notice_cannot_install'           => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'),
                // translators: %1$s: plugin name(s).
                'notice_can_activate_required'    => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'),
                // translators: %1$s: plugin name(s).
                'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'),
                // translators: %1$s: plugin name(s).
                'notice_cannot_activate'          => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'),
                // translators: %1$s: plugin name(s).
                'notice_ask_to_update'            => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'),
                // translators: %s: plugin name.
                'notice_cannot_update'            => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'),
                'install_link'                    => _n_noop('Begin installing plugin', 'Begin installing plugins'),
                'activate_link'                   => _n_noop('Activate installed plugin', 'Activate installed plugins'),
                'return'                          => __('Return to Required Plugins Installer', 'themedomain'),
                'plugin_activated'                => __('Plugin activated successfully.', 'themedomain'),
                // translators: %1$s: dashboard link.
                'complete'                        => __('All plugins installed and activated successfully. %s', 'themedomain'),
            ),
        );

        tgmpa($plugins, $config);
    }
}

new Dependencies();
