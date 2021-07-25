<?php
namespace PrefixSource\Shortcodes\class_name;

if ( false === defined( 'ABSPATH' ) )
    exit;

/**
 * class_name
 *
 * This class provides an example to create a custom shortcode in WordPress.
 * For more information, visit the @link https://developer.wordpress.org/reference/functions/add_shortcode/
 *
 * @version	1.0
 * @since  	1.0
 * @package	{{ plugin_slug }}
 */
class class_name
{
    const SHORTCODE_TAG = 'class_shortcode_tag';
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
        add_shortcode( self::SHORTCODE_TAG, array( $this, 'render_shortcode' ) );
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
     * @package	{{ plugin_slug }}
     */
    public function render_shortcode( array $args ) : string
    {
        $sample_arg = isset( $args['sample'] ) ? $args['sample'] : null;
        
        ob_start();

        include PREFIX_PLUGIN_DIR . 'src/Shortcodes/class_name/views/template-class_shortcode_tag.php';

        $render = ob_get_contents();
        ob_get_clean();

        return $render;
    }
}
