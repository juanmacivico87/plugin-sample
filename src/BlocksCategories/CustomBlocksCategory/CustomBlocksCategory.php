<?php
/**
 * A snippet to create a new category to Gutenberg blocks. For more info, view:
 *
 * @link https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
 *
 * @package plugin-sample
 */

namespace PrefixSource\BlocksCategories\CustomBlocksCategory;

if ( !defined( 'ABSPATH' ) )
    exit;

use PrefixSource\PostsTypes\SamplePostType\SamplePostType;

class CustomBlocksCategory
{
    const BLOCK_CATEGORY_SLUG = 'custom-blocks-category';

    public function __construct()
    {
        add_filter( 'block_categories', array( $this, 'add_custom_block_category' ), 10, 2 );
    }

    public function add_custom_block_category( $categories, $post ) {
        $allowed_posts_types = array( SamplePostType::POST_TYPE_NAME );
        
        if ( !in_array( $post->post_type, $allowed_posts_types ) ) {
            return $categories;
        }

        return array_merge(
            $categories,
            array(
                array(
                    'slug' => self::BLOCK_CATEGORY_SLUG,
                    'title' => __( 'Custom Blocks Category', 'plugin-sample' ),
                    'icon'  => '',
                ),
            )
        );
    }
}
