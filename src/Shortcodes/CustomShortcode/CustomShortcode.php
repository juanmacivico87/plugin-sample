<?php
/**
 * @package plugin-sample
 */

namespace PrefixSource\Shortcodes\CustomShortcode;

if ( !defined( 'ABSPATH' ) )
    exit;

class CustomShortcode
{
    public function __construct()
    {
        add_shortcode( 'custom_shortcode', array( $this, 'render_shortcode' ) );
    }

    public function render_shortcode( $args )
    {
        $sample_arg = isset( $args['sample'] ) ? $args['sample'] : null;
        
        ob_start(); ?>

            <h2><?php _e( 'This is a sample shortcode', 'plugin-sample' ) ?></h2>
            
        <?php return ob_get_clean();
    }
}
