<?php
namespace PrefixSource\PostsTypes\class_name;

if ( false === defined( 'ABSPATH' ) )
    exit;

/**
 * class_name
 *
 * This class provides an example to create a new custom post type in WordPress.
 * For more information, visit the @link https://codex.wordpress.org/Function_Reference/register_post_type
 *
 * @version	1.0
 * @since  	1.0
 * @package	{{ plugin_slug }}
 */
class class_name
{
    const POST_TYPE_NAME    = 'class_singular_lower_name';
    const POST_TYPE_PLURAL  = 'class_plural_lower_name';

    private array $support    = array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' );
    private array $taxonomies = array();
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
     * @package	{{ plugin_slug }}
     */
    public function set_custom_post_type_slug() : void
    {
        $this->rewrite['slug'] = __( 'class_slug', '{{ plugin_slug }}' );
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
     * @package	{{ plugin_slug }}
     */
    public function add_custom_post_type() : void
    {
        $args = array(
            'labels' => array(
                'name'                     => __( 'class_plural_upper_name', '{{ plugin_slug }}' ),
                'singular_name'            => __( 'class_singular_upper_name', '{{ plugin_slug }}' ),
                'add_new'                  => __( 'Add New', '{{ plugin_slug }}' ),
                'add_new_item'             => __( 'Add New class_singular_upper_name', '{{ plugin_slug }}' ),
                'edit_item'                => __( 'Edit class_singular_upper_name', '{{ plugin_slug }}' ),
                'new_item'                 => __( 'New class_singular_upper_name', '{{ plugin_slug }}' ),
                'view_item'                => __( 'View class_singular_upper_name', '{{ plugin_slug }}' ),
                'view_items'               => __( 'View class_plural_upper_name', '{{ plugin_slug }}' ),
                'search_items'             => __( 'Search class_plural_upper_name', '{{ plugin_slug }}' ),
                'not_found'                => __( 'class_singular_upper_name not Found', '{{ plugin_slug }}' ),
                'not_found_in_trash'       => __( 'class_singular_upper_name not Found in Trash', '{{ plugin_slug }}' ),
                'parent_item_colon'        => __( 'Parent class_singular_upper_name:', '{{ plugin_slug }}' ),
                'all_items'                => __( 'All class_plural_upper_name', '{{ plugin_slug }}' ),
                'archives'                 => __( 'class_singular_upper_name Archives', '{{ plugin_slug }}' ),
                'attributes'               => __( 'class_singular_upper_name Attributes', '{{ plugin_slug }}' ),
                'insert_into_item'         => __( 'Insert into class_singular_upper_name', '{{ plugin_slug }}' ),
                'uploaded_to_this_item'    => __( 'Uploaded to this class_singular_upper_name', '{{ plugin_slug }}' ),
                'featured_image'           => __( 'Featured Image', '{{ plugin_slug }}' ),
                'set_featured_image'       => __( 'Set Featured Image', '{{ plugin_slug }}' ),
                'remove_featured_image'    => __( 'Remove Featured Image', '{{ plugin_slug }}' ),
                'use_featured_image'       => __( 'Use Featured Image', '{{ plugin_slug }}' ),
                'menu_name'                => __( 'class_plural_upper_name', '{{ plugin_slug }}' ),
                'filter_items_list'        => __( 'Filter class_plural_upper_name List', '{{ plugin_slug }}' ),
                'items_list_navigation'    => __( 'class_plural_upper_name List Navigation', '{{ plugin_slug }}' ),
                'items_list'               => __( 'class_plural_upper_name List', '{{ plugin_slug }}' ),
                'name_admin_bar'           => __( 'class_plural_upper_name', '{{ plugin_slug }}' ),
                'item_published'           => __( 'class_singular_upper_name Published', '{{ plugin_slug }}' ),
                'item_published_privately' => __( 'class_singular_upper_name Published Privately', '{{ plugin_slug }}' ),
                'item_reverted_to_draft'   => __( 'class_singular_upper_name Reverte to Draft', '{{ plugin_slug }}' ),
                'item_scheduled'           => __( 'class_singular_upper_name Scheduled', '{{ plugin_slug }}' ),
                'item_updated'             => __( 'class_singular_upper_name Updated', '{{ plugin_slug }}' ),
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
                'edit_class_singular_lower_name'              => 'edit_class_singular_lower_name', 
                'read_class_singular_lower_name'              => 'read_class_singular_lower_name', 
                'delete_class_singular_lower_name'            => 'delete_class_singular_lower_name', 
                'edit_class_plural_lower_name'             => 'edit_class_plural_lower_name', 
                'edit_others_class_plural_lower_name'      => 'edit_others_class_plural_lower_name',
                'delete_class_plural_lower_name'           => 'delete_class_plural_lower_name', 
                'publish_class_plural_lower_name'          => 'publish_class_plural_lower_name',       
                'read_private_class_plural_lower_name'     => 'read_private_class_plural_lower_name',
                'read'                     => 'read',
                'delete_private_class_plural_lower_name'   => 'delete_private_class_plural_lower_name',
                'delete_published_class_plural_lower_name' => 'delete_published_class_plural_lower_name',
                'delete_others_class_plural_lower_name'    => 'delete_others_class_plural_lower_name',
                'edit_private_class_plural_lower_name'     => 'edit_private_class_plural_lower_name',
                'edit_published_class_plural_lower_name'   => 'edit_published_class_plural_lower_name',
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
     * @package	{{ plugin_slug }}
     */
    public function get_post_type_templates( string $template ) : string
    {
        if ( get_post_type() !== self::POST_TYPE_NAME )
            return $template;

        switch( true ) {
            case is_archive() && !is_tax():
                $template = PREFIX_PLUGIN_DIR . 'src/PostsTypes/class_name/views/archive-class_slug.php';
                break;
            case is_single():
                $template = PREFIX_PLUGIN_DIR . 'src/PostsTypes/class_name/views/single-class_slug.php';
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
     * @package	{{ plugin_slug }}
     */
    public static function set_roles_capabilities() : void
    {
        global $wp_roles;

        $is_set_capabilities = get_option( '__prefix_set_class_singular_lower_name_capabilities' );

        if ( $is_set_capabilities )
            return;

        $map_meta_cap = array(
            'edit_post'              => 'edit_class_singular_lower_name', 
            'read_post'              => 'read_class_singular_lower_name', 
            'delete_post'            => 'delete_class_singular_lower_name', 
            'edit_posts'             => 'edit_class_plural_lower_name', 
            'edit_others_posts'      => 'edit_others_class_plural_lower_name',
            'delete_posts'           => 'delete_class_plural_lower_name', 
            'publish_posts'          => 'publish_class_plural_lower_name',       
            'read_private_posts'     => 'read_private_class_plural_lower_name',
            'delete_private_posts'   => 'delete_private_class_plural_lower_name',
            'delete_published_posts' => 'delete_published_class_plural_lower_name',
            'delete_others_posts'    => 'delete_others_class_plural_lower_name',
            'edit_private_posts'     => 'edit_private_class_plural_lower_name',
            'edit_published_posts'   => 'edit_published_class_plural_lower_name',
        );
        
        foreach( $wp_roles->roles as $role => $args ) {
            $current_role = get_role( $role );

            foreach( $map_meta_cap as $post_cap => $capability ) {
                if ( isset( $args['capabilities'][$post_cap] ) && false !== $args['capabilities'][$post_cap] )
                    $current_role->add_cap( $capability );
            }
        }

        add_option( '__prefix_set_class_singular_lower_name_capabilities', true );
    }
}
