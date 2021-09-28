<?php
namespace PrefixCmd\Make\Taxonomies\Hieralchical;

use Exception;
use PrefixCmd\Make\MakerBase;

class Hieralchical extends MakerBase
{
    public static function create_custom_hieralchical_taxonomy(): void
    {
        $data['name'] = self::$event->getIO()->ask( 'Please, enter a name for your new taxonomy [For example: MyAwesomeTaxonomy]: ' );

        if ( null === $data['name'] ) {
            throw new Exception( 'You haven\'t entered a name for the taxonomy' );
        }

        $data['slug'] = self::$event->getIO()->ask( 'Please, enter a slug for your new taxonomy [For example: my-awesome-taxonomy]: ' );

        if ( null === $data['slug'] ) {
            throw new Exception( 'You haven\'t entered a slug for the taxonomy' );
        }

        $data['slug_for_plural'] = self::$event->getIO()->ask( 'Please, enter a slug for plural of your new taxonomy [For example: my-awesomes-taxonomies]: ' );

        if ( null === $data['slug_for_plural'] ) {
            throw new Exception( 'You haven\'t entered a slug for plural of the taxonomy' );
        }

        $data['name'] = self::sanitize_name( $data['name'] );
        $data['slug'] = self::sanitize_slug( $data['slug'] );
        $data['slug_for_plural'] = self::sanitize_slug( $data['slug_for_plural'] );
        $data['singular_lower_name'] = str_ireplace( '-', '_', mb_convert_case( $data['slug'], MB_CASE_LOWER ) );
        $data['plural_lower_name'] = str_ireplace( '-', '_', mb_convert_case( $data['slug_for_plural'], MB_CASE_LOWER ) );
        $data['singular_upper_name'] = str_ireplace( '-', ' ', mb_convert_case( $data['slug'], MB_CASE_TITLE ) );
        $data['plural_upper_name'] = str_ireplace( '-', ' ', mb_convert_case( $data['slug_for_plural'], MB_CASE_TITLE ) );

        self::$event->getIO()->write( sprintf( 'The name of your new taxonomy is %s', $data['name'] ) );

        $source_dir      = 'cmd/Make/Taxonomies/Hieralchical/source';
        $destiny_dir     = 'src/Taxonomies/' . $data['name'];

        $source_contents = scandir( $source_dir ) ?: [];

        self::create_files( $data, $source_dir, $destiny_dir, $source_contents );

        self::$event->getIO()->write( 'Congratulations, the new taxonomy has been created' );
    }
}