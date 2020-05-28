<?php
/**
 * Load custom metaboxes.
 *
 * @package jmc87_plugin
 */

class JMC87_Metaboxes
{
    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'load_custom_metaboxes' ) );
    }

    public function load_custom_metaboxes()
    {
        require 'SampleMetabox/SampleMetabox.php';
        $custom_metabox = new JMC87_SampleMetabox();
    }
}
