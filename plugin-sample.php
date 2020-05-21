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
Text Domain:  jmc87_plugin_textdomain
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

function jmc87_plugin_install()
{
    if ( !current_user_can( 'activate_plugins' ) )
        wp_die( sprintf( esc_html__( 'Don\'t have enough permissions to install this plugin.<br /><a href="%s">Back to plugins page.</a>', 'jmc87_plugin_textdomain' ), esc_url( admin_url( 'plugins.php' ) ) ) );
}
register_activation_hook( __FILE__, 'jmc87_plugin_install' );

function jmc87_plugin_deactivation()
{
    if ( !current_user_can( 'activate_plugins' ) )
        wp_die( sprintf( esc_html__( 'Don\'t have enough permissions to disable this plugin.<br /><a href="%s">Back to plugins page.</a>', 'jmc87_plugin_textdomain' ), esc_url( admin_url( 'plugins.php' ) ) ) );
}
register_deactivation_hook( __FILE__, 'jmc87_plugin_deactivation' );

function jmc87_plugin_uninstall()
{
    if ( !current_user_can( 'activate_plugins' ) )
        wp_die( sprintf( esc_html__( 'Don\'t have enough permissions to uninstall this plugin.<br /><a href="%s">Back to plugins page.</a>', 'jmc87_plugin_textdomain' ), esc_url( admin_url( 'plugins.php' ) ) ) );
}
register_uninstall_hook( __FILE__, 'jmc87_plugin_uninstall' );

require 'config/config.php';
$config = new JMC87_PluginConfig();

require 'src/customizerSection/customizer.php';
$customizer = new JMC87_Customizer();

require 'src/customPostsTypes/samplePostType/sample-post-type.php';
$custom_post_type = new JMC87_SamplePostType();

require 'src/customTaxonomies/customCategory/custom-category.php';
$custom_category = new JMC87_CustomCategory();

require 'src/customTaxonomies/customTag/custom-tag.php';
$custom_tag = new JMC87_CustomTag();

require 'src/customMetaboxes/sampleMetabox/sample-metabox.php';
$custom_metabox = new JMC87_SampleMetabox();

require 'src/customBlocks/customACFBlock/custom-acf-block.php';
$custom_acf_block = new JMC87_CustomACFGutenbergBlock();
