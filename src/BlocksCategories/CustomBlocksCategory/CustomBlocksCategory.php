<?php
namespace PrefixSource\BlocksCategories\CustomBlocksCategory;

if ( false === defined( 'ABSPATH' ) )
    exit;

use PrefixSource\PostsTypes\CustomPostType\CustomPostType;

/**
 * CustomBlocksCategory
 *
 * This class provides an example to create custom categories for our Gutenberg blocks.
 * For more information, visit the @link https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
 *
 * @version	1.0
 * @since  	1.0
 * @package	plugin-sample
 */
class CustomBlocksCategory
{
    const BLOCK_CATEGORY_SLUG = 'custom-blocks-category';

    /**
     * __construct()
     *
     * This method is responsible for initializing the class and assigning values to its internal properties, from anywhere
     * in the code where an object of that class is instantiated.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * init()
     *
     * This method takes care of hooking the rest of the methods of the class in the corresponding hooks that are provided for it.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function init() : void
    {
        add_filter( 'block_categories', array( $this, 'add_custom_blocks_category' ), 10, 2 );
    }

    /**
     * add_custom_blocks_category()
     *
     * This method is responsible for registering the new category for the blocks and setting it to the desired post types.
     *
     * @param   array   $categories Array of block categories.
     * @param   WP_Post $post       Post being loaded.
     * @return 	array   Array with the new categories added.
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function add_custom_blocks_category( array $categories, \WP_Post $post ) : array
    {
        $allowed_posts_types = array( CustomPostType::POST_TYPE_NAME );
        
        if ( false === in_array( $post->post_type, $allowed_posts_types ) )
            return $categories;

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
