<?php
/**
 * A snippet to create a new custom post type in WordPress. For more info, view:
 *
 * @link https://codex.wordpress.org/Function_Reference/register_post_type
 *
 * @package plugin-sample
 */

namespace PrefixSource\PostsTypes\SamplePostType;

if ( !defined( 'ABSPATH' ) )
    exit;

class SamplePostType
{
    public $post_type  = 'sample';

    public $support    = array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' );
    public $taxonomies = array( 'custom_cat', 'custom_tag' );
    public $rewrite    = array( 
        'slug'       => 'samples',
        'with_front' => false,
        'feeds'      => false,
        'pages'      => true,
    );

    public function __construct()
    {
        add_action( 'init', array( $this, 'add_custom_post_type' ) );
        add_filter( 'archive_template', array( $this, 'get_post_type_templates' ) );
        add_filter( 'single_template', array( $this, 'get_post_type_templates' ) );
    }

    public function add_custom_post_type()
    {
        $args = array(
            'labels' => array(
                'name'                     => __( 'Samples', 'plugin-sample' ),
                'singular_name'            => __( 'Sample', 'plugin-sample' ),
                'add_new'                  => __( 'Add New', 'plugin-sample' ),
                'add_new_item'             => __( 'Add New Sample', 'plugin-sample' ),
                'edit_item'                => __( 'Edit Sample', 'plugin-sample' ),
                'new_item'                 => __( 'New Sample', 'plugin-sample' ),
                'view_item'                => __( 'View Sample', 'plugin-sample' ),
                'view_items'               => __( 'View Samples', 'plugin-sample' ),
                'search_items'             => __( 'Search Samples', 'plugin-sample' ),
                'not_found'                => __( 'Sample not Found', 'plugin-sample' ),
                'not_found_in_trash'       => __( 'Sample not Found in Trash', 'plugin-sample' ),
                'parent_item_colon'        => __( 'Parent Sample:', 'plugin-sample' ),
                'all_items'                => __( 'All Samples', 'plugin-sample' ),
                'archives'                 => __( 'Sample Archives', 'plugin-sample' ),
                'attributes'               => __( 'Sample Attributes', 'plugin-sample' ),
                'insert_into_item'         => __( 'Insert into Sample', 'plugin-sample' ),
                'uploaded_to_this_item'    => __( 'Uploaded to this Sample', 'plugin-sample' ),
                'featured_image'           => __( 'Featured Image', 'plugin-sample' ),
                'set_featured_image'       => __( 'Set Featured Image', 'plugin-sample' ),
                'remove_featured_image'    => __( 'Remove Featured Image', 'plugin-sample' ),
                'use_featured_image'       => __( 'Use Featured Image', 'plugin-sample' ),
                'menu_name'                => __( 'Samples', 'plugin-sample' ),
                'filter_items_list'        => __( 'Filter Samples List', 'plugin-sample' ),
                'items_list_navigation'    => __( 'Samples List Navigation', 'plugin-sample' ),
                'items_list'               => __( 'Samples List', 'plugin-sample' ),
                'name_admin_bar'           => __( 'Samples', 'plugin-sample' ),
                'item_published'           => __( 'Sample Published', 'plugin-sample' ),
                'item_published_privately' => __( 'Sample Published Privately', 'plugin-sample' ),
                'item_reverted_to_draft'   => __( 'Sample Reverte to Draft', 'plugin-sample' ),
                'item_scheduled'           => __( 'Sample Scheduled', 'plugin-sample' ),
                'item_updated'             => __( 'Sample Updated', 'plugin-sample' ),
            ),
            'public'              => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_nav_menus'   => true,
            'show_in_menu'        => true,
            'menu_position'       => 20,
            'menu_icon'           => 'dashicons-wordpress',
            'hierarchical'        => false,
            'supports'            => $this->support,
            'taxonomies'          => $this->taxonomies,
            'has_archive'         => true,
            'rewrite'             => $this->rewrite,
            'query_var'           => true,
            'can_export'          => true,
            'delete_with_user'    => false,
            'show_in_rest'        => true,
        );

        register_post_type( $this->post_type, $args );
        flush_rewrite_rules();
    }

    public function get_post_type_templates( $template )
    {
        if ( get_post_type() === $this->post_type )
        { 
            switch( true ) 
            {
                case is_archive() && !is_tax():
                    $template = PREFIX_PLUGIN_DIR . 'src/PostsTypes/SamplePostType/views/archive-sample.php';
                    break;
                case is_single():
                    $template = PREFIX_PLUGIN_DIR . 'src/PostsTypes/SamplePostType/views/single-sample.php';
                    break;
            }
        }

        return $template;
    }
}
