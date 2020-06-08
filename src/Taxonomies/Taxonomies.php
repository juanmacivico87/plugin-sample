<?php
/**
 * Load custom taxonomies.
 *
 * @package plugin-sample
 */

namespace Source\Taxonomies;

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
        $custom_category = new \Source\Taxonomies\CustomCategory\CustomCategory;
        $custom_tag      = new \Source\Taxonomies\CustomTag\CustomTag;
    }
}
