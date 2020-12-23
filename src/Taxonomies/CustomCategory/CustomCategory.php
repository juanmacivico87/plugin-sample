<?php
/**
 * A snippet to create a new custom category taxonomy for a post type in WordPress. For more info, view:
 *
 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 *
 * @package plugin-sample
 */

namespace PrefixSource\Taxonomies\CustomCategory;

if ( !defined( 'ABSPATH' ) )
    exit;

use PrefixSource\PostsTypes\SamplePostType\SamplePostType;

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

    public function __construct()
    {
        add_action( 'init', array( $this, 'set_taxonomy_slug' ), 5 );
        add_action( 'init', array( $this, 'add_custom_category' ) );
        add_filter( 'taxonomy_template', array( $this, 'get_custom_category_template' ) );
    }

    public function set_taxonomy_slug()
    {
        $this->rewrite['slug'] = __( 'custom-cat', 'plugin-sample' );
    }

    public function add_custom_category()
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

    public function get_custom_category_template( $template )
    {
        if ( get_query_var( 'taxonomy' ) === self::TAXONOMY )
            $template = PREFIX_PLUGIN_DIR . 'src/Taxonomies/CustomCategory/views/taxonomy-category.php';

        return $template;
    }

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
