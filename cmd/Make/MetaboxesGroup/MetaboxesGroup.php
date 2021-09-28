<?php
namespace PrefixCmd\Make\MetaboxesGroup;

use Exception;
use PrefixCmd\Make\MakerBase;

class MetaboxesGroup extends MakerBase
{
    public static function create_custom_metaboxes_group() : void
    {
        $data['name'] = self::$event->getIO()->ask( 'Please, enter a name for your new group of metaboxes [For example: MyAwesomeMetaboxesGroup]: ' );

        if ( null === $data['name'] ) {
            throw new Exception( 'You haven\'t entered a name for the group of metaboxes' );
        }

        $data['tag'] = self::$event->getIO()->ask( 'Please, enter a tag for your new group of metaboxes [For example: my_awesome_metaboxes_group]: ' );

        if ( null === $data['tag'] ) {
            throw new Exception( 'You haven\'t entered a tag for the group of metaboxes' );
        }

        $data['name'] = self::sanitize_name( $data['name'] );
        $data['tag'] = self::sanitize_tag( $data['tag'] );
        $data['singular_upper_name'] = str_ireplace( '_', ' ', mb_convert_case( $data['tag'], MB_CASE_TITLE ) );

        self::$event->getIO()->write( sprintf( 'The name of your new group of metaboxes is %s', $data['name'] ) );

        $source_dir      = 'cmd/Make/MetaboxesGroup/source';
        $destiny_dir     = 'src/MetaBoxes/' . $data['name'];

        $source_contents = scandir( $source_dir ) ?: [];

        self::create_files( $data, $source_dir, $destiny_dir, $source_contents );

        self::$event->getIO()->write( 'Congratulations, the new group of metaboxes has been created' );
    }
}