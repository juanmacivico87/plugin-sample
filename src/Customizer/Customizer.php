<?php
/**
 * Load Customizer sections.
 *
 * @package plugin-sample
 */

namespace Source\Customizer;

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
        $customizer_section = new \Source\Customizer\CustomizerSection\CustomizerSection;
    }
}
