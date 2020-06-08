<?php
if ( !defined( 'ABSPATH' ) )
    exit;

class JMC87_PluginConfig
{
    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'load_includes' ) );

        add_action( 'admin_init', array( $this, 'activate_plugin_process' ) );
        add_action( 'admin_init', array( $this, 'deactivate_plugin_process' ) );
        add_action( 'admin_init', array( $this, 'uninstall_plugin_process' ) );
    }

    public function load_textdomain()
    {
        load_plugin_textdomain( 'plugin-sample', false, LANG_DIR );
    }

    public function load_includes()
    {
        if ( !is_admin() )
        {
            wp_enqueue_script( 'custom-scripts', PLUGIN_URL . 'inc/js/custom-scripts.js', array(), PLUGIN_VERSION, true );
            wp_enqueue_style( 'custom-styles', PLUGIN_URL . 'inc/css/custom-styles.css', array(), PLUGIN_VERSION );
        }
    }

    public static function plugin_install()
    {
        if ( !current_user_can( 'activate_plugins' ) ) {
            add_option( '__prefix_activate_plugin', 'plugin-sample' );
        }
    }

    public function activate_plugin_process()
    {
        if ( is_admin() && get_option( '__prefix_activate_plugin' ) === 'plugin-sample' ) {
            delete_option( '__prefix_activate_plugin' );
            deactivate_plugins( 'plugin-sample/plugin-sample.php', true );
            add_action( 'admin_notices', array( $this, 'render_activate_plugin_notice' ) );
        }
    }

    public function render_activate_plugin_notice()
    {
        ?><div class="notice notice-error is-dismissible">
            <p><?php _e( 'Don\'t have enough permissions to install this plugin.', 'plugin-sample' ); ?></p>
        </div><?php
    }

    public static function plugin_deactivate()
    {
        if ( !current_user_can( 'activate_plugins' ) ) {
            add_option( '__prefix_not_deactivate_plugin', 'plugin-sample' );
            wp_redirect( admin_url( 'plugins.php' ) );
            die();
        }
    }

    public function deactivate_plugin_process()
    {
        if ( is_admin() && get_option( '__prefix_not_deactivate_plugin' ) === 'plugin-sample' ) {
            delete_option( '__prefix_not_deactivate_plugin' );
            add_action( 'admin_notices', array( $this, 'render_deactivate_plugin_notice' ) );
        }
    }

    public function render_deactivate_plugin_notice()
    {
        ?><div class="notice notice-error is-dismissible">
            <p><?php _e( 'Don\'t have enough permissions to deactivate this plugin.', 'plugin-sample' ); ?></p>
        </div><?php
    }

    public static function plugin_uninstall()
    {
        if ( current_user_can( 'activate_plugins' ) ) {
            
        }
    }

    public function uninstall_plugin_process()
    {
        
    }

    public function render_uninstall_plugin_notice()
    {
        ?><div class="notice notice-error is-dismissible">
            <p><?php _e( 'Don\'t have enough permissions to uninstall this plugin.', 'plugin-sample' ); ?></p>
        </div><?php
    }
}
