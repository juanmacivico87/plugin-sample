<?php
namespace PrefixSource\Taxonomies\CustomCategory;

if ( !defined( 'ABSPATH' ) )
    exit;

use PrefixSource\PostsTypes\SamplePostType\SamplePostType;

/**
 * CustomCategory
 *
 * This class provides an example to register a new taxonomy, with hierarchy, in WordPress.
 * For more information, visit the @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 *
 * @version	1.0
 * @since  	1.0
 * @package	plugin-sample
 */
class CustomCategory
{
    const TAXONOMY = 'custom_cat';

    private $rest_base  = 'custom_cat';
    private $query_var  = 'custom_cat';
    private $rewrite    = array( 
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
    public function init()
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
     * @package	plugin-sample
     */
    public function set_taxonomy_slug()
    {
        $this->rewrite['slug'] = __( 'custom-cat', 'plugin-sample' );
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
     * @package	plugin-sample
     */
    public function add_custom_taxonomy()
    {
        $args = array(
            'label'  => __( 'Custom Categories', 'plugin-sample' ),
            'labels' => array(
                'name'                       => __( 'Custom Categories', 'plugin-sample' ),
                'singular_name'              => __( 'Custom Category', 'plugin-sample' ),
                'menu_name'                  => __( 'Custom Categories', 'plugin-sample' ),
                'all_items'                  => __( 'All Custom Categories', 'plugin-sample' ),
                'edit_item'                  => __( 'Edit Custom Category', 'plugin-sample' ),
                'view_item'                  => __( 'View Custom Category', 'plugin-sample' ),
                'update_item'                => __( 'Update Custom Category', 'plugin-sample' ),
                'add_new_item'               => __( 'Add new Custom Category', 'plugin-sample' ),
                'new_item_name'              => __( 'New Custom Category Name', 'plugin-sample' ),
                'parent_item'                => __( 'Parent Custom Category', 'plugin-sample' ),
                'parent_item_colon'          => __( 'Parent Custom Category:', 'plugin-sample' ),
                'search_items'               => __( 'Search Custom Categories', 'plugin-sample' ),
                'not_found'                  => __( 'Custom Categories not Found', 'plugin-sample' ),
                'back_to_items'              => __( 'Back to Custom Categories', 'plugin-sample' ),
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
            'description'           => __( 'Custom Category Description', 'plugin-sample' ),
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

        register_taxonomy( self::TAXONOMY, SamplePostType::POST_TYPE_NAME, $args );
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
     * @package	plugin-sample
     */
    public function get_custom_taxonomy_template( $template )
    {
        if ( get_query_var( 'taxonomy' ) === self::TAXONOMY )
            $template = PREFIX_PLUGIN_DIR . 'src/Taxonomies/CustomCategory/views/taxonomy-category.php';

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
    public static function set_roles_capabilities()
    {
        global $wp_roles;

        $is_set_capabilities = get_option( '__prefix_set_custom_cat_capabilities' );

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

        add_option( '__prefix_set_custom_cat_capabilities', true );
    }
}
