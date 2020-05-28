<?php
/**
 * Load custom taxonomies.
 *
 * @package jmc87_plugin
 */

class JMC87_Taxonomies
{
    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'load_custom_taxonomies' ) );
    }

    public function load_custom_taxonomies()
    {
        require 'CustomCategory/CustomCategory.php';
        $custom_category = new JMC87_CustomCategory();

        require 'CustomTag/CustomTag.php';
        $custom_tag = new JMC87_CustomTag();
    }
}
