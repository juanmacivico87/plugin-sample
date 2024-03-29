<?php
namespace PrefixSource\Endpoints\class_name;

if ( false === defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * class_name
 *
 * This class provides an example to create a custom endpoint for the WordPress Rest API.
 * For more information, visit the @link https://developer.wordpress.org/reference/functions/register_rest_route/
 *
 * @version	1.0
 * @since  	1.0
 * @package	{{ plugin_slug }}
 */
class class_name
{
    const ROUTE = 'class_route';

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
    public function init(): void
    {
        add_action( 'rest_api_init', [ $this, 'create_new_endpoint' ] );
    }

    /**
     * create_new_endpoint()
     *
     * This method takes care of registering the new route in the WordPress Rest API,
     * thanks to the register_rest_route() function.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	{{ plugin_slug }}
     */
    public function create_new_endpoint(): void
    {
        register_rest_route( PREFIX_PLUGIN_ENDPOINTS_NAMESPACE, SELF::ROUTE, [
            'methods'               => \WP_REST_Server::READABLE,
            'callback'              => [ $this, 'controller' ],
            'permission_callback'   => '__return_true',
        ] );
    }

    /**
     * controller()
     *
     * This method is responsible for executing the controller accessed through the endpoint declared in the previous method.
     *
     * @return 	WP_REST_Response|WP_Error If the request fails, the method responds with an object of class WP_Error. Otherwise, it responds with an object of class WP_REST_Response.
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	{{ plugin_slug }}
     */
    public function controller()
    {
        if ( is_wp_error( '' ) ) {
            return new \WP_Error( 'custom_error', __( 'Message of custom error', '{{ plugin_slug }}' ), [ 'status' => 400 ] );
        }

        return new \WP_REST_Response( [
            'code'		=> 'custom_response',
            'message'	=> __( 'Message of custom response', '{{ plugin_slug }}' ),
            'data'		=> [
                'status' => 200,
            ]
        ] );
    }
}
