<?php
namespace PrefixConfig;

if ( false === defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * PluginDependencies
 *
 * This class checks that the website where the plugin is installed has the dependencies that it needs to work.
 *
 * @version	1.0
 * @since  	1.0
 * @package	{{ plugin_slug }}
 */
class PluginDependencies
{
    private static ?array $active_plugins = null;

    public static string $min_php_version   = '7.4.0';
    public static string $min_wp_version    = '5.0';
    public static array $dependencies       = [
        'Advanced Custom Fields PRO' => 'advanced-custom-fields-pro/acf.php',
    ];

    /**
     * init()
     *
     * This method is responsible for making a query to the database to obtain the list of active plugins on the website.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	{{ plugin_slug }}
     */
    public static function init(): void
    {
		self::$active_plugins = get_option( 'active_plugins', [] );

		if ( false !== is_multisite() ) {
            self::$active_plugins = array_merge( self::$active_plugins, get_site_option( 'active_sitewide_plugins', [] ) );
        }
	}

    /**
     * check_dependencies()
     *
     * This method is responsible for checking if the website has the dependencies and minimum requirements
     * that the plugin needs to work.
     *
     * @return 	bool If the website has all the dependencies, the method will return TRUE. Otherwise it will return FALSE.
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	{{ plugin_slug }}
     */
    public static function check_dependencies(): bool
    {
        global $wp_version;
        
        if ( null === self::$active_plugins )
            self::init();
        
        foreach( self::$dependencies as $name => $plugin ) {
            if ( false === in_array( $plugin, self::$active_plugins ) )
                return false;
        }

        if ( false === version_compare( PHP_VERSION, self::$min_php_version, '>=' ) )
            return false;
            
        if ( false === version_compare( $wp_version, self::$min_wp_version, '>=' ) )
            return false;

		return true;
	}
}
