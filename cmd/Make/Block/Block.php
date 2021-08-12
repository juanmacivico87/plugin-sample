<?php
namespace PrefixCmd\Make\Block;

use Exception;
use PrefixCmd\Make\MakerBase;

class Block extends MakerBase
{
    public static function create_custom_block(): void
    {
        $data['name'] = self::$event->getIO()->ask( 'Please, enter a name for your new block [For example: MyAwesomeBlock]: ' );

        if ( null === $data['name'] ) {
            throw new Exception( 'You haven\'t entered a name for the custom block' );
        }

        $data['slug'] = self::$event->getIO()->ask( 'Please, enter a slug for your new custom block [For example: my-awesome-block]: ' );

        if ( null === $data['slug'] ) {
            throw new Exception( 'You haven\'t entered a slug for the custom block' );
        }

        $data['tag'] = self::$event->getIO()->ask( 'Please, enter a tag for your new custom block [For example: my_awesome_block]: ' );

        if ( null === $data['tag'] ) {
            throw new Exception( 'You haven\'t entered a tag for the custom block' );
        }

        $data['name'] = self::sanitize_name( $data['name'] );
        $data['slug'] = self::sanitize_slug( $data['slug'] );
        $data['tag'] = self::sanitize_tag( $data['tag'] );
        $data['singular_upper_name'] = str_ireplace( '-', ' ', mb_convert_case( $data['slug'], MB_CASE_TITLE ) );

        self::$event->getIO()->write( sprintf( 'The name of your new block is %s', $data['name'] ) );

        $source_dir      = 'cmd/Make/Block/source';
        $destiny_dir     = 'src/Blocks/' . $data['name'];

        $source_contents = scandir( $source_dir ) ?: [];

        self::create_files( $data, $source_dir, $destiny_dir, $source_contents );

        self::$event->getIO()->write( 'Congratulations, the new block has been created' );
    }
}