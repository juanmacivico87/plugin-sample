<?php
namespace PrefixSource\Customizer\Controls\class_name;

if ( false === defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * class_name
 *
 * This class provides an example to create a new control in WordPress customizer.
 * For more information, visit the @link https://codex.wordpress.org/Theme_Customization_API
 *
 * @version	1.0
 * @since  	1.0
 * @package	{{ plugin_slug }}
 */
class class_name
{
    const CONTROL_NAME = 'class_slug';

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
        add_action( 'customize_register', [ $this, 'add_new_customizer_control' ], 20 );
    }

    /**
     * add_new_customizer_control()
     *
     * This method is responsible for adding a new control to the section of the panel created in the customizer.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	{{ plugin_slug }}
     */
    public function add_new_customizer_control(): void
    {
        global $wp_customize;

        $wp_customize->add_setting(
            self::CONTROL_NAME,
            [
                'default'       => '',
                'type'          => 'option',
                'capability'    => 'edit_pages',
                'transport'     => 'refresh',
            ]
        );

        $wp_customize->add_control(
            self::CONTROL_NAME,
            [
                'label'       => __( 'class_singular_upper_name', '{{ plugin_slug }}' ),
                'description' => __( '', '{{ plugin_slug }}' ),
                'section'     => '', // CustomizerSectionClass::SECTION_NAME
                'priority'    => 1,
                'type'        => 'text',
            ]
        );
    }
}
