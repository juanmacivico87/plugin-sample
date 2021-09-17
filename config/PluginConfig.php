<?php
namespace PrefixConfig;

if ( false === defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * PluginConfig
 *
 * This class sets the plugin configuration. In it, all the classes in the "src" folder with the plugin functionalities
 * are instantiated, the textdomain is set for the translation strings, the CSS / Javascript files common for the entire
 * plugin are enqueued and other methods that may be utility for plugin configuration.
 *
 * @version	1.0
 * @since  	1.0
 * @package	{{ plugin_slug }}
 */
class PluginConfig
{
    const PLUGIN_CLASSES = [];

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
     * @package	{{ plugin_slug }}
     */
    public function __construct()
    {
        if ( false === PluginDependencies::check_dependencies() ) {
            add_action( 'admin_notices', array( $this, 'render_dependencies_not_found_notice' ) );
            return;
        }
        
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
     * @package	{{ plugin_slug }}
     */
    public function init(): void
    {
        add_action( 'plugins_loaded', [ $this, 'load_sources' ] );
        add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'load_front_end_assets' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'load_admin_assets' ] );
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
     * @package	{{ plugin_slug }}
     */
    public function load_sources(): void
    {
        foreach(self::PLUGIN_CLASSES as $class) {
            new $class();
        }
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
     * @package	{{ plugin_slug }}
     */
    public function load_textdomain(): void
    {
        load_plugin_textdomain( '{{ plugin_slug }}', false, PREFIX_LANG_DIR );
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
     * @package	{{ plugin_slug }}
     */
    public function load_front_end_assets(): void
    {
        wp_enqueue_script( '{{ plugin_slug }}-front', PREFIX_PLUGIN_ASSETS . '/js/scripts.js', [], '1.0', true );
        wp_enqueue_style( '{{ plugin_slug }}-front', PREFIX_PLUGIN_ASSETS . '/css/styles.css', [], '1.0' );
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
     * @package	{{ plugin_slug }}
     */
    public function load_admin_assets(): void
    {
        wp_enqueue_script( '{{ plugin_slug }}-admin', PREFIX_PLUGIN_ADMIN_ASSETS . '/js/scripts.js', [], '1.0', true );
        wp_enqueue_style( '{{ plugin_slug }}-admin', PREFIX_PLUGIN_ADMIN_ASSETS . '/css/styles.css', [], '1.0' );
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
     * @package	{{ plugin_slug }}
     */
    public function render_dependencies_not_found_notice(): void
    {
        $dependencies = PluginDependencies::$dependencies;
        ?><div class="notice notice-error is-dismissible">
            <p><?php _e( 'In order to activate the "{{ plugin_name }}" plugin, you have to meet the next requirements:', '{{ plugin_slug }}' ); ?></p>
            <ul>
                <li><?php echo sprintf( __( 'PHP version: %s', '{{ plugin_slug }}' ), PluginDependencies::$min_php_version ) ?></li>
                <li><?php echo sprintf( __( 'WordPress version: %s', '{{ plugin_slug }}' ), PluginDependencies::$min_wp_version ) ?></li>
                <?php foreach( $dependencies as $name => $plugin ) : ?>
                    <li><?php echo sprintf( __( 'Activate plugin: %s', '{{ plugin_slug }}' ), $name ) ?></li>
                <?php endforeach ?>
            </ul>
        </div><?php
    }
}
