<?php
/**
 * A snippet to add a new panel in WordPress Customizer. For more info, view:
 *
 * @link https://codex.wordpress.org/Theme_Customization_API
 *
 * @package plugin-sample
 */

namespace PrefixSource\Customizer\CustomizerSection;

if ( !defined( 'ABSPATH' ) )
    exit;

class CustomizerSection
{
    private $panel = 'panel_name';

    public function __construct()
    {
        add_action( 'customize_register', array( $this, 'add_new_customizer_panel' ) );
    }

    public function add_new_customizer_panel()
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

    public function add_new_customizer_section( $wp_customize )
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

    public function add_new_customizer_control( $wp_customize, $section_name )
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
