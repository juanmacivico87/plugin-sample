<?php
namespace PrefixCmd\Make\Customizer\Control;

use Exception;
use PrefixCmd\Make\MakerBase;

class Control extends MakerBase
{
    public static function create_customizer_control() : void
    {
        $data['name'] = self::$event->getIO()->ask( 'Please, enter a name for your new customizer control class [For example: MyAwesomeControl]: ' );

        if ( null === $data['name'] )
            throw new Exception( 'You haven\'t entered a name for the customizer control class' );

        $data['slug'] = self::$event->getIO()->ask( 'Please, enter a slug for your new customizer control [For example: my-awesome-control]: ' );

        if ( null === $data['slug'] )
            throw new Exception( 'You haven\'t entered a slug for the customizer control' );

        $data['name'] = self::sanitize_name( $data['name'] );
        $data['slug'] = self::sanitize_slug( $data['slug'] );
        $data['singular_upper_name'] = str_ireplace( '-', ' ', mb_convert_case( $data['slug'], MB_CASE_TITLE ) );

        self::$event->getIO()->write( sprintf( 'The name of your new customizer control class is %s', $data['name'] ) );

        $source_dir      = 'cmd/Make/Customizer/Control/source';
        $destiny_dir     = 'src/Customizer/Controls/' . $data['name'];

        $source_contents = scandir( $source_dir ) ?: [];

        self::create_files( $data, $source_dir, $destiny_dir, $source_contents );

        self::$event->getIO()->write( 'Congratulations, the new customizer control has been created' );
    }
}