<?php
namespace PrefixSource\Blocks\class_name;

if ( false === defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * class_name
 *
 * This class provides an example to create a Gutenberg block with the help of the Advanced Custom Field PRO plugin.
 * For more information, visit the @link https://www.advancedcustomfields.com/resources/acf_register_block_type/
 *
 * @version	1.0
 * @since  	1.0
 * @package	{{ plugin_slug }}
 */
class class_name
{
    const BLOCK_NAME = 'class_tag';
    const BLOCK_SLUG = 'acf/class_slug';
    const POST_TYPES = [];

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
    public function init(): void
    {
        add_action( 'acf/init', [ $this, 'add_custom_block' ] );
        add_action( 'init', [ $this, 'add_block_fields' ] );
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
     * @package	{{ plugin_slug }}
     */
    public function add_custom_block(): void
    {
        if ( false === function_exists( 'acf_register_block_type' ) ) {
            return;
        }

        acf_register_block_type(
            [
                'name'				=> self::BLOCK_NAME,
                'title'				=> __( 'class_singular_upper_name', '{{ plugin_slug }}' ),
                'description'		=> __( '', '{{ plugin_slug }}' ),
                'category'			=> '',
                'icon'				=> 'admin-comments',
                'keywords'			=> [ 'block' ],
                'post_types'        => [ self::POST_TYPES ],
                'mode'              => 'edit',
                'render_template'   => PREFIX_PLUGIN_DIR . 'src/Blocks/class_name/views/template-class_tag.php',
                'supports'          => [ 'mode' => false ],
                'enqueue_assets'    => function() {
                    if ( !is_admin() ) {
                        wp_enqueue_style( 'class_slug', PREFIX_PLUGIN_URL . 'src/Blocks/class_name/css/styles.css', [], '1.0' );
                        wp_enqueue_script( 'class_slug', PREFIX_PLUGIN_URL . 'src/Blocks/class_name/js/scripts.js', [], '1.0', true );
                        $args = [];
                        wp_localize_script( 'class_slug', 'blockObject', $args );
                    }
                    // CSS class: .is-style-class_slug-style
                    register_block_style(
                        self::BLOCK_SLUG,
                        [
                            'name'  => 'class_slug-style',
                            'label' => __( 'class_singular_upper_name Style', '{{ plugin_slug }}' ),
                        ]
                    );
                },
            ]
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
     * @package	{{ plugin_slug }}
     */
    public function add_block_fields(): void
    {
        if ( false === function_exists( 'acf_add_local_field_group' ) ) {
            return;
        }

        acf_add_local_field_group( [] );
    }
}
