<?php
/**
 * Load custom Gutenberg blocks.
 *
 * @package plugin-sample
 */

if ( !defined( 'ABSPATH' ) )
    exit;

class Blocks
{
    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'load_custom_blocks' ) );
    }

    public function load_custom_blocks()
    {
        require 'CustomACFBlock/CustomACFBlock.php';
        $custom_acf_block = new CustomACFGutenbergBlock();
    }
}
