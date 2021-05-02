<?php
/*
Plugin Name: 
Plugin URI: 
Description: 
Version: 1.0
Author: 
Author URI: 
License: GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  
Domain Path:  /languages

 is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
 is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with . If not, see https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( false === defined( 'ABSPATH' ) )
    exit;

require_once 'vendor/autoload.php';

use \PluginConfig;
$config = new PluginConfig();

define( 'LANG_DIR', basename( dirname( __FILE__ ) ) . '/languages' );
define( 'PLUGIN_FILE', __FILE__ );
define( 'PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PLUGIN_ASSETS', PLUGIN_URL . '/assets' );
define( 'PLUGIN_ADMIN_ASSETS', PLUGIN_URL . '/admin' );
define( 'PLUGIN_ENDPOINTS_NAMESPACE', '' );

register_activation_hook( PLUGIN_FILE, array( '\PostsTypes\CustomPostType\CustomPostType', 'set_roles_capabilities' ) );
register_activation_hook( PLUGIN_FILE, array( '\Taxonomies\CustomCategory\CustomCategory', 'set_roles_capabilities' ) );
register_activation_hook( PLUGIN_FILE, array( '\Taxonomies\CustomTag\CustomTag', 'set_roles_capabilities' ) );
