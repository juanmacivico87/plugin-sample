<?php
/*
Plugin Name: Plugin Name
Plugin URI: https://www.myplugin.com
Description: A little plugin description
Version: 1.0
Author: Your Name
Author URI: https://www.yourwebsite.com
License: GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  plugin-sample
Domain Path:  /languages

[Plugin Name] is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
[Plugin Name] is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with [Plugin Name]. If not, see https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( !defined( 'ABSPATH' ) )
    exit;

require_once 'vendor/autoload.php';

use PrefixConfig\PluginConfig;
$prefix_config = new PluginConfig();

if ( !defined( 'PREFIX_PLUGIN_VERSION' ) )
    define( 'PREFIX_PLUGIN_VERSION', '1.0' );

if ( !defined( 'PREFIX_LANG_DIR' ) )
    define( 'PREFIX_LANG_DIR', basename( dirname( __FILE__ ) ) . '/languages' );

if ( !defined( 'PREFIX_PLUGIN_DIR' ) )
    define( 'PREFIX_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if ( !defined( 'PREFIX_PLUGIN_URL' ) )
    define( 'PREFIX_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

function plugin_install()
{
    if ( !current_user_can( 'activate_plugins' ) ) {
        add_option( '__prefix_activate_plugin', 'plugin-sample' );
    }
}
register_activation_hook( __FILE__, 'plugin_install' );

function plugin_deactivate()
{
    if ( !current_user_can( 'activate_plugins' ) ) {
        add_option( '__prefix_not_deactivate_plugin', 'plugin-sample' );
        wp_redirect( admin_url( 'plugins.php' ) );
        die();
    }
}
register_deactivation_hook( __FILE__, 'plugin_deactivate' );

function plugin_uninstall()
{
    if ( current_user_can( 'activate_plugins' ) ) {
        
    }
}
// register_uninstall_hook( __FILE__, 'plugin_uninstall' );
