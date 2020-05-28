<?php
/**
 * Load Customizer sections.
 *
 * @package jmc87_plugin
 */

class JMC87_Customizer
{
    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'load_customizer_sections' ) );
    }

    public function load_customizer_sections()
    {
        require 'CustomizerSection/CustomizerSection.php';
        $customizer_section = new JMC87_CustomizerSection();
    }
}
