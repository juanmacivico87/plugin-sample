<?php
namespace PrefixSource\PostsTypes\CustomPostType;

if ( false === defined( 'ABSPATH' ) )
    exit;

use PrefixSource\Taxonomies\CustomCategory\CustomCategory;
use PrefixSource\Taxonomies\CustomTag\CustomTag;

/**
 * CustomPostType
 *
 * This class provides an example to create a new custom post type in WordPress.
 * For more information, visit the @link https://codex.wordpress.org/Function_Reference/register_post_type
 *
 * @version	1.0
 * @since  	1.0
 * @package	plugin-sample
 */
class CustomPostType
{
    const POST_TYPE_NAME    = 'sample';
    const POST_TYPE_PLURAL  = 'samples';

    private array $support    = array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' );
    private array $taxonomies = array( CustomCategory::TAXONOMY, CustomTag::TAXONOMY );
    private array $rewrite    = array( 
        'slug'       => '',
        'with_front' => false,
        'feeds'      => false,
        'pages'      => true,
    );

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
        add_action( 'init', array( $this, 'set_custom_post_type_slug' ), 5 );
        add_action( 'init', array( $this, 'add_custom_post_type' ) );
        add_filter( 'archive_template', array( $this, 'get_post_type_templates' ) );
        add_filter( 'single_template', array( $this, 'get_post_type_templates' ) );
    }

    /**
     * set_custom_post_type_slug()
     *
     * This method is responsible for setting the Custom Post Type slug for each of the languages in which the plugin is translated.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function set_custom_post_type_slug() : void
    {
        $this->rewrite['slug'] = __( 'samples', 'plugin-sample' );
    }

    /**
     * add_custom_post_type()
     *
     * This method takes care of registering the new Custom Post Type in WordPress.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function add_custom_post_type() : void
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

    /**
     * get_post_type_templates()
     *
     * This method is responsible for setting the templates for the Custom Post Type archive and single, from the plugin itself.
     *
     * @param   string  $template Path to the template
     * @return 	string  New path to the template
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function get_post_type_templates( string $template ) : string
    {
        if ( get_post_type() !== self::POST_TYPE_NAME )
            return $template;

        switch( true ) {
            case is_archive() && !is_tax():
                $template = PREFIX_PLUGIN_DIR . 'src/PostsTypes/CustomPostType/views/archive-sample.php';
                break;
            case is_single():
                $template = PREFIX_PLUGIN_DIR . 'src/PostsTypes/CustomPostType/views/single-sample.php';
                break;
        }

        return $template;
    }

    /**
     * set_roles_capabilities()
     *
     * This method takes care of assigning the different capabilities to each of the roles that have been defined on the web.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public static function set_roles_capabilities() : void
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
