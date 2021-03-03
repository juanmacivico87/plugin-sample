<?php
namespace PrefixSource\Metaboxes\SampleMetabox;

if ( !defined( 'ABSPATH' ) )
    exit;

use PrefixSource\PostsTypes\SamplePostType\SamplePostType;

/**
 * SampleMetabox
 *
 * This class provides an example to create a new metabox.
 * For more information, visit the @link https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
 *
 * @version	1.0
 * @since  	1.0
 * @package	plugin-sample
 */
class SampleMetabox
{
    private $metabox_id  = 'sample_metabox';
    private $metabox_key = '_sample_metabox';

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
        add_action( 'add_meta_boxes', array( $this, 'add_sample_metabox' ), 10, 2 );
        add_action( 'save_post', array( $this, 'save_sample_metabox' ) );
    }

    /**
     * add_sample_metabox()
     *
     * This method is responsible for adding the new metabox on the edit page of the post types that are indicated.
     *
     * @param   string  $post_type  Post type
     * @param   WP_Post $post       Post object
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function add_sample_metabox( $post_type, $post )
    {
        add_meta_box(
            $this->metabox_id,
            __( 'Sample Meta Box Title', 'plugin-sample' ),
            array( $this, 'render_sample_metabox' ),
            SamplePostType::POST_TYPE_NAME,
            'side',
            'default'
        );
    }

    /**
     * render_sample_metabox()
     *
     * This method is responsible for rendering the metabox or group of metaboxes in the place chosen for it.
     *
     * @param   WP_Post $post   Post object
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function render_sample_metabox( $post )
    {
        $value = get_post_meta( $post->ID, $this->metabox_key, true ); ?>

        <label for="<?php echo esc_attr( $this->metabox_id ) ?>"><?php esc_html_e( 'Description for this metabox', 'plugin-sample' ) ?></label>
        <select name="<?php echo esc_attr( $this->metabox_id ) ?>" id="<?php echo esc_attr( $this->metabox_id ) ?>">
            <option value="-1"><?php esc_html_e( 'Select an option', 'plugin-sample' ) ?></option>
            <option value="1" <?php selected( $value, '1' ); ?>><?php esc_html_e( 'Option 1', 'plugin-sample' ) ?></option>
            <option value="2" <?php selected( $value, '2' ); ?>><?php esc_html_e( 'Option 2', 'plugin-sample' ) ?></option>
        </select>
        
        <?php
    }

    /**
     * save_sample_metabox()
     *
     * This method takes care of saving the metabox value in the database, when the post to which it is
     * associated is published or updated.
     *
     * @param   int $post_id    Post object ID
     * @return 	void
     * @access 	public
     * @version	1.0
     * @since  	1.0
     * @package	plugin-sample
     */
    public function save_sample_metabox( $post_id )
    {
        if ( false === array_key_exists( $this->metabox_id, $_POST ) || false !== empty( $_POST[$this->metabox_id] ) || '-1' === $_POST[$this->metabox_id] ) {
            delete_post_meta( $post_id, $this->metabox_key );
            return;
        }

        $metabox_id = sanitize_meta( $this->metabox_key, $_POST[$this->metabox_id], 'post' );
        update_post_meta( $post_id, $this->metabox_key, $metabox_id );
    }
}
