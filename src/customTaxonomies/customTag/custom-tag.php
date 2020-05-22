<?php
/**
 * A snippet to create a new custom tag taxonomy for a post type in WordPress. For more info, view:
 *
 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 *
 * @package jmc87_plugin
 */

class JMC87_CustomTag
{
    public $taxonomy   = 'custom_tag';
    public $post_type  = 'sample';

    public $rest_base  = 'custom_tag';
    public $query_var  = 'custom_tag';
    public $rewrite    = array( 
        'slug'          => 'custom-tag',
        'with_front'    => false,
        'hierarchical'  => false,
        'ep_mask'       => EP_NONE,
    );

    public function __construct()
    {
        add_action( 'init', array( $this, 'add_custom_tag' ) );
        add_filter( 'taxonomy_template', array( $this, 'get_custom_tag_template' ) );
    }

    public function add_custom_tag()
    {
        $args = array(
            'label'  => __( 'Custom Tags', 'plugin-textdomain' ),
            'labels' => array(
                'name'                       => __( 'Custom Tags', 'plugin-textdomain' ),
                'singular_name'              => __( 'Custom Tag', 'plugin-textdomain' ),
                'menu_name'                  => __( 'Custom Tags', 'plugin-textdomain' ),
                'all_items'                  => __( 'All Custom Tags', 'plugin-textdomain' ),
                'edit_item'                  => __( 'Edit Custom Tag', 'plugin-textdomain' ),
                'view_item'                  => __( 'View Custom Tag', 'plugin-textdomain' ),
                'update_item'                => __( 'Update Custom Tag', 'plugin-textdomain' ),
                'add_new_item'               => __( 'Add new Custom Tag', 'plugin-textdomain' ),
                'new_item_name'              => __( 'New Custom Tag Name', 'plugin-textdomain' ),
                'search_items'               => __( 'Search Custom Tags', 'plugin-textdomain' ),
                'popular_items'              => __( 'Popular Custom Tags', 'plugin-textdomain' ),
                'separate_items_with_commas' => __( 'Separate Custom Tags with Commas', 'plugin-textdomain' ),
                'add_or_remove_items'        => __( 'Add or remove Custom Tags', 'plugin-textdomain' ),
                'choose_from_most_used'      => __( 'Choose from most used Custom Tags', 'plugin-textdomain' ),
                'not_found'                  => __( 'Custom Tags not Found', 'plugin-textdomain' ),
                'back_to_items'              => __( 'Back to Custom Tags', 'plugin-textdomain' ),
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_rest' => true,
            'rest_base' => $this->rest_base,
            'show_tagcloud' => true,
            'show_in_quick_edit' => true,
            'show_admin_column' => false,
            'description' => __( 'Custom Tag Description', 'plugin-textdomain' ),
            'hierarchical' => false,
            'query_var' => $this->query_var,
            'rewrite' => $this->rewrite
        );

        register_taxonomy( $this->taxonomy, $this->post_type, $args );
    }

    public function get_custom_tag_template( $template )
    {
        if ( get_query_var( 'taxonomy' ) === $this->taxonomy )
            $template = PLUGIN_DIR . 'src/customTaxonomies/customTag/views/taxonomy-tag.php';

        return $template;
    }
}
