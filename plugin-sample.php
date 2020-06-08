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

require 'config/PluginConfig.php';
$config = new PluginConfig();

if ( !defined( 'PLUGIN_VERSION' ) )
    define( 'PLUGIN_VERSION', '1.0' );

if ( !defined( 'LANG_DIR' ) )
    define( 'LANG_DIR', basename( dirname( __FILE__ ) ) . '/languages' );

if ( !defined( 'PLUGIN_DIR' ) )
    define( 'PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if ( !defined( 'PLUGIN_URL' ) )
    define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );

register_activation_hook( __FILE__, array( 'PluginConfig', 'plugin_install' ) );
register_deactivation_hook( __FILE__, array( 'PluginConfig', 'plugin_deactivate' ) );
register_uninstall_hook( __FILE__, array( 'PluginConfig', 'plugin_uninstall' ) );

require 'src/BlocksCategories/BlocksCategories.php';
$custom_blocks_categories = new BlocksCategories();

require 'src/Blocks/Blocks.php';
$custom_blocks = new Blocks();

require 'src/Customizer/Customizer.php';
$customizer = new Customizer();

require 'src/Metaboxes/Metaboxes.php';
$custom_metaboxes = new Metaboxes();

require 'src/PostsTypes/PostsTypes.php';
$custom_posts_type = new PostsTypes();

require 'src/Taxonomies/Taxonomies.php';
$custom_taxonomies = new Taxonomies();
