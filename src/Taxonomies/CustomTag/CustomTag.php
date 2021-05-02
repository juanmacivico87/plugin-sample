<?php
namespace PrefixSource\Taxonomies\CustomTag;

use PrefixSource\PostsTypes\CustomPostType\CustomPostType;

if ( false === defined( 'ABSPATH' ) )
    exit;

/**
 * CustomTag
 *
 * This class provides an example to register a new taxonomy, without hierarchy, in WordPress.
 * For more information, visit the @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 *
 * @version	1.0
 * @since  	1.0
 * @package	{{ plugin_slug }}
 */
class CustomTag
{
    const TAXONOMY = 'custom_tag';

    private string $rest_base   = 'custom_tag';
    private string $query_var   = 'custom_tag';
    private array $rewrite      = array( 
        'slug'          => '',
        'with_front'    => false,
        'hierarchical'  => false,
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
     * @package	{{ plugin_slug }}
     */
    public function set_taxonomy_slug() : void
    {
        $this->rewrite['slug'] = __( 'custom-tag', '{{ plugin_slug }}' );
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
    public function add_custom_taxonomy() : void
    {
        $args = array(
            'label'  => __( 'Custom Tags', '{{ plugin_slug }}' ),
            'labels' => array(
                'name'                       => __( 'Custom Tags', '{{ plugin_slug }}' ),
                'singular_name'              => __( 'Custom Tag', '{{ plugin_slug }}' ),
                'menu_name'                  => __( 'Custom Tags', '{{ plugin_slug }}' ),
                'all_items'                  => __( 'All Custom Tags', '{{ plugin_slug }}' ),
                'edit_item'                  => __( 'Edit Custom Tag', '{{ plugin_slug }}' ),
                'view_item'                  => __( 'View Custom Tag', '{{ plugin_slug }}' ),
                'update_item'                => __( 'Update Custom Tag', '{{ plugin_slug }}' ),
                'add_new_item'               => __( 'Add new Custom Tag', '{{ plugin_slug }}' ),
                'new_item_name'              => __( 'New Custom Tag Name', '{{ plugin_slug }}' ),
                'search_items'               => __( 'Search Custom Tags', '{{ plugin_slug }}' ),
                'popular_items'              => __( 'Popular Custom Tags', '{{ plugin_slug }}' ),
                'separate_items_with_commas' => __( 'Separate Custom Tags with Commas', '{{ plugin_slug }}' ),
                'add_or_remove_items'        => __( 'Add or remove Custom Tags', '{{ plugin_slug }}' ),
                'choose_from_most_used'      => __( 'Choose from most used Custom Tags', '{{ plugin_slug }}' ),
                'not_found'                  => __( 'Custom Tags not Found', '{{ plugin_slug }}' ),
                'back_to_items'              => __( 'Back to Custom Tags', '{{ plugin_slug }}' ),
            ),
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => true,
            'show_in_rest'          => true,
            'rest_base'             => $this->rest_base,
            'show_tagcloud'         => true,
            'show_in_quick_edit'    => true,
            'show_admin_column'     => false,
            'description'           => __( 'Custom Tag Description', '{{ plugin_slug }}' ),
            'hierarchical'          => false,
            'query_var'             => $this->query_var,
            'rewrite'               => $this->rewrite,
            'capabilities' => array(
                'manage_terms'  => 'manage_custom_tags',
                'edit_terms'    => 'edit_custom_tags',
                'delete_terms'  => 'delete_custom_tags',
                'assign_terms'  => 'assign_custom_tags',
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
     * @package	{{ plugin_slug }}
     */
    public function get_custom_taxonomy_template( string $template ) : string
    {
        if ( get_query_var( 'taxonomy' ) === self::TAXONOMY )
            $template = PREFIX_PLUGIN_DIR . 'src/Taxonomies/CustomTag/views/taxonomy-tag.php';

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

        $is_set_capabilities = get_option( '__prefix_set_custom_tag_capabilities' );

        if ( $is_set_capabilities )
            return;
        
        foreach( $wp_roles->roles as $role => $args ) {
            $current_role = get_role( $role );

            if ( false === isset( $args['capabilities']['manage_categories'] ) || false === $args['capabilities']['manage_categories'] )
                continue;

            $current_role->add_cap( 'manage_custom_tags' );
            $current_role->add_cap( 'edit_custom_tags' );
            $current_role->add_cap( 'delete_custom_tags' );
            $current_role->add_cap( 'assign_custom_tags' );
        }

        add_option( '__prefix_set_custom_tag_capabilities', true );
    }
}
