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
use PrefixSource\Shortcodes\CustomShortcode\CustomShortcode;
use PrefixSource\Taxonomies\CustomCategory\CustomCategory;
use PrefixSource\Taxonomies\CustomTag\CustomTag;

class PluginConfig
{
    public function __construct()
    {
        if ( false === PluginDependencies::check_dependencies() )
            add_action( 'admin_notices', array( $this, 'render_dependencies_not_found_notice' ) );
        else
            $this->init();
    }

    public function init()
    {
        add_action( 'plugins_loaded', array( $this, 'load_sources' ) );
        add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'load_front_end_assets' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_assets' ) );
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

        /** Shortcodes */
        new CustomShortcode();

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

    public function render_dependencies_not_found_notice()
    {
        $dependencies = PluginDependencies::$dependencies;
        ?><div class="notice notice-error is-dismissible">
            <p><?php _e( 'The following plugins are necessary for "Plugin Sample" to work successfully:', 'plugin-sample' ); ?></p>
            <ul>
                <?php foreach( $dependencies as $name => $plugin ) : ?>
                    <li><?php echo $name ?></li>
                <?php endforeach ?>
            </ul>
        </div><?php
    }
}
