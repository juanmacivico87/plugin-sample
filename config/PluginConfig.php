<?php
/**
 * PluginConfig
 *
 * This class sets the plugin configuration. In it, all the classes in the "src" folder with the plugin functionalities
 * are instantiated, the textdomain is set for the translation strings, the CSS / Javascript files common for the entire
 * plugin are enqueued and other methods that may be utility for plugin configuration.
 *
 * @version	1.0
 * @since  	1.0
 * @package	plugin-sample
 */

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
        if ( false === PluginDependencies::check_dependencies() )
            add_action( 'admin_notices', array( $this, 'render_dependencies_not_found_notice' ) );
        else
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
    public function init()
    {
        add_action( 'plugins_loaded', array( $this, 'load_sources' ) );
        add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'load_front_end_assets' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_assets' ) );
    }

    /**
     * load_sources()
     *
     * This method is responsible for instantiating the classes that contain the different functionalities of the plugin.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
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

    /**
     * load_textdomain()
     *
     * This method is the one that tells WordPress which is the textdomain used by the plugin to translate its text strings.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function load_textdomain()
    {
        load_plugin_textdomain( 'plugin-sample', false, PREFIX_LANG_DIR );
    }

    /**
     * load_front_end_assets()
     *
     * This method is responsible for queuing all the CSS and Javascript files that the plugin uses on the front of the website.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function load_front_end_assets()
    {
        wp_enqueue_script( 'plugin-sample-front', PREFIX_PLUGIN_ASSETS . '/js/scripts.js', array(), '1.0', true );
        wp_enqueue_style( 'plugin-sample-front', PREFIX_PLUGIN_ASSETS . '/css/styles.css', array(), '1.0' );
    }

    /**
     * load_admin_assets()
     *
     * This method is the one that takes care of queuing all the CSS and Javascript files that the plugin uses in the
     * back office of the website.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function load_admin_assets()
    {
        wp_enqueue_script( 'plugin-sample-admin', PREFIX_PLUGIN_ADMIN_ASSETS . '/js/scripts.js', array(), '1.0', true );
        wp_enqueue_style( 'plugin-sample-admin', PREFIX_PLUGIN_ADMIN_ASSETS . '/css/styles.css', array(), '1.0' );
    }

    /**
     * render_dependencies_not_found_notice()
     *
     * This method is responsible for displaying an error message in the event that any of the dependencies
     * that the plugin needs to work are not found.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function render_dependencies_not_found_notice()
    {
        $dependencies = PluginDependencies::$dependencies;
        ?><div class="notice notice-error is-dismissible">
            <p><?php _e( 'In order to activate the "{{ plugin_name }}" plugin, you have to meet the next requirements:', 'plugin-sample' ); ?></p>
            <ul>
                <li><?php echo sprintf( __( 'PHP version: %s', 'plugin-sample' ), PluginDependencies::$min_php_version ) ?></li>
                <li><?php echo sprintf( __( 'WordPress version: %s', 'plugin-sample' ), PluginDependencies::$min_wp_version ) ?></li>
                <?php foreach( $dependencies as $name => $plugin ) : ?>
                    <li><?php echo sprintf( __( 'Activate plugin: %s', 'plugin-sample' ), $name ) ?></li>
                <?php endforeach ?>
            </ul>
        </div><?php
    }
}
