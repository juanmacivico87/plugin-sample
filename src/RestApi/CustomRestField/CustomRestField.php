<?php
/**
 * @package plugin-sample
 */

namespace PrefixSource\RestApi\CustomRestField;

if ( !defined( 'ABSPATH' ) )
    exit;

class CustomRestField
{
    private $post_types = array( 'post', 'page' );

    public function __construct()
    {
        add_action( 'rest_api_init', array( $this, 'add_new_rest_field' ) );
    }

    public function add_new_rest_field()
    {
        $args = array(
            'get_callback' => array( $this, 'get_rest_field_value' ),
        );
    
        register_rest_field( $this->post_types, 'custom-rest-field', $args );
    }

    public function get_rest_field_value()
    {
        return 'Some value';
    }
}
