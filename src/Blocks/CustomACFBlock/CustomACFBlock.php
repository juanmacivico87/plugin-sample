<?php
namespace PrefixSource\Blocks\CustomACFBlock;

if ( !defined( 'ABSPATH' ) )
    exit;

use PrefixSource\BlocksCategories\CustomBlocksCategory\CustomBlocksCategory;
use PrefixSource\PostsTypes\CustomPostType\CustomPostType;

/**
 * CustomACFBlock
 *
 * This class provides an example to create a Gutenberg block with the help of the Advanced Custom Field PRO plugin.
 * For more information, visit the @link https://www.advancedcustomfields.com/resources/acf_register_block_type/
 *
 * @version	1.0
 * @since  	1.0
 * @package	plugin-sample
 */
class CustomACFBlock
{
    const BLOCK_NAME = 'sample';
    const BLOCK_SLUG = 'acf/sample';

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
        add_action( 'acf/init', array( $this, 'add_custom_block' ) );
        add_action( 'init', array( $this, 'add_block_fields' ) );
    }
    
    /**
     * add_custom_block()
     *
     * This method is responsible for registering the new block for Gutenberg through the acf_register_block_type() function.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function add_custom_block()
    {
        if ( false === function_exists( 'acf_register_block_type' ) )
            return;

        acf_register_block_type(
            array(
                'name'				=> self::BLOCK_NAME,
                'title'				=> __( 'Sample Block', 'plugin-sample' ),
                'description'		=> __( 'A Gutenbetg sample block', 'plugin-sample' ),
                'category'			=> CustomBlocksCategory::BLOCK_CATEGORY_SLUG,
                'icon'				=> 'admin-comments',
                'keywords'			=> array( 'sample', 'block' ),
                'post_types'        => array( CustomPostType::POST_TYPE_NAME ),
                'mode'              => 'edit',
                'render_template'   => PREFIX_PLUGIN_DIR . 'src/Blocks/CustomACFBlock/views/template-acf-block.php',
                'supports'          => array( 'mode' => false ),
                'enqueue_assets'    => function() {
                    if ( !is_admin() )
                    {
                        wp_enqueue_style( 'sample-block-css', PREFIX_PLUGIN_URL . 'src/Blocks/CustomACFBlock/css/styles.css', array(), '1.0' );
                        wp_enqueue_script( 'sample-block-js', PREFIX_PLUGIN_URL . 'src/Blocks/CustomACFBlock/js/scripts.js', array(), '1.0', true );
                        $args = array(
                            'ajax_url' => admin_url( 'admin-ajax.php' ),
                        );
                        wp_localize_script( 'sample-block-js', 'ajax_var', $args );
                    }
                    // CSS class: .is-style-sample-custom-style
                    register_block_style(
                        self::BLOCK_SLUG,
                        array(
                            'name'  => 'sample-custom-style',
                            'label' => __( 'Sample Custom Style', 'plugin-sample' ),
                        )
                    );
                },
            )
        );
    }

    /**
     * add_block_fields()
     *
     * This method takes care of registering a group of fields and setting it to the created block, with the help of the
     * acf_add_local_field_group() function.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function add_block_fields()
    {
        if ( false === function_exists( 'acf_add_local_field_group' ) )
            return;

        acf_add_local_field_group(
            array(
                'key' => 'group_5cf76f0e4cde3',
                'title' => __( 'Sample', 'plugin-sample' ),
                'fields' => array(
                    array(
                        'key' => 'field_5cf76f15f55e8',
                        'label' => __( 'Title', 'plugin-sample' ),
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
                        'label' => __( 'Subtitle', 'plugin-sample' ),
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
                        'label' => __( 'Button', 'plugin-sample' ),
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
                            'value' => self::BLOCK_SLUG,
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
    }
}
