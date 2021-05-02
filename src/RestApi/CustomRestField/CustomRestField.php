<?php
namespace PrefixSource\RestApi\CustomRestField;

if ( false === defined( 'ABSPATH' ) )
    exit;

/**
 * CustomRestField
 *
 * This class provides an example to add a new field with information to an endpoint already defined in the
 * WordPress Rest API. For more information, visit the @link https://developer.wordpress.org/reference/functions/register_rest_field/
 *
 * @version	1.0
 * @since  	1.0
 * @package	{{ plugin_slug }}
 */
class CustomRestField
{
    private array $post_types = array( 'post', 'page' );

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
    
        register_rest_field( $this->post_types, 'custom-rest-field', $args );
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
