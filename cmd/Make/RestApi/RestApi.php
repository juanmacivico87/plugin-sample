<?php
namespace PrefixCmd\Make\RestApi;

use Exception;
use PrefixCmd\Make\MakerBase;

class RestApi extends MakerBase
{
    public static function create_custom_rest_api_field(): void
    {
        $data['name'] = self::$event->getIO()->ask( 'Please, enter a name for your new Rest API field class [For example: MyAwesomeRestApiField]: ' );

        if ( null === $data['name'] ) {
            throw new Exception( 'You haven\'t entered a name for the custom Rest API field class' );
        }

        $data['name'] = self::sanitize_name( $data['name'] );

        self::$event->getIO()->write( sprintf( 'The name of your new Rest API field class is %s', $data['name'] ) );

        $source_dir      = 'cmd/Make/RestApi/source';
        $destiny_dir     = 'src/RestApi/' . $data['name'];

        $source_contents = scandir( $source_dir ) ?: [];

        self::create_files( $data, $source_dir, $destiny_dir, $source_contents );

        self::$event->getIO()->write( 'Congratulations, the new Rest API field class has been created' );
    }
}