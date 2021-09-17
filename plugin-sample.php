<?php
/*
Plugin Name: {{ plugin_name }}
Plugin URI: {{ plugin_uri }}
Description: {{ plugin_description }}
Version: 1.0
Author: {{ plugin_author }}
Author URI: {{ plugin_author_uri }}
License: GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  {{ plugin_slug }}
Domain Path:  /languages

{{ plugin_name }} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
{{ plugin_name }} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with {{ plugin_name }}. If not, see https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( false === defined( 'ABSPATH' ) ) {
    exit;
}

require_once 'vendor/autoload.php';

use PrefixConfig\PluginConfig;
$prefix_config = new PluginConfig();

define( 'PREFIX_LANG_DIR', basename( dirname( __FILE__ ) ) . '/languages' );
define( 'PREFIX_PLUGIN_FILE', __FILE__ );
define( 'PREFIX_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'PREFIX_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PREFIX_PLUGIN_ASSETS', PREFIX_PLUGIN_URL . '/assets' );
define( 'PREFIX_PLUGIN_ADMIN_ASSETS', PREFIX_PLUGIN_URL . '/admin' );
define( 'PREFIX_PLUGIN_ENDPOINTS_NAMESPACE', '{{ plugin_slug }}' );

register_activation_hook( PREFIX_PLUGIN_FILE, array( 'PrefixSource\PostsTypes\CustomPostType\CustomPostType', 'set_roles_capabilities' ) );
register_activation_hook( PREFIX_PLUGIN_FILE, array( 'PrefixSource\Taxonomies\CustomCategory\CustomCategory', 'set_roles_capabilities' ) );
register_activation_hook( PREFIX_PLUGIN_FILE, array( 'PrefixSource\Taxonomies\CustomTag\CustomTag', 'set_roles_capabilities' ) );
