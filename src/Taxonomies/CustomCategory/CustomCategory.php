<?php
/**
 * A snippet to create a new custom category taxonomy for a post type in WordPress. For more info, view:
 *
 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 *
 * @package jmc87_plugin
 */

class JMC87_CustomCategory
{
    public $taxonomy   = 'custom_cat';
    public $post_type  = 'sample';

    public $rest_base  = 'custom_cat';
    public $query_var  = 'custom_cat';
    public $rewrite    = array( 
        'slug'          => 'custom-cat',
        'with_front'    => false,
        'hierarchical'  => true,
        'ep_mask'       => EP_NONE,
    );

    public function __construct()
    {
        add_action( 'init', array( $this, 'add_custom_category' ) );
        add_filter( 'taxonomy_template', array( $this, 'get_custom_category_template' ) );
    }

    public function add_custom_category()
    {
        $args = array(
            'label'  => __( 'Custom Categories', 'plugin-textdomain' ),
            'labels' => array(
                'name'                       => __( 'Custom Categories', 'plugin-textdomain' ),
                'singular_name'              => __( 'Custom Category', 'plugin-textdomain' ),
                'menu_name'                  => __( 'Custom Categories', 'plugin-textdomain' ),
                'all_items'                  => __( 'All Custom Categories', 'plugin-textdomain' ),
                'edit_item'                  => __( 'Edit Custom Category', 'plugin-textdomain' ),
                'view_item'                  => __( 'View Custom Category', 'plugin-textdomain' ),
                'update_item'                => __( 'Update Custom Category', 'plugin-textdomain' ),
                'add_new_item'               => __( 'Add new Custom Category', 'plugin-textdomain' ),
                'new_item_name'              => __( 'New Custom Category Name', 'plugin-textdomain' ),
                'parent_item'                => __( 'Parent Custom Category', 'plugin-textdomain' ),
                'parent_item_colon'          => __( 'Parent Custom Category:', 'plugin-textdomain' ),
                'search_items'               => __( 'Search Custom Categories', 'plugin-textdomain' ),
                'not_found'                  => __( 'Custom Categories not Found', 'plugin-textdomain' ),
                'back_to_items'              => __( 'Back to Custom Categories', 'plugin-textdomain' ),
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_rest' => true,
            'rest_base' => $this->rest_base,
            'show_in_quick_edit' => true,
            'show_admin_column' => false,
            'description' => __( 'Custom Category Description', 'plugin-textdomain' ),
            'hierarchical' => true,
            'query_var' => $this->query_var,
            'rewrite' => $this->rewrite
        );

        register_taxonomy( $this->taxonomy, $this->post_type, $args );
    }

    public function get_custom_category_template( $template )
    {
        if ( get_query_var( 'taxonomy' ) === $this->taxonomy )
            $template = PLUGIN_DIR . 'src/Taxonomies/CustomCategory/views/taxonomy-category.php';

        return $template;
    }
}
