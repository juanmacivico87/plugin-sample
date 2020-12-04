<?php
namespace PrefixConfig;

if ( !defined( 'ABSPATH' ) )
    exit;

use PrefixSource\Settings\Settings;
use PrefixSource\Blocks\CustomACFBlock\CustomACFBlock;
use PrefixSource\BlocksCategories\CustomBlocksCategory\CustomBlocksCategory;
use PrefixSource\Customizer\CustomizerSection\CustomizerSection;
use PrefixSource\Endpoints\CustomEndpoint\CustomEndpoint;
use PrefixSource\Metaboxes\SampleMetabox\SampleMetabox;
use PrefixSource\PostsTypes\SamplePostType\SamplePostType;
use PrefixSource\RestApi\CustomRestField\CustomRestField;
use PrefixSource\Roles\CustomRole\CustomRole;
use PrefixSource\Taxonomies\CustomCategory\CustomCategory;
use PrefixSource\Taxonomies\CustomTag\CustomTag;

class PluginConfig
{
    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'load_sources' ) );
        add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'load_front_end_assets' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_assets' ) );

        add_action( 'admin_init', array( $this, 'activate_plugin_process' ) );
        add_action( 'admin_init', array( $this, 'deactivate_plugin_process' ) );
        // add_action( 'admin_init', array( $this, 'uninstall_plugin_process' ) );
    }

    public function load_sources()
    {
        /** Settings */
        new Settings();

        /** Customizer sections */
        new CustomizerSection();

        /** Taxonomies */
        new CustomCategory();
        new CustomTag;

        /** Post types */
        new SamplePostType();

        /** Blocks categories */
        new CustomBlocksCategory();

        /** Blocks */
        new CustomACFBlock();

        /** Metaboxes */
        new SampleMetabox();

        /** Endpoints */
        new CustomEndpoint();

        /** RestApi */
        new CustomRestField();

        /** Roles */
        new CustomRole();
    }

    public function load_textdomain()
    {
        load_plugin_textdomain( 'plugin-sample', false, PREFIX_LANG_DIR );
    }

    public function load_front_end_assets()
    {
        wp_enqueue_script( 'plugin-sample-front', PREFIX_PLUGIN_ASSETS . '/js/scripts.js', array(), PREFIX_PLUGIN_VERSION, true );
        wp_enqueue_style( 'plugin-sample-front', PREFIX_PLUGIN_ASSETS . '/css/styles.css', array(), PREFIX_PLUGIN_VERSION );
    }

    public function load_admin_assets()
    {
        wp_enqueue_script( 'plugin-sample-admin', PREFIX_PLUGIN_ADMIN_ASSETS . '/js/scripts.js', array(), PREFIX_PLUGIN_VERSION, true );
        wp_enqueue_style( 'plugin-sample-admin', PREFIX_PLUGIN_ADMIN_ASSETS . '/css/styles.css', array(), PREFIX_PLUGIN_VERSION );
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
