<?php
if ( !defined( 'ABSPATH' ) )
    exit;

class JMC87_PluginConfig
{
    public function __construct()
    {
        $this->create_plugin_constants();

        add_action( 'plugins_loaded', array( $this, 'jmc87_load_textdomain' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'jmc87_load_includes' ) );
    }

    public function create_plugin_constants()
    {
        if ( !defined( 'PLUGIN_VERSION' ) )
            define( 'PLUGIN_VERSION', '1.0' );

        if ( !defined( 'LANG_DIR' ) )
            define( 'LANG_DIR', basename( dirname( __FILE__ ) ) . '/languages' );

        if ( !defined( 'PLUGIN_DIR' ) )
            define( 'PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

        if ( !defined( 'PLUGIN_URL' ) )
            define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
    }

    public function jmc87_load_textdomain()
    {
        load_plugin_textdomain( 'jmc87_plugin_textdomain', false, LANG_DIR );
    }

    public function jmc87_load_includes()
    {
        if ( !is_admin() )
        {
            wp_enqueue_script( 'custom-scripts', PLUGIN_URL . 'inc/js/custom-scripts.js', array(), PLUGIN_VERSION, true );
            wp_enqueue_style( 'custom-styles', PLUGIN_URL . 'inc/css/custom-styles.css', array(), PLUGIN_VERSION );
        }
    }
}
