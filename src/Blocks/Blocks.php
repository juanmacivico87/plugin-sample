<?php
/**
 * Load custom Gutenberg blocks.
 *
 * @package jmc87_plugin
 */

class JMC87_Blocks
{
    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'load_custom_blocks' ) );
    }

    public function load_custom_blocks()
    {
        require 'CustomACFBlock/CustomACFBlock.php';
        $custom_acf_block = new JMC87_CustomACFGutenbergBlock();
    }
}
