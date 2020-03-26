<?php
/**
 * A snippet to create a new metabox in WordPress. For more info, view:
 *
 * @link https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
 *
 * @package jmc87_plugin
 */

class JMC87_SampleMetabox
{
    public $screen      = 'sample';
    public $metabox_id  = 'sample_metabox';
    public $metabox_key = '_sample_metabox';

    public function __construct()
    {
        add_action( 'add_meta_boxes', array( $this, 'jmc87_add_sample_metabox' ) );
        add_action( 'save_post', array( $this, 'jmc87_save_sample_metabox' ) );
    }

    public function jmc87_add_sample_metabox()
    {
        add_meta_box(
            $this->metabox_id,
            __( 'Sample Meta Box Title', 'jmc87_plugin_textdomain' ),
            array( $this, 'jmc87_render_sample_metabox' ),
            $this->screen,
            'side',
            'default'
        );
    }

    public function jmc87_render_sample_metabox( $post )
    {
        $value = get_post_meta( $post->ID, $this->metabox_key, true ); ?>

        <label for="<?php echo $this->metabox_id ?>"><?php _e( 'Description for this metabox', 'jmc87_plugin_textdomain' ) ?></label>
        <select name="<?php echo $this->metabox_id ?>" id="<?php echo $this->metabox_id ?>">
            <option value="-1"><?php _e( 'Select an option', 'jmc87_plugin_textdomain' ) ?></option>
            <option value="1" <?php selected( $value, '1' ); ?>><?php _e( 'Option 1', 'jmc87_plugin_textdomain' ) ?></option>
            <option value="2" <?php selected( $value, '2' ); ?>><?php _e( 'Option 2', 'jmc87_plugin_textdomain' ) ?></option>
        </select>
        
        <?php
    }

    public function jmc87_save_sample_metabox( $post_id )
    {
        if ( array_key_exists( $this->metabox_id, $_POST ) && $_POST[$this->metabox_id] != -1 )
            update_post_meta( $post_id, $this->metabox_key, $_POST[$this->metabox_id] );
        else delete_post_meta( $post_id, $this->metabox_key );
    }
}
