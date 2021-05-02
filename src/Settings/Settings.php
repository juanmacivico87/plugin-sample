<?php
namespace \Settings;

if ( false === defined( 'ABSPATH' ) )
    exit;

/**
 * Settings
 *
 * This class provides an example to create a new options page in WordPress.
 * For more information, visit the @link https://developer.wordpress.org/plugins/settings/settings-api/
 *
 * @version	1.0
 * @since  	1.0
 * @package	
 */
class Settings
{
    const MENU_SLUG     = '-settings';
    const FIELDS_GROUP  = '-settings-group';

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
     * @package	
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
     * @package	
     */
    public function init() : void
    {
        add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
        add_action( 'admin_init', array( $this, 'register_settings' ) );
    }

    /**
     * add_settings_page()
     *
     * This method is responsible for creating the plugin options page.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	
     */
    public function add_settings_page() : void
    {
        add_menu_page(
            __( ' Settings', '' ),
            __( ' Settings', '' ),
            'manage_options',
            self::MENU_SLUG,
            array( $this, 'render_settings_page' ),
            'dashicons-paperclip',
            3
        );
    }

    /**
     * register_settings()
     *
     * This method takes care of registering the group of fields with the plugin options.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	
     */
    public function register_settings() : void
    {
        register_setting( self::FIELDS_GROUP, '_plugin_sample_field' );
    }

    /**
     * render_settings_page()
     *
     * This method is responsible for render the plugin options page.
     *
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	
     */
    public function render_settings_page() : void
    {
        $field = get_option( '_plugin_sample_field' ) ?: null; ?>

        <div class="wrap">
            <h1><?php _e( '', '' ) ?></h1>
            <h2><?php _e( 'Settings', '' ) ?></h2>
            <form method="post" action="options.php">
                <?php settings_fields( self::FIELDS_GROUP );
                do_settings_sections( self::FIELDS_GROUP ); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php _e( 'Field', '' ) ?></th>
                        <td>
                            <input type="text" class="regular-text" name="_plugin_sample_field" value="<?php echo null !== $field ? esc_attr( $field ) : '' ?>" />
                        </td>
                    </tr>
                </table>
                <?php submit_button( __( 'Save Settings', '' ), 'primary', 'save_dapda_vehicles_settings', true, array() ) ?>
            </form>
        </div><?php
    }
}
