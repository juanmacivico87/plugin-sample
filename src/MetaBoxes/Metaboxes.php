<?php
/**
 * Load custom metaboxes.
 *
 * @package plugin-sample
 */

namespace Source\Metaboxes;

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
        $custom_metabox = new \Source\Metaboxes\SampleMetabox\SampleMetabox;
    }
}
