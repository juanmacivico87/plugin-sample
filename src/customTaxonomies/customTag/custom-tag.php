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
        add_action( 'init', array( $this, 'jmc87_add_custom_tag' ) );
        add_filter( 'taxonomy_template', array( $this, 'jmc87_get_custom_tag_template' ) );
    }

    public function jmc87_add_custom_tag()
    {
        $args = array(
            'label'  => __( 'Custom Tags', 'jmc87_plugin_textdomain' ),
            'labels' => array(
                'name'                       => __( 'Custom Tags', 'jmc87_plugin_textdomain' ),
                'singular_name'              => __( 'Custom Tag', 'jmc87_plugin_textdomain' ),
                'menu_name'                  => __( 'Custom Tags', 'jmc87_plugin_textdomain' ),
                'all_items'                  => __( 'All Custom Tags', 'jmc87_plugin_textdomain' ),
                'edit_item'                  => __( 'Edit Custom Tag', 'jmc87_plugin_textdomain' ),
                'view_item'                  => __( 'View Custom Tag', 'jmc87_plugin_textdomain' ),
                'update_item'                => __( 'Update Custom Tag', 'jmc87_plugin_textdomain' ),
                'add_new_item'               => __( 'Add new Custom Tag', 'jmc87_plugin_textdomain' ),
                'new_item_name'              => __( 'New Custom Tag Name', 'jmc87_plugin_textdomain' ),
                'search_items'               => __( 'Search Custom Tags', 'jmc87_plugin_textdomain' ),
                'popular_items'              => __( 'Popular Custom Tags', 'jmc87_plugin_textdomain' ),
                'separate_items_with_commas' => __( 'Separate Custom Tags with Commas', 'jmc87_plugin_textdomain' ),
                'add_or_remove_items'        => __( 'Add or remove Custom Tags', 'jmc87_plugin_textdomain' ),
                'choose_from_most_used'      => __( 'Choose from most used Custom Tags', 'jmc87_plugin_textdomain' ),
                'not_found'                  => __( 'Custom Tags not Found', 'jmc87_plugin_textdomain' ),
                'back_to_items'              => __( 'Back to Custom Tags', 'jmc87_plugin_textdomain' ),
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
            'description' => __( 'Custom Tag Description', 'jmc87_plugin_textdomain' ),
            'hierarchical' => false,
            'query_var' => $this->query_var,
            'rewrite' => $this->rewrite
        );

        register_taxonomy( $this->taxonomy, $this->post_type, $args );
    }

    public function jmc87_get_custom_tag_template( $template )
    {
        if ( get_query_var( 'taxonomy' ) === $this->taxonomy )
            $template = PLUGIN_DIR . 'src/customTaxonomies/customTag/views/taxonomy-tag.php';

        return $template;
    }
}
