<?php
namespace PrefixSource\Shortcodes\CustomShortcode;

if ( false === defined( 'ABSPATH' ) )
    exit;

/**
 * CustomShortcode
 *
 * This class provides an example to create a custom shortcode in WordPress.
 * For more information, visit the @link https://developer.wordpress.org/reference/functions/add_shortcode/
 *
 * @version	1.0
 * @since  	1.0
 * @package	plugin-sample
 */
class CustomShortcode
{
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
        add_shortcode( 'custom_shortcode', array( $this, 'render_shortcode' ) );
    }

    /**
     * render_shortcode()
     *
     * This method is responsible for rendering the shortcode in the front.
     *
     * @param   array   $args   Arguments for the shortcode
     * @return 	string  This will return the contents of the output buffer or FALSE, if output buffering isn't active
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function render_shortcode( array $args ) : string
    {
        $sample_arg = isset( $args['sample'] ) ? $args['sample'] : null;
        
        ob_start();

        include PREFIX_PLUGIN_DIR . 'src/Shortcodes/CustomShortcode/views/template-shortcode.php';

        $render = ob_get_contents();
        ob_get_clean();

        return $render;
    }
}
