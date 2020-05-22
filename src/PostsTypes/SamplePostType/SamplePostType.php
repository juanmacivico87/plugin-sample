<?php
/**
 * A snippet to create a new custom post type in WordPress. For more info, view:
 *
 * @link https://codex.wordpress.org/Function_Reference/register_post_type
 *
 * @package jmc87_plugin
 */

class JMC87_SamplePostType
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
                'name'                     => __( 'Samples', 'plugin-textdomain' ),
                'singular_name'            => __( 'Sample', 'plugin-textdomain' ),
                'add_new'                  => __( 'Add New', 'plugin-textdomain' ),
                'add_new_item'             => __( 'Add New Sample', 'plugin-textdomain' ),
                'edit_item'                => __( 'Edit Sample', 'plugin-textdomain' ),
                'new_item'                 => __( 'New Sample', 'plugin-textdomain' ),
                'view_item'                => __( 'View Sample', 'plugin-textdomain' ),
                'view_items'               => __( 'View Samples', 'plugin-textdomain' ),
                'search_items'             => __( 'Search Samples', 'plugin-textdomain' ),
                'not_found'                => __( 'Sample not Found', 'plugin-textdomain' ),
                'not_found_in_trash'       => __( 'Sample not Found in Trash', 'plugin-textdomain' ),
                'parent_item_colon'        => __( 'Parent Sample:', 'plugin-textdomain' ),
                'all_items'                => __( 'All Samples', 'plugin-textdomain' ),
                'archives'                 => __( 'Sample Archives', 'plugin-textdomain' ),
                'attributes'               => __( 'Sample Attributes', 'plugin-textdomain' ),
                'insert_into_item'         => __( 'Insert into Sample', 'plugin-textdomain' ),
                'uploaded_to_this_item'    => __( 'Uploaded to this Sample', 'plugin-textdomain' ),
                'featured_image'           => __( 'Featured Image', 'plugin-textdomain' ),
                'set_featured_image'       => __( 'Set Featured Image', 'plugin-textdomain' ),
                'remove_featured_image'    => __( 'Remove Featured Image', 'plugin-textdomain' ),
                'use_featured_image'       => __( 'Use Featured Image', 'plugin-textdomain' ),
                'menu_name'                => __( 'Samples', 'plugin-textdomain' ),
                'filter_items_list'        => __( 'Filter Samples List', 'plugin-textdomain' ),
                'items_list_navigation'    => __( 'Samples List Navigation', 'plugin-textdomain' ),
                'items_list'               => __( 'Samples List', 'plugin-textdomain' ),
                'name_admin_bar'           => __( 'Samples', 'plugin-textdomain' ),
                'item_published'           => __( 'Sample Published', 'plugin-textdomain' ),
                'item_published_privately' => __( 'Sample Published Privately', 'plugin-textdomain' ),
                'item_reverted_to_draft'   => __( 'Sample Reverte to Draft', 'plugin-textdomain' ),
                'item_scheduled'           => __( 'Sample Scheduled', 'plugin-textdomain' ),
                'item_updated'             => __( 'Sample Updated', 'plugin-textdomain' ),
            ),
            'public'              => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_nav_menus'   => true,
            'show_in_menu'        => true,
            'menu_position'       => 20,
            'menu_icon'           => 'dashicons-wordpress',
            'hierarchical'        => true,
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
                    $template = PLUGIN_DIR . 'src/PostsTypes/SamplePostType/views/archive-sample.php';
                    break;
                case is_single():
                    $template = PLUGIN_DIR . 'src/PostsTypes/SamplePostType/views/single-sample.php';
                    break;
            }
        }

        return $template;
    }
}
