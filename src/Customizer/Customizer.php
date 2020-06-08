<?php
/**
 * Load Customizer sections.
 *
 * @package plugin-sample
 */

if ( !defined( 'ABSPATH' ) )
    exit;

class Customizer
{
    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'load_customizer_sections' ) );
    }

    public function load_customizer_sections()
    {
        require 'CustomizerSection/CustomizerSection.php';
        $customizer_section = new CustomizerSection();
    }
}
