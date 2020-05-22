<?php
/**
 * A snippet to add a new panel in WordPress Customizer. For more info, view:
 *
 * @link https://codex.wordpress.org/Theme_Customization_API
 *
 * @package jmc87_plugin
 */

class JMC87_CustomizerSection
{
    public $panel      = 'panel_name';
    public $section    = 'section_name';
    public $control    = 'control_name';

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
                'title'          => __( 'Panel Name', 'plugin-textdomain' ),
            )
        );

        $wp_customize->add_section( 
            $this->section,
            array(
                'title'         => __( 'Section Name', 'plugin-textdomain' ),
                'priority'      => 1,
                'description'   => __( 'A little section description', 'plugin-textdomain' ),
                'capability'    => 'edit_pages',
                'panel'         => $this->panel,
            )
        );

        $wp_customize->add_setting(
            $this->control,
            array(
                'default'       => '',
                'type'          => 'option',
                'capability'    => 'edit_pages',
                'transport'     => 'refresh',
            )
        );

        $wp_customize->add_control(
            $this->control,
            array(
                'label'       => __( 'Control Name', 'plugin-textdomain' ),
                'description' => __( 'A little control description', 'plugin-textdomain' ),
                'section'     => $this->section,
                'priority'    => 1,
                'type'        => 'text',
            )
        );
    }
}
