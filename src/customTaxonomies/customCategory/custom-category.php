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
        add_action( 'init', array( $this, 'jmc87_add_custom_category' ) );
        add_filter( 'taxonomy_template', array( $this, 'jmc87_get_custom_category_template' ) );
    }

    public function jmc87_add_custom_category()
    {
        $args = array(
            'label'  => __( 'Custom Categories', 'jmc87_plugin_textdomain' ),
            'labels' => array(
                'name'                       => __( 'Custom Categories', 'jmc87_plugin_textdomain' ),
                'singular_name'              => __( 'Custom Category', 'jmc87_plugin_textdomain' ),
                'menu_name'                  => __( 'Custom Categories', 'jmc87_plugin_textdomain' ),
                'all_items'                  => __( 'All Custom Categories', 'jmc87_plugin_textdomain' ),
                'edit_item'                  => __( 'Edit Custom Category', 'jmc87_plugin_textdomain' ),
                'view_item'                  => __( 'View Custom Category', 'jmc87_plugin_textdomain' ),
                'update_item'                => __( 'Update Custom Category', 'jmc87_plugin_textdomain' ),
                'add_new_item'               => __( 'Add new Custom Category', 'jmc87_plugin_textdomain' ),
                'new_item_name'              => __( 'New Custom Category Name', 'jmc87_plugin_textdomain' ),
                'parent_item'                => __( 'Parent Custom Category', 'jmc87_plugin_textdomain' ),
                'parent_item_colon'          => __( 'Parent Custom Category:', 'jmc87_plugin_textdomain' ),
                'search_items'               => __( 'Search Custom Categories', 'jmc87_plugin_textdomain' ),
                'not_found'                  => __( 'Custom Categories not Found', 'jmc87_plugin_textdomain' ),
                'back_to_items'              => __( 'Back to Custom Categories', 'jmc87_plugin_textdomain' ),
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
            'description' => __( 'Custom Category Description', 'jmc87_plugin_textdomain' ),
            'hierarchical' => true,
            'query_var' => $this->query_var,
            'rewrite' => $this->rewrite
        );

        register_taxonomy( $this->taxonomy, $this->post_type, $args );
    }

    public function jmc87_get_custom_category_template( $template )
    {
        if ( get_query_var( 'taxonomy' ) === $this->taxonomy )
            $template = PLUGIN_DIR . 'src/customTaxonomies/customCategory/views/taxonomy-category.php';

        return $template;
    }
}
