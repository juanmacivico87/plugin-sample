<?php
/**
 * Load custom categories to Gutenberg blocks.
 *
 * @package plugin-sample
 */

namespace Source\BlocksCategories;

if ( !defined( 'ABSPATH' ) )
    exit;

class BlocksCategories
{
    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'load_custom_blocks_categories' ) );
    }

    public function load_custom_blocks_categories()
    {
        $custom_blocks_category = new \Source\BlocksCategories\CustomBlocksCategory\CustomBlocksCategory;
    }
}
