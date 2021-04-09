<?php
namespace PrefixSource\Metaboxes\CustomMetaboxesGroup;

if ( false === defined( 'ABSPATH' ) )
    exit;

use PrefixSource\PostsTypes\CustomPostType\CustomPostType;

/**
 * CustomMetaboxesGroup
 *
 * This class provides an example to create a new metabox.
 * For more information, visit the @link https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
 *
 * @version	1.0
 * @since  	1.0
 * @package	plugin-sample
 */
class CustomMetaboxesGroup
{
    private string $metaboxes_group     = 'sample_metabox';
    private array $metaboxes            = array();

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
    public function init() : void
    {
        $this->metaboxes = array(
            '_sample_metabox' => __( 'Label for this metabox', 'plugin-sample' ),
        );

        add_action( 'add_meta_boxes', array( $this, 'add_metaboxes_group' ), 10, 2 );
        add_action( 'save_post', array( $this, 'save_metaboxes_group' ) );
    }

    /**
     * add_metaboxes_group()
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
    public function add_metaboxes_group( string $post_type, \WP_Post $post ) : void
    {
        add_meta_box(
            $this->metaboxes_group,
            __( 'Custom Metaboxes Group', 'plugin-sample' ),
            array( $this, 'render_metaboxes_group' ),
            CustomPostType::POST_TYPE_NAME,
            'side',
            'default'
        );
    }

    /**
     * render_metaboxes_group()
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
    public function render_metaboxes_group( \WP_Post $post ) : void
    {
        foreach( $this->metaboxes as $key => $label ) {
            $value = get_post_meta( $post->ID, $key, true ) ?: ''; ?>

            <div class="components-base-control__field">
                <label class="components-base-control__label" for="<?php echo $key ?>"><?php echo $label ?></label>
                <input class="components-base-control__input" name="<?php echo $key ?>" id="<?php echo $key ?>" value="<?php echo esc_attr( $value ) ?>" />
            </div><?php
        }
    }

    /**
     * save_metaboxes_group()
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
    public function save_metaboxes_group( int $post_id ) : void
    {
        foreach( $this->metaboxes as $key => $label ) {
            if ( false === array_key_exists( $key, $_POST ) || false !== empty( $_POST[$key] ) ) {
                delete_post_meta( $post_id, $key );
                continue;
            }

            $value = sanitize_meta( $key, $_POST[$key], 'post' );
            update_post_meta( $post_id, $key, $value );
        }
    }
}
