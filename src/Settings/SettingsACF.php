<?php
namespace PrefixSource\Settings;

if ( false === defined( 'ABSPATH' ) )
    exit;

/**
 * Settings
 *
 * This class provides an example to create a settings page for the plugin with the help of the Advanced Custom Field PRO plugin.
 * For more information, visit the @link https://www.advancedcustomfields.com/resources/acf_add_options_page/
 *
 * @version	1.0
 * @since  	1.0
 * @package	plugin-sample
 */
class Settings
{
    const MENU_SLUG = 'plugin-sample-settings';

    /**
     * __construct()
     *
     * This method is responsible for initializing the class and assigning values to its internal properties, from anywhere
     * in the code where an object of that class is instantiated.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * init()
     *
     * This method takes care of hooking the rest of the methods of the class in the corresponding hooks that are provided for it.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function init() : void
    {
        add_action( 'acf/init', array( $this, 'create_settings_page' ) );
        // add_action( 'init', array( $this, 'add_settings_page_fields' ) );
    }

    /**
     * create_settings_page()
     *
     * This method is responsible for creating the plugin options page through the acf_add_options_page() function.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function create_settings_page() : void
    {
        if ( false === function_exists( 'acf_add_options_page' ) )
            return;

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

    /**
     * add_settings_page_fields()
     *
     * This method takes care of registering a group of fields and setting it to the options page, with the help of the
     * acf_add_local_field_group() function.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function add_settings_page_fields() : void
    {
        if ( false === function_exists( 'acf_add_local_field_group' ) )
            return;

        acf_add_local_field_group();
    }
}
