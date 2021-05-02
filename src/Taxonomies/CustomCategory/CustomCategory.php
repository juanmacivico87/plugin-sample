<?php
namespace \Taxonomies\CustomCategory;

if ( false === defined( 'ABSPATH' ) )
    exit;

use \PostsTypes\CustomPostType\CustomPostType;

/**
 * CustomCategory
 *
 * This class provides an example to register a new taxonomy, with hierarchy, in WordPress.
 * For more information, visit the @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 *
 * @version	1.0
 * @since  	1.0
 * @package	
 */
class CustomCategory
{
    const TAXONOMY = 'custom_cat';

    private string $rest_base   = 'custom_cat';
    private string $query_var   = 'custom_cat';
    private array $rewrite      = array( 
        'slug'          => '',
        'with_front'    => false,
        'hierarchical'  => true,
        'ep_mask'       => EP_NONE,
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
     * @package	
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
     * @package	
     */
    public function init() : void
    {
        add_action( 'init', array( $this, 'set_taxonomy_slug' ), 5 );
        add_action( 'init', array( $this, 'add_custom_taxonomy' ) );
        add_filter( 'taxonomy_template', array( $this, 'get_custom_taxonomy_template' ) );
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
     * @package	
     */
    public function set_taxonomy_slug() : void
    {
        $this->rewrite['slug'] = __( 'custom-cat', '' );
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
     * @package	
     */
    public function add_custom_taxonomy() : void
    {
        $args = array(
            'label'  => __( 'Custom Categories', '' ),
            'labels' => array(
                'name'                       => __( 'Custom Categories', '' ),
                'singular_name'              => __( 'Custom Category', '' ),
                'menu_name'                  => __( 'Custom Categories', '' ),
                'all_items'                  => __( 'All Custom Categories', '' ),
                'edit_item'                  => __( 'Edit Custom Category', '' ),
                'view_item'                  => __( 'View Custom Category', '' ),
                'update_item'                => __( 'Update Custom Category', '' ),
                'add_new_item'               => __( 'Add new Custom Category', '' ),
                'new_item_name'              => __( 'New Custom Category Name', '' ),
                'parent_item'                => __( 'Parent Custom Category', '' ),
                'parent_item_colon'          => __( 'Parent Custom Category:', '' ),
                'search_items'               => __( 'Search Custom Categories', '' ),
                'not_found'                  => __( 'Custom Categories not Found', '' ),
                'back_to_items'              => __( 'Back to Custom Categories', '' ),
            ),
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => true,
            'show_in_rest'          => true,
            'rest_base'             => $this->rest_base,
            'show_in_quick_edit'    => true,
            'show_admin_column'     => false,
            'description'           => __( 'Custom Category Description', '' ),
            'hierarchical'          => true,
            'query_var'             => $this->query_var,
            'rewrite'               => $this->rewrite,
            'capabilities'          => array(
                'manage_terms'  => 'manage_custom_categories',
                'edit_terms'    => 'edit_custom_categories',
                'delete_terms'  => 'delete_custom_categories',
                'assign_terms'  => 'assign_custom_categories',
            ),
        );

        register_taxonomy( self::TAXONOMY, CustomPostType::POST_TYPE_NAME, $args );
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
     * @package	
     */
    public function get_custom_taxonomy_template( string $template ) : string
    {
        if ( get_query_var( 'taxonomy' ) === self::TAXONOMY )
            $template = PLUGIN_DIR . 'src/Taxonomies/CustomCategory/views/taxonomy-category.php';

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
     * @package	
     */
    public static function set_roles_capabilities() : void
    {
        global $wp_roles;

        $is_set_capabilities = get_option( '__set_custom_cat_capabilities' );

        if ( $is_set_capabilities )
            return;
        
        foreach( $wp_roles->roles as $role => $args ) {
            $current_role = get_role( $role );

            if ( false === isset( $args['capabilities']['manage_categories'] ) || false === $args['capabilities']['manage_categories'] )
                continue;

            $current_role->add_cap( 'manage_custom_categories' );
            $current_role->add_cap( 'edit_custom_categories' );
            $current_role->add_cap( 'delete_custom_categories' );
            $current_role->add_cap( 'assign_custom_categories' );
        }

        add_option( '__set_custom_cat_capabilities', true );
    }
}
