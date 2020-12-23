<?php
namespace PrefixConfig;

if ( !defined( 'ABSPATH' ) )
    exit;

class PluginDependencies {

    private static $active_plugins  = null;

    public static $min_php_version  = '7.3.0';
    public static $min_wp_version   = '5.0';
    public static $dependencies     = array(
        'Advanced Custom Fields PRO' => 'advanced-custom-fields-pro/acf.php',
    );

    public static function init()
    {
		self::$active_plugins = get_option( 'active_plugins', array() );

		if ( is_multisite() )
			self::$active_plugins = array_merge( self::$active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
	}

    public static function check_dependencies()
    {
        global $wp_version;
        
        if ( null === self::$active_plugins )
            self::init();
        
        foreach( self::$dependencies as $name => $plugin ) {
            if ( !in_array( $plugin, self::$active_plugins ) )
                return false;
        }

        if ( false === version_compare( PHP_VERSION, self::$min_php_version, '>=' ) )
            return false;
            
        if ( false === version_compare( $wp_version, self::$min_wp_version, '>=' ) )
            return false;

		return true;
	}

}

