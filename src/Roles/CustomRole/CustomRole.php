<?php
namespace PrefixSource\Roles\CustomRole;

if ( !defined( 'ABSPATH' ) )
    exit;

/**
 * CustomRole
 *
 * This class provides an example to create a custom role in WordPress.
 * For more information, visit the @link https://developer.wordpress.org/reference/functions/add_role/
 *
 * @version	1.0
 * @since  	1.0
 * @package	plugin-sample
 */
class CustomRole
{
    private $role_name = 'custom_role';

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
    public function init()
    {
        add_action( 'init', array( $this, 'add_new_role' ) );
    }
    
    /**
     * add_new_role()
     *
     * This method is responsible for adding the new role to the system.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function add_new_role()
    {
        add_role(
            $this->role_name,
            __( 'Custom role', 'plugin-sample' ),
            array()
        );
    }
}