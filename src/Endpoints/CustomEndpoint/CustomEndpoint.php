<?php
/**
 * @package plugin-sample
 */

namespace PrefixSource\Endpoints\CustomEndpoint;

if ( !defined( 'ABSPATH' ) )
    exit;

class CustomEndpoint
{
    public function __construct()
    {
        add_action( 'rest_api_init', array( $this, 'create_new_endpoint' ) );
    }

    public function create_new_endpoint()
    {
        register_rest_route( 'custom', 'endpoint', array(
            'methods'  => \WP_REST_Server::READABLE,
            'callback' => array( $this, 'controller' ),
        ) );
    }

    public function controller()
    {
        return array(
            'code'      => 200,
            'message'   => 'OK',
        );
    }
}
