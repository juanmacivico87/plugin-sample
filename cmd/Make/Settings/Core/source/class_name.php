<?php
namespace PrefixSource\Settings;

if ( false === defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Settings
 *
 * This class provides an example to create a new options page in WordPress.
 * For more information, visit the @link https://developer.wordpress.org/plugins/settings/settings-api/
 *
 * @version	1.0
 * @since  	1.0
 * @package	{{ plugin_slug }}
 */
class Settings
{
    const MENU_SLUG     = '{{ plugin_slug }}-settings';
    const FIELDS_GROUP  = '{{ plugin_slug }}-settings-group';

    private array $fields = [];

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
        $this->create_fields();

        add_action( 'admin_menu', [ $this, 'add_settings_page' ] );
        add_action( 'admin_init', [ $this, 'register_settings' ] );
    }

    private function create_fields(): void
    {
        $this->fields = [
            [
                'label' => __( 'Text Field', '{{ plugin_slug }}' ),
                'name'  => '_plugin_sample_text_field',
                'type'  => 'text',
            ],
            [
                'label' => __( 'Password Field', '{{ plugin_slug }}' ),
                'name'  => '_plugin_sample_password_field',
                'type'  => 'password',
            ],
            [
                'label' => __( 'Email Field', '{{ plugin_slug }}' ),
                'name'  => '_plugin_sample_email_field',
                'type'  => 'email',
            ],
            [
                'label' => __( 'Phone Field', '{{ plugin_slug }}' ),
                'name'  => '_plugin_sample_phone_field',
                'type'  => 'tel',
            ],
            [
                'label' => __( 'URL Field', '{{ plugin_slug }}' ),
                'name'  => '_plugin_sample_url_field',
                'type'  => 'url',
            ],
            [
                'label' => __( 'Textarea Field', '{{ plugin_slug }}' ),
                'name'  => '_plugin_sample_textarea_field',
                'type'  => 'textarea',
                'rows'  => 5,
                'cols'  => 30,
            ],
            [
                'label' => __( 'Checkbox Field', '{{ plugin_slug }}' ),
                'name'  => '_plugin_sample_checkbox_field',
                'type'  => 'checkbox',
            ],
            [
                'label'     => __( 'Radio Group', '{{ plugin_slug }}' ),
                'name'      => '_plugin_sample_radio_group',
                'type'      => 'radio',
                'options'   => [
                    'value' => __( 'Radio Field', '{{ plugin_slug }}' ),
                ],
            ],
            [
                'label' => __( 'Hidden Field', '{{ plugin_slug }}' ),
                'name'  => '_plugin_sample_hidden_field',
                'type'  => 'hidden',
            ],
            [
                'label' => __( 'Color Field', '{{ plugin_slug }}' ),
                'name'  => '_plugin_sample_color_field',
                'type'  => 'color',
            ],
            [
                'label' => __( 'Date Field', '{{ plugin_slug }}' ),
                'name'  => '_plugin_sample_date_field',
                'type'  => 'date',
            ],
            [
                'label' => __( 'Time Field', '{{ plugin_slug }}' ),
                'name'  => '_plugin_sample_time_field',
                'type'  => 'time',
            ],
            [
                'label' => __( 'Datetime Field', '{{ plugin_slug }}' ),
                'name'  => '_plugin_sample_datetime_field',
                'type'  => 'datetime',
            ],
            [
                'label' => __( 'Number Field', '{{ plugin_slug }}' ),
                'name'  => '_plugin_sample_number_field',
                'type'  => 'number',
            ],
            [
                'label' => __( 'Range Field', '{{ plugin_slug }}' ),
                'name'  => '_plugin_sample_range_field',
                'type'  => 'range',
                'min'   => 0,
                'max'   => 100,
                'value' => 0,
                'step'  => 1,
            ],
            [
                'label'     => __( 'Select Field', '{{ plugin_slug }}' ),
                'name'      => '_plugin_sample_select_field',
                'type'      => 'select',
                'options'   => [
                    'value' => __( 'Label', '{{ plugin_slug }}' )
                ]
            ],
        ];
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
     * @package	{{ plugin_slug }}
     */
    public function add_settings_page(): void
    {
        add_menu_page(
            __( '{{ plugin_name }} Settings', '{{ plugin_slug }}' ),
            __( '{{ plugin_name }} Settings', '{{ plugin_slug }}' ),
            'manage_options',
            self::MENU_SLUG,
            [ $this, 'render_settings_page' ],
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
     * @package	{{ plugin_slug }}
     */
    public function register_settings(): void
    {
        foreach($this->fields as $field) {
            register_setting( self::FIELDS_GROUP, $field['name'] );
        }
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
     * @package	{{ plugin_slug }}
     */
    public function render_settings_page(): void
    {
        ?><div class="wrap">
            <h1><?php _e( '{{ plugin_name }}', '{{ plugin_slug }}' ) ?></h1>
            <h2><?php _e( 'Settings', '{{ plugin_slug }}' ) ?></h2>
            <form method="post" action="options.php">
                <?php settings_fields( self::FIELDS_GROUP );
                do_settings_sections( self::FIELDS_GROUP ); ?>
                <table class="form-table">
                    <?php foreach( $this->fields as $field ) :
                        switch( $field['type'] ) :
                            case 'hidden':
                                $value = get_option( $field['name'] ) ?: ''; ?>
                                <input type="hidden" name="<?php echo esc_attr( $field['name'] ) ?>" value="<?php echo esc_attr( $value ) ?>" />
                                <?php break;
                            case 'text':
                            case 'email':
                            case 'phone':
                            case 'url':
                            case 'password':
                                $value = get_option( $field['name'] ) ?: ''; ?>
                                <tr valign="top">
                                    <th scope="row"><label for="<?php echo esc_attr( $field['name'] ) ?>"><?php echo esc_attr( $field['label'] ) ?></label></th>
                                    <td>
                                        <input type="<?php echo esc_attr( $field['type'] ) ?>" class="regular-text" name="<?php echo esc_attr( $field['name'] ) ?>" value="<?php echo esc_attr( $value ) ?>" />
                                    </td>
                                </tr>
                                <?php break;
                            case 'textarea':
                                $value = get_option( $field['name'] ) ?: ''; ?>
                                <tr valign="top">
                                    <th scope="row"><label for="<?php echo esc_attr( $field['name'] ) ?>"><?php echo esc_attr( $field['label'] ) ?></label></th>
                                    <td>
                                        <textarea name="<?php echo esc_attr( $field['name'] ) ?>" rows="<?php echo esc_attr( $field['rows'] ) ?>" cols="<?php echo esc_attr( $field['cols'] ) ?>">
                                            <?php echo esc_attr( $value ) ?>
                                        </textarea>
                                    </td>
                                </tr>
                                <?php break;
                            case 'radio':
                                ?><tr>
                                    <th scope="row"><?php echo esc_attr( $field['label'] ) ?></th>
                                    <td>
	                                    <fieldset>
                                            <legend class="screen-reader-text"><span><?php echo esc_attr( $field['label'] ) ?></span></legend>
                                            <?php foreach( $field['options'] as $value => $label ) : ?>
                                                <label>
                                                    <input type="radio" name="<?php echo esc_attr( $field['name'] ) ?>" value="<?php echo esc_attr( $value ) ?>">
                                                    <span class="date-time-text"><?php echo esc_attr( $label ) ?></span>
                                                </label><br>
                                            <?php endforeach ?>
                                        </fieldset>
                                    </td>
                                </tr>
                                <?php break;
                            case 'select':
                                $selected = get_option( $field['name'] ) ?: null; ?>
                                <tr valign="top">
                                    <th scope="row"><label for="<?php echo esc_attr( $field['name'] ) ?>"><?php echo esc_attr( $field['label'] ) ?></label></th>
                                    <td>
                                        <select name="<?php echo esc_attr( $field['name'] ) ?>">
                                            <?php foreach( $field['options'] as $value => $label ) : ?>
                                                <option value="<?php echo esc_attr( $value ) ?>" <?php selected( $selected, $value ); ?>>
                                                    <?php echo esc_attr( $label ) ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php break;
                        endswitch;
                    endforeach; ?>
                </table>
                <?php submit_button( __( 'Save Settings', '{{ plugin_slug }}' ), 'primary', 'save_{{ plugin_slug }}_settings', true, [] ) ?>
            </form>
        </div><?php
    }
}
