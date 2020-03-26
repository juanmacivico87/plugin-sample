<?php
if ( !defined( 'ABSPATH' ) )
    exit;

class JMC87_PluginConfig
{
    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'jmc87_load_textdomain' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'jmc87_load_includes' ) );
    }

    public function jmc87_load_textdomain()
    {
        load_plugin_textdomain( 'jmc87_plugin_textdomain', false, LANG_DIR );
    }

    public function jmc87_load_includes()
    {
        if ( !is_admin() )
        {
            wp_enqueue_script( 'custom-scripts', PLUGIN_URL . 'inc/js/custom-scripts.js', array(), false, true );
            wp_enqueue_style( 'custom-styles', PLUGIN_URL . 'inc/css/custom-styles.css' );
        }
    }
}
