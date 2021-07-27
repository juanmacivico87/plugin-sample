<?php
namespace PrefixSource\Customizer\Sections\class_name;

if ( false === defined( 'ABSPATH' ) )
    exit;

/**
 * class_name
 *
 * This class provides an example to create a new section in WordPress customizer.
 * For more information, visit the @link https://codex.wordpress.org/Theme_Customization_API
 *
 * @version	1.0
 * @since  	1.0
 * @package	{{ plugin_slug }}
 */
class class_name
{
    const SECTION_NAME = 'class_slug';

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
        add_action( 'customize_register', array( $this, 'add_new_customizer_section' ), 15 );
    }

    /**
     * add_new_customizer_section()
     *
     * This method takes care of adding a new section in the created panel.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	{{ plugin_slug }}
     */
    public function add_new_customizer_section() : void
    {
        global $wp_customize;

        $wp_customize->add_section( 
            self::SECTION_NAME,
            array(
                'title'         => __( 'class_singular_upper_name', '{{ plugin_slug }}' ),
                'priority'      => 1,
                'description'   => __( '', '{{ plugin_slug }}' ),
                'capability'    => 'edit_pages',
                'panel'         => '', // CustomizerPanelClass::PANEL_NAME
            )
        );
    }
}
