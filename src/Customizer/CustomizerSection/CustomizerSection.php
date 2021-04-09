<?php
namespace PrefixSource\Customizer\CustomizerSection;

if ( false === defined( 'ABSPATH' ) )
    exit;

/**
 * CustomizerSection
 *
 * This class provides an example to create a new panel in WordPress customizer.
 * For more information, visit the @link https://codex.wordpress.org/Theme_Customization_API
 *
 * @version	1.0
 * @since  	1.0
 * @package	plugin-sample
 */
class CustomizerSection
{
    private string $panel = 'panel_name';

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
    public function init() : void
    {
        add_action( 'customize_register', array( $this, 'add_new_customizer_panel' ) );
    }

    /**
     * add_new_customizer_panel()
     *
     * This method is responsible for adding a new options panel to the WordPress customizer.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function add_new_customizer_panel() : void
    {
        global $wp_customize;

        $wp_customize->add_panel( 
            $this->panel, 
            array(
                'priority'       => 1,
                'capability'     => 'edit_pages',
                'title'          => __( 'Panel Name', 'plugin-sample' ),
            )
        );

        $this->add_new_customizer_section( $wp_customize );
    }

    /**
     * add_new_customizer_section()
     *
     * This method takes care of adding a new section in the created panel.
     *
     * @param   WP_Customize_Manager    $wp_customize   WP_Customize_Manager instance.
     * @return 	void
     * @access 	private
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    private function add_new_customizer_section( \WP_Customize_Manager $wp_customize ) : void
    {
        $section_name = 'section_name';

        $wp_customize->add_section( 
            $section_name,
            array(
                'title'         => __( 'Section Name', 'plugin-sample' ),
                'priority'      => 1,
                'description'   => __( 'A little section description', 'plugin-sample' ),
                'capability'    => 'edit_pages',
                'panel'         => $this->panel,
            )
        );

        $this->add_new_customizer_control( $wp_customize, $section_name );
    }

    /**
     * add_new_customizer_control()
     *
     * This method is responsible for adding a new control to the section of the panel created in the customizer.
     *
     * @param   WP_Customize_Manager    $wp_customize   WP_Customize_Manager instance.
     * @param   string                  $section_name   Name of the section in which to create the control.
     * @return 	void
     * @access 	private
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    private function add_new_customizer_control( \WP_Customize_Manager $wp_customize, string $section_name ) : void
    {
        $control = '_control_name';

        $wp_customize->add_setting(
            $control,
            array(
                'default'       => '',
                'type'          => 'option',
                'capability'    => 'edit_pages',
                'transport'     => 'refresh',
            )
        );

        $wp_customize->add_control(
            $control,
            array(
                'label'       => __( 'Control Name', 'plugin-sample' ),
                'description' => __( 'A little control description', 'plugin-sample' ),
                'section'     => $section_name,
                'priority'    => 1,
                'type'        => 'text',
            )
        );
    }
}
