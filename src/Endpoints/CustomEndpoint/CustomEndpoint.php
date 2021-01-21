<?php
/**
 * @package plugin-sample
 */

namespace PrefixSource\Endpoints\CustomEndpoint;

if ( !defined( 'ABSPATH' ) )
    exit;

class CustomEndpoint
{
    private $route = 'custom-endpoint';

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        add_action( 'rest_api_init', array( $this, 'create_new_endpoint' ) );
    }

    public function create_new_endpoint()
    {
        register_rest_route( PREFIX_PLUGIN_ENDPOINTS_NAMESPACE, $this->route, array(
            'methods'               => \WP_REST_Server::READABLE,
            'callback'              => array( $this, 'controller' ),
            'permission_callback'   => '__return_true',
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
