<?php
/**
 * Load custom posts types.
 *
 * @package plugin-sample
 */

if ( !defined( 'ABSPATH' ) )
    exit;

class PostsTypes
{
    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'load_custom_posts_types' ) );
    }

    public function load_custom_posts_types()
    {
        require 'SamplePostType/SamplePostType.php';
        $custom_post_type = new SamplePostType();
    }
}
