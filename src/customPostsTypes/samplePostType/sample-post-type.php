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
        add_action( 'init', array( $this, 'jmc87_add_custom_post_type' ) );
        add_filter( 'archive_template', array( $this, 'jmc87_get_post_type_templates' ) );
        add_filter( 'single_template', array( $this, 'jmc87_get_post_type_templates' ) );
    }

    public function jmc87_add_custom_post_type()
    {
        $args = array(
            'labels' => array(
                'name'                     => __( 'Samples', 'jmc87_plugin_textdomain' ),
                'singular_name'            => __( 'Sample', 'jmc87_plugin_textdomain' ),
                'add_new'                  => __( 'Add New', 'jmc87_plugin_textdomain' ),
                'add_new_item'             => __( 'Add New Sample', 'jmc87_plugin_textdomain' ),
                'edit_item'                => __( 'Edit Sample', 'jmc87_plugin_textdomain' ),
                'new_item'                 => __( 'New Sample', 'jmc87_plugin_textdomain' ),
                'view_item'                => __( 'View Sample', 'jmc87_plugin_textdomain' ),
                'view_items'               => __( 'View Samples', 'jmc87_plugin_textdomain' ),
                'search_items'             => __( 'Search Samples', 'jmc87_plugin_textdomain' ),
                'not_found'                => __( 'Sample not Found', 'jmc87_plugin_textdomain' ),
                'not_found_in_trash'       => __( 'Sample not Found in Trash', 'jmc87_plugin_textdomain' ),
                'parent_item_colon'        => __( 'Parent Sample:', 'jmc87_plugin_textdomain' ),
                'all_items'                => __( 'All Samples', 'jmc87_plugin_textdomain' ),
                'archives'                 => __( 'Sample Archives', 'jmc87_plugin_textdomain' ),
                'attributes'               => __( 'Sample Attributes', 'jmc87_plugin_textdomain' ),
                'insert_into_item'         => __( 'Insert into Sample', 'jmc87_plugin_textdomain' ),
                'uploaded_to_this_item'    => __( 'Uploaded to this Sample', 'jmc87_plugin_textdomain' ),
                'featured_image'           => __( 'Featured Image', 'jmc87_plugin_textdomain' ),
                'set_featured_image'       => __( 'Set Featured Image', 'jmc87_plugin_textdomain' ),
                'remove_featured_image'    => __( 'Remove Featured Image', 'jmc87_plugin_textdomain' ),
                'use_featured_image'       => __( 'Use Featured Image', 'jmc87_plugin_textdomain' ),
                'menu_name'                => __( 'Samples', 'jmc87_plugin_textdomain' ),
                'filter_items_list'        => __( 'Filter Samples List', 'jmc87_plugin_textdomain' ),
                'items_list_navigation'    => __( 'Samples List Navigation', 'jmc87_plugin_textdomain' ),
                'items_list'               => __( 'Samples List', 'jmc87_plugin_textdomain' ),
                'name_admin_bar'           => __( 'Samples', 'jmc87_plugin_textdomain' ),
                'item_published'           => __( 'Sample Published', 'jmc87_plugin_textdomain' ),
                'item_published_privately' => __( 'Sample Published Privately', 'jmc87_plugin_textdomain' ),
                'item_reverted_to_draft'   => __( 'Sample Reverte to Draft', 'jmc87_plugin_textdomain' ),
                'item_scheduled'           => __( 'Sample Scheduled', 'jmc87_plugin_textdomain' ),
                'item_updated'             => __( 'Sample Updated', 'jmc87_plugin_textdomain' ),
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

    public function jmc87_get_post_type_templates( $template )
    {
        if ( get_post_type() === $this->post_type )
        { 
            switch( true ) 
            {
                case is_archive() && !is_tax():
                    $template = PLUGIN_DIR . 'src/customPostsTypes/samplePostType/views/archive-sample.php';
                    break;
                case is_single():
                    $template = PLUGIN_DIR . 'src/customPostsTypes/samplePostType/views/single-sample.php';
                    break;
            }
        }

        return $template;
    }
}
