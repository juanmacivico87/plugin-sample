<?php
namespace PrefixCmd\Make\Role;

use Exception;
use PrefixCmd\Make\MakerBase;

class Role extends MakerBase
{
    public static function create_custom_role() : void
    {
        $data['name'] = self::$event->getIO()->ask( 'Please, enter a name for your new role class [For example: MyAwesomeRole]: ' );

        if ( null === $data['name'] )
            throw new Exception( 'You haven\'t entered a name for the role class' );

        $data['slug'] = self::$event->getIO()->ask( 'Please, enter a slug for your new role [For example: my-awesome-role]: ' );

        if ( null === $data['slug'] )
            throw new Exception( 'You haven\'t entered a slug for the role' );

        $data['name'] = self::sanitize_name( $data['name'] );
        $data['slug'] = self::sanitize_slug( $data['slug'] );

        self::$event->getIO()->write( sprintf( 'The name of your new role class is %s', $data['name'] ) );

        $source_dir      = 'cmd/Make/Role/source';
        $destiny_dir     = 'src/Roles/' . $data['name'];

        $source_contents = scandir( $source_dir ) ?: [];

        self::create_files( $data, $source_dir, $destiny_dir, $source_contents );

        self::$event->getIO()->write( 'Congratulations, the new role has been created' );
    }
}