<?php
/**
 * Load custom Gutenberg blocks.
 *
 * @package plugin-sample
 */

namespace Source\Blocks;

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
        $custom_acf_block = new \Source\Blocks\CustomACFBlock\CustomACFBlock;
    }
}
