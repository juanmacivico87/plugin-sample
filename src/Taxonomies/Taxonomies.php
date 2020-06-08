<?php
/**
 * Load custom taxonomies.
 *
 * @package plugin-sample
 */

if ( !defined( 'ABSPATH' ) )
    exit;

class Taxonomies
{
    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'load_custom_taxonomies' ) );
    }

    public function load_custom_taxonomies()
    {
        require 'CustomCategory/CustomCategory.php';
        $custom_category = new CustomCategory();

        require 'CustomTag/CustomTag.php';
        $custom_tag = new CustomTag();
    }
}
