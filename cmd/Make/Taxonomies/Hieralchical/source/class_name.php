<?php
namespace PrefixSource\Taxonomies\class_name;

if ( false === defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * class_name
 *
 * This class provides an example to register a new taxonomy, with hierarchy, in WordPress.
 * For more information, visit the @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 *
 * @version	1.0
 * @since  	1.0
 * @package	{{ plugin_slug }}
 */
class class_name
{
    const TAXONOMY = 'class_slug';

    private string $rest_base   = 'class_slug';
    private string $query_var   = 'class_slug';
    private array $post_types   = [];
    private array $rewrite      = [ 
        'slug'          => '',
        'with_front'    => false,
        'hierarchical'  => true,
        'ep_mask'       => EP_NONE,
    ];

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
        add_action( 'init', [ $this, 'set_taxonomy_slug' ], 5 );
        add_action( 'init', [ $this, 'add_custom_taxonomy' ] );
        add_filter( 'taxonomy_template', [ $this, 'get_custom_taxonomy_template' ] );
    }

    /**
     * set_taxonomy_slug()
     *
     * This method is responsible for setting the taxonomy slug for each of the languages in which the plugin is translated.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	{{ plugin_slug }}
     */
    public function set_taxonomy_slug(): void
    {
        $this->rewrite['slug'] = __( 'class_slug', '{{ plugin_slug }}' );
    }

    /**
     * add_custom_taxonomy()
     *
     * This method takes care of registering the new taxonomy in WordPress.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	{{ plugin_slug }}
     */
    public function add_custom_taxonomy(): void
    {
        $args = [
            'label'  => __( 'class_plural_upper_name', '{{ plugin_slug }}' ),
            'labels' => [
                'name'                       => __( 'class_plural_upper_name', '{{ plugin_slug }}' ),
                'singular_name'              => __( 'class_singular_upper_name', '{{ plugin_slug }}' ),
                'menu_name'                  => __( 'class_plural_upper_name', '{{ plugin_slug }}' ),
                'all_items'                  => __( 'All class_plural_upper_name', '{{ plugin_slug }}' ),
                'edit_item'                  => __( 'Edit class_singular_upper_name', '{{ plugin_slug }}' ),
                'view_item'                  => __( 'View class_singular_upper_name', '{{ plugin_slug }}' ),
                'update_item'                => __( 'Update class_singular_upper_name', '{{ plugin_slug }}' ),
                'add_new_item'               => __( 'Add new class_singular_upper_name', '{{ plugin_slug }}' ),
                'new_item_name'              => __( 'New class_singular_upper_name Name', '{{ plugin_slug }}' ),
                'parent_item'                => __( 'Parent class_singular_upper_name', '{{ plugin_slug }}' ),
                'parent_item_colon'          => __( 'Parent class_singular_upper_name:', '{{ plugin_slug }}' ),
                'search_items'               => __( 'Search class_plural_upper_name', '{{ plugin_slug }}' ),
                'not_found'                  => __( 'class_plural_upper_name not Found', '{{ plugin_slug }}' ),
                'back_to_items'              => __( 'Back to class_plural_upper_name', '{{ plugin_slug }}' ),
            ],
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => true,
            'show_in_rest'          => true,
            'rest_base'             => $this->rest_base,
            'show_in_quick_edit'    => true,
            'show_admin_column'     => false,
            'description'           => __( 'class_singular_upper_name Description', '{{ plugin_slug }}' ),
            'hierarchical'          => true,
            'query_var'             => $this->query_var,
            'rewrite'               => $this->rewrite,
            'capabilities'          => [
                'manage_terms'  => 'manage_class_plural_lower_name',
                'edit_terms'    => 'edit_class_plural_lower_name',
                'delete_terms'  => 'delete_class_plural_lower_name',
                'assign_terms'  => 'assign_class_plural_lower_name',
            ],
        ];

        register_taxonomy( self::TAXONOMY, $this->post_types, $args );
    }

    /**
     * get_custom_taxonomy_template()
     *
     * This method is responsible for setting the template for the taxonomy archive, from the plugin itself.
     *
     * @param   string  $template Path to the template
     * @return 	string  New path to the template
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	{{ plugin_slug }}
     */
    public function get_custom_taxonomy_template( string $template ): string
    {
        if ( get_query_var( 'taxonomy' ) === self::TAXONOMY ) {
            $template = PREFIX_PLUGIN_DIR . 'src/Taxonomies/class_name/views/taxonomy-class_slug.php';
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
    public static function set_roles_capabilities(): void
    {
        global $wp_roles;

        $is_set_capabilities = get_option( '__prefix_set_class_singular_lower_name_capabilities' );

        if ( $is_set_capabilities ) {
            return;
        }
        
        foreach( $wp_roles->roles as $role => $args ) {
            $current_role = get_role( $role );

            if ( false === isset( $args['capabilities']['manage_categories'] ) || false === $args['capabilities']['manage_categories'] ) {
                continue;
            }

            $current_role->add_cap( 'manage_class_plural_lower_name' );
            $current_role->add_cap( 'edit_class_plural_lower_name' );
            $current_role->add_cap( 'delete_class_plural_lower_name' );
            $current_role->add_cap( 'assign_class_plural_lower_name' );
        }

        add_option( '__prefix_set_class_singular_lower_name_capabilities', true );
    }
}
