<?php
/**
 * A snippet to create a new Gutenberg block. For more info, view:
 *
 * @link https://www.advancedcustomfields.com/resources/acf_register_block_type/
 *
 * @package jmc87_plugin
 */

class JMC87_CustomACFGutenbergBlock
{
    public function __construct()
    {
        add_action( 'acf/init', array( $this, 'add_custom_block' ) );
        add_action( 'init', array( $this, 'add_block_fields' ) );
    }
    
    public function add_custom_block()
    {
        if ( function_exists( 'acf_register_block_type' ) ) {
            acf_register_block_type(
                array(
                    'name'				=> 'sample',
                    'title'				=> __( 'Sample Block', 'plugin-textdomain' ),
                    'description'		=> __( 'A Gutenbetg sample block', 'plugin-textdomain' ),
                    'category'			=> 'formatting',
                    'icon'				=> 'admin-comments',
                    'keywords'			=> array( 'sample', 'block' ),
                    'post_types'        => array( 'post', 'page', 'sample' ),
                    'mode'              => 'edit',
                    'render_template'   => PLUGIN_DIR . 'src/Blocks/CustomACFBlock/views/template-acf-block.php',
                    'enqueue_assets'    => function() {
                        if ( !is_admin() )
                        {
                            wp_enqueue_style( 'sample-block-css', PLUGIN_URL . 'src/Blocks/CustomACFBlock/styles.css', array(), PLUGIN_VERSION );
                            wp_enqueue_script( 'sample-block-js', PLUGIN_URL . 'src/Blocks/CustomACFBlock/scripts.js', array(), PLUGIN_VERSION, true );
                            $args = array(
                                'ajax_url' => admin_url( 'admin-ajax.php' ),
                            );
                            wp_localize_script( 'sample-block-js', 'ajax_var', $args );
                        }
                    },
                    'supports'          => array( 'mode' => false ),
                )
            );
        }
    }

    public function add_block_fields()
    {
        if( function_exists( 'acf_add_local_field_group' ) ) :
            acf_add_local_field_group(
                array(
                    'key' => 'group_5cf76f0e4cde3',
                    'title' => __( 'Sample', 'plugin-textdomain' ),
                    'fields' => array(
                        array(
                            'key' => 'field_5cf76f15f55e8',
                            'label' => __( 'Title', 'plugin-textdomain' ),
                            'name' => 'sample_title',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                        array(
                            'key' => 'field_5cf76f28f55e9',
                            'label' => __( 'Subtitle', 'plugin-textdomain' ),
                            'name' => 'sample_subtitle',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                        array(
                            'key' => 'field_5cf76f3bf55ea',
                            'label' => __( 'Button', 'plugin-textdomain' ),
                            'name' => 'sample_button',
                            'type' => 'link',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'return_format' => 'array',
                        ),
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/sample',
                            ),
                        ),
                    ),
                    'menu_order' => 0,
                    'position' => 'normal',
                    'style' => 'default',
                    'label_placement' => 'top',
                    'instruction_placement' => 'label',
                    'hide_on_screen' => '',
                    'active' => true,
                    'description' => '',
                )
            );
        endif;
    }
}
