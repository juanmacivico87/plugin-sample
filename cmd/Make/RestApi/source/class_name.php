<?php
namespace PrefixSource\RestApi\class_name;

if ( false === defined( 'ABSPATH' ) )
    exit;

/**
 * class_name
 *
 * This class provides an example to add a new field with information to an endpoint already defined in the
 * WordPress Rest API. For more information, visit the @link https://developer.wordpress.org/reference/functions/register_rest_field/
 *
 * @version	1.0
 * @since  	1.0
 * @package	{{ plugin_slug }}
 */
class class_name
{
    const POST_TYPES = array();

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
        add_action( 'rest_api_init', array( $this, 'add_new_rest_field' ) );
    }

    /**
     * add_new_rest_field()
     *
     * This method is responsible for creating the new field and adding it to the indicated endpoint.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	{{ plugin_slug }}
     */
    public function add_new_rest_field() : void
    {
        $args = array(
            'get_callback' => array( $this, 'get_rest_field_value' ),
        );
    
        register_rest_field( self::POST_TYPES, 'custom-rest-field', $args );
    }

    /**
     * get_rest_field_value()
     *
     * This method takes care of returning the value of the new field from the endpoint.
     *
     * @return 	string  Value of the new field
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	{{ plugin_slug }}
     */
    public function get_rest_field_value() : string
    {
        return 'Some value';
    }
}
