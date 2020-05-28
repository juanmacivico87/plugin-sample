<?php
/**
 * Load custom categories to Gutenberg blocks.
 *
 * @package jmc87_plugin
 */

class JMC87_BlocksCategories
{
    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'load_custom_blocks_categories' ) );
    }

    public function load_custom_blocks_categories()
    {
        require 'CustomBlocksCategory/CustomBlocksCategory.php';
        $custom_blocks_category = new JMC87_CustomBlocksCategory();
    }
}
