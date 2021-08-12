<?php
namespace PrefixCmd\Make\Endpoint;

use Exception;
use PrefixCmd\Make\MakerBase;

class Endpoint extends MakerBase
{
    public static function create_custom_endpoint(): void
    {
        $data['name'] = self::$event->getIO()->ask( 'Please, enter a name for your new endpoint [For example: MyAwesomeEndpoint]: ' );

        if ( null === $data['name'] ) {
            throw new Exception( 'You haven\'t entered a name for the custom endpoint' );
        }

        $data['route'] = self::$event->getIO()->ask( 'Please, enter a route for your new custom endpoint [For example: my-awesome-endpoint]: ' );

        if ( null === $data['route'] ) {
            throw new Exception( 'You haven\'t entered a route for the custom endpoint' );
        }

        $data['name'] = self::sanitize_name( $data['name'] );
        $data['route'] = self::sanitize_slug( $data['route'] );

        self::$event->getIO()->write( sprintf( 'The name of your new endpoint is %s', $data['name'] ) );

        $source_dir      = 'cmd/Make/Endpoint/source';
        $destiny_dir     = 'src/Endpoints/' . $data['name'];

        $source_contents = scandir( $source_dir ) ?: [];

        self::create_files( $data, $source_dir, $destiny_dir, $source_contents );

        self::$event->getIO()->write( 'Congratulations, the new endpoint has been created' );
    }
}