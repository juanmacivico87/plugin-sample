<?php
/**
 * A snippet to create a new custom tag taxonomy for a post type in WordPress. For more info, view:
 *
 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 *
 * @package plugin-sample
 */

namespace PrefixSource\Taxonomies\CustomTag;

use PrefixSource\PostsTypes\SamplePostType\SamplePostType;

if ( !defined( 'ABSPATH' ) )
    exit;

class CustomTag
{
    const TAXONOMY = 'custom_tag';

    private $rest_base  = 'custom_tag';
    private $query_var  = 'custom_tag';
    private $rewrite    = array( 
        'slug'          => '',
        'with_front'    => false,
        'hierarchical'  => false,
        'ep_mask'       => EP_NONE,
    );

    public function __construct()
    {
        add_action( 'init', array( $this, 'set_taxonomy_slug' ), 5 );
        add_action( 'init', array( $this, 'add_custom_tag' ) );
        add_filter( 'taxonomy_template', array( $this, 'get_custom_tag_template' ) );
    }

    public function set_taxonomy_slug()
    {
        $this->rewrite['slug'] = __( 'custom-tag', 'plugin-sample' );
    }

    public function add_custom_tag()
    {
        $args = array(
            'label'  => __( 'Custom Tags', 'plugin-sample' ),
            'labels' => array(
                'name'                       => __( 'Custom Tags', 'plugin-sample' ),
                'singular_name'              => __( 'Custom Tag', 'plugin-sample' ),
                'menu_name'                  => __( 'Custom Tags', 'plugin-sample' ),
                'all_items'                  => __( 'All Custom Tags', 'plugin-sample' ),
                'edit_item'                  => __( 'Edit Custom Tag', 'plugin-sample' ),
                'view_item'                  => __( 'View Custom Tag', 'plugin-sample' ),
                'update_item'                => __( 'Update Custom Tag', 'plugin-sample' ),
                'add_new_item'               => __( 'Add new Custom Tag', 'plugin-sample' ),
                'new_item_name'              => __( 'New Custom Tag Name', 'plugin-sample' ),
                'search_items'               => __( 'Search Custom Tags', 'plugin-sample' ),
                'popular_items'              => __( 'Popular Custom Tags', 'plugin-sample' ),
                'separate_items_with_commas' => __( 'Separate Custom Tags with Commas', 'plugin-sample' ),
                'add_or_remove_items'        => __( 'Add or remove Custom Tags', 'plugin-sample' ),
                'choose_from_most_used'      => __( 'Choose from most used Custom Tags', 'plugin-sample' ),
                'not_found'                  => __( 'Custom Tags not Found', 'plugin-sample' ),
                'back_to_items'              => __( 'Back to Custom Tags', 'plugin-sample' ),
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
            'description'           => __( 'Custom Tag Description', 'plugin-sample' ),
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

        register_taxonomy( self::TAXONOMY, SamplePostType::POST_TYPE_NAME, $args );
    }

    public function get_custom_tag_template( $template )
    {
        if ( get_query_var( 'taxonomy' ) === self::TAXONOMY )
            $template = PREFIX_PLUGIN_DIR . 'src/Taxonomies/CustomTag/views/taxonomy-tag.php';

        return $template;
    }

    public static function set_roles_capabilities()
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
