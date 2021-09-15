<?php
namespace PrefixCmd\Make\Settings\Core;

use Exception;
use PrefixCmd\Make\MakerBase;

class Core extends MakerBase
{
    public static function create_settings_page(): void
    {
        $data['name'] = self::$event->getIO()->ask( 'Please, enter a name for your new settings page [For example: MyAwesomeSettings]: ' );

        if ( null === $data['name'] ) {
            throw new Exception( 'You haven\'t entered a name for the settings page' );
        }

        $data['tag'] = self::$event->getIO()->ask( 'Please, enter a tag for your new settings page [For example: my-awesome-settings]: ' );

        if ( null === $data['tag'] ) {
            throw new Exception( 'You haven\'t entered a tag for the settings page' );
        }

        $data['name'] = self::sanitize_name( $data['name'] );
        $data['tag'] = self::sanitize_tag( $data['tag'] );

        self::$event->getIO()->write( sprintf( 'The name of your new settings page is %s', $data['name'] ) );

        $source_dir      = 'cmd/Make/Settings/Core/source';
        $destiny_dir     = 'src/Settings/';

        $source_contents = scandir( $source_dir ) ?: [];

        self::create_files( $data, $source_dir, $destiny_dir, $source_contents );

        self::$event->getIO()->write( 'Congratulations, the new settings page has been created' );
    }
}