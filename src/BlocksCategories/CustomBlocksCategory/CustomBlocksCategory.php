<?php
/**
 * A snippet to create a new category to Gutenberg blocks. For more info, view:
 *
 * @link https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
 *
 * @package jmc87_plugin
 */

class JMC87_CustomBlocksCategory
{
    public function __construct()
    {
        add_filter( 'block_categories', array( $this, 'add_custom_block_category' ), 10, 2 );
    }

    public function add_custom_block_category( $categories, $post ) {
        $allowed_posts_types = array( 'post' );
        
        if ( !in_array( $post->post_type, $allowed_posts_types ) ) {
            return $categories;
        }

        return array_merge(
            $categories,
            array(
                array(
                    'slug' => 'custom-blocks-category',
                    'title' => __( 'Custom Blocks Category', 'plugin-sample' ),
                    'icon'  => '',
                ),
            )
        );
    }
}
