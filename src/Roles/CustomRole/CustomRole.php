<?php
/**
 * @package plugin-sample
 */

namespace PrefixSource\Roles\CustomRole;

if ( !defined( 'ABSPATH' ) )
    exit;

class CustomRole
{
    private $role_name = 'custom_role';

    public function __construct()
    {
        add_action( 'init', array( $this, 'add_new_role' ) );
    }
    
    public function add_new_role()
    {
        add_role(
            $this->role_name,
            __( 'Custom role', 'plugin-sample' ),
            array()
        );
    }
}