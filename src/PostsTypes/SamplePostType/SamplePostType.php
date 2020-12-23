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

use PrefixSource\Taxonomies\CustomCategory\CustomCategory;

class SamplePostType
{
    const POST_TYPE_NAME    = 'sample';
    const POST_TYPE_PLURAL  = 'samples';

    private $support    = array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' );
    private $taxonomies = array( CustomCategory::TAXONOMY, 'custom_tag' );
    private $rewrite    = array( 
        'slug'       => '',
        'with_front' => false,
        'feeds'      => false,
        'pages'      => true,
    );

    public function __construct()
    {
        add_action( 'init', array( $this, 'set_custom_post_type_slug' ), 5 );
        add_action( 'init', array( $this, 'add_custom_post_type' ) );
        add_filter( 'archive_template', array( $this, 'get_post_type_templates' ) );
        add_filter( 'single_template', array( $this, 'get_post_type_templates' ) );
    }

    public function set_custom_post_type_slug()
    {
        $this->rewrite['slug'] = __( 'samples', 'plugin-sample' );
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
            'map_meta_cap'        => true,
            'capability_type'     => array( self::POST_TYPE_NAME, self::POST_TYPE_PLURAL ),
            'capabilities'        => array(
                'edit_sample'              => 'edit_sample', 
                'read_sample'              => 'read_sample', 
                'delete_sample'            => 'delete_sample', 
                'edit_samples'             => 'edit_samples', 
                'edit_others_samples'      => 'edit_others_samples',
                'delete_samples'           => 'delete_samples', 
                'publish_samples'          => 'publish_samples',       
                'read_private_samples'     => 'read_private_samples',
                'read'                     => 'read',
                'delete_private_samples'   => 'delete_private_samples',
                'delete_published_samples' => 'delete_published_samples',
                'delete_others_samples'    => 'delete_others_samples',
                'edit_private_samples'     => 'edit_private_samples',
                'edit_published_samples'   => 'edit_published_samples',
            ),
        );

        register_post_type( self::POST_TYPE_NAME, $args );
        flush_rewrite_rules();
    }

    public function get_post_type_templates( $template )
    {
        if ( get_post_type() === self::POST_TYPE_NAME )
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

    public static function set_roles_capabilities()
    {
        global $wp_roles;

        $is_set_capabilities = get_option( '__prefix_set_sample_capabilities' );

        if ( $is_set_capabilities )
            return;

        $map_meta_cap = array(
            'edit_post'              => 'edit_sample', 
            'read_post'              => 'read_sample', 
            'delete_post'            => 'delete_sample', 
            'edit_posts'             => 'edit_samples', 
            'edit_others_posts'      => 'edit_others_samples',
            'delete_posts'           => 'delete_samples', 
            'publish_posts'          => 'publish_samples',       
            'read_private_posts'     => 'read_private_samples',
            'delete_private_posts'   => 'delete_private_samples',
            'delete_published_posts' => 'delete_published_samples',
            'delete_others_posts'    => 'delete_others_samples',
            'edit_private_posts'     => 'edit_private_samples',
            'edit_published_posts'   => 'edit_published_samples',
        );
        
        foreach( $wp_roles->roles as $role => $args ) {
            $current_role = get_role( $role );

            foreach( $map_meta_cap as $post_cap => $capability ) {
                if ( isset( $args['capabilities'][$post_cap] ) && false !== $args['capabilities'][$post_cap] )
                    $current_role->add_cap( $capability );
            }
        }

        add_option( '__prefix_set_sample_capabilities', true );
    }
}
