<?php
/**
 * A snippet to create a new metabox in WordPress. For more info, view:
 *
 * @link https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
 *
 * @package plugin-sample
 */

namespace PrefixSource\Metaboxes\SampleMetabox;

if ( !defined( 'ABSPATH' ) )
    exit;

use PrefixSource\PostsTypes\SamplePostType\SamplePostType;

class SampleMetabox
{
    private $metabox_id  = 'sample_metabox';
    private $metabox_key = '_sample_metabox';

    public function __construct()
    {
        add_action( 'add_meta_boxes', array( $this, 'add_sample_metabox' ), 10, 2 );
        add_action( 'save_post', array( $this, 'save_sample_metabox' ) );
    }

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

    public function save_sample_metabox( $post_id )
    {
        if ( array_key_exists( $this->metabox_id, $_POST ) && $_POST[$this->metabox_id] != -1 ) {
            $metabox_id = sanitize_meta( $this->metabox_key, $_POST[$this->metabox_id], 'post' );
            update_post_meta( $post_id, $this->metabox_key, $metabox_id );
        } else delete_post_meta( $post_id, $this->metabox_key );
    }
}
