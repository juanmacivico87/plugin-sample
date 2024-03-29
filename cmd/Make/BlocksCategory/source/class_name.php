<?php
namespace PrefixSource\BlocksCategories\class_name;

if ( false === defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * class_name
 *
 * This class provides an example to create custom categories for our Gutenberg blocks.
 * For more information, visit the @link https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
 *
 * @version	1.0
 * @since  	1.0
 * @package	{{ plugin_slug }}
 */
class class_name
{
    const BLOCK_CATEGORY_SLUG = 'class_slug';

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
     * @package	{{ plugin_slug }}
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
     * @package	{{ plugin_slug }}
     */
    public function init(): void
    {
        add_filter( 'block_categories', [ $this, 'add_custom_blocks_category' ], 10, 2 );
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
     * @package	{{ plugin_slug }}
     */
    public function add_custom_blocks_category( array $categories, \WP_Post $post ): array
    {
        $allowed_posts_types = [];
        
        if ( false === in_array( $post->post_type, $allowed_posts_types ) ) {
            return $categories;
        }

        return array_merge(
            $categories,
            [
                [
                    'slug' => self::BLOCK_CATEGORY_SLUG,
                    'title' => __( 'class_singular_upper_name', '{{ plugin_slug }}' ),
                    'icon'  => '',
                ],
            ]
        );
    }
}
