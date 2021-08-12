<?php
namespace PrefixCmd\Make\Customizer\Section;

use Exception;
use PrefixCmd\Make\MakerBase;

class Section extends MakerBase
{
    public static function create_customizer_section(): void
    {
        $data['name'] = self::$event->getIO()->ask( 'Please, enter a name for your new customizer section class [For example: MyAwesomeSection]: ' );

        if ( null === $data['name'] ) {
            throw new Exception( 'You haven\'t entered a name for the customizer section class' );
        }

        $data['slug'] = self::$event->getIO()->ask( 'Please, enter a slug for your new customizer section [For example: my-awesome-section]: ' );

        if ( null === $data['slug'] ) {
            throw new Exception( 'You haven\'t entered a slug for the customizer section' );
        }

        $data['name'] = self::sanitize_name( $data['name'] );
        $data['slug'] = self::sanitize_slug( $data['slug'] );
        $data['singular_upper_name'] = str_ireplace( '-', ' ', mb_convert_case( $data['slug'], MB_CASE_TITLE ) );

        self::$event->getIO()->write( sprintf( 'The name of your new customizer section class is %s', $data['name'] ) );

        $source_dir      = 'cmd/Make/Customizer/Section/source';
        $destiny_dir     = 'src/Customizer/Sections/' . $data['name'];

        $source_contents = scandir( $source_dir ) ?: [];

        self::create_files( $data, $source_dir, $destiny_dir, $source_contents );

        self::$event->getIO()->write( 'Congratulations, the new customizer section has been created' );
    }
}