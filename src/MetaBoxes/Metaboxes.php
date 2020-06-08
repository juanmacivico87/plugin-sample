<?php
/**
 * Load custom metaboxes.
 *
 * @package plugin-sample
 */

if ( !defined( 'ABSPATH' ) )
    exit;

class Metaboxes
{
    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'load_custom_metaboxes' ) );
    }

    public function load_custom_metaboxes()
    {
        require 'SampleMetabox/SampleMetabox.php';
        $custom_metabox = new SampleMetabox();
    }
}
