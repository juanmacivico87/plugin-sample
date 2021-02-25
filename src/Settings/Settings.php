<?php
/**
 * A snippet to create a page of Settings for plugin.
 * 
 * @package plugin-sample
 */

namespace PrefixSource\Settings;

if ( !defined( 'ABSPATH' ) )
    exit;

class Settings
{
    const MENU_SLUG = 'plugin-sample-settings';

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        add_action( 'acf/init', array( $this, 'create_settings_page' ) );
        // add_action( 'init', array( $this, 'add_settings_page_fields' ) );
    }

    public function create_settings_page()
    {
        if ( function_exists( 'acf_add_options_page' ) ) {
            acf_add_options_page(
                array(
                    'page_title'        => __( '{{ plugin_name }} Settings', 'plugin-sample' ),
                    'menu_title'        => __( '{{ plugin_name }} Settings', 'plugin-sample' ),
                    'menu_slug'         => self::MENU_SLUG,
                    'capability'        => 'manage_options',
                    'position'          => '2.9',
                    'icon_url'          => 'dashicons-paperclip',
                    'redirect'          => true,
                    'update_button'     => __( 'Save', 'plugin-sample' ),
                    'updated_message'   => __( 'Settings have been saved successfully', 'plugin-sample' ),
                )
            );
        }
    }

    public function add_settings_page_fields()
    {
        if ( function_exists( 'acf_add_local_field_group' ) ):
            acf_add_local_field_group();
        endif;
    }
}