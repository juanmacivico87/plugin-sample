<?php
namespace PrefixCmd\Make\BlocksCategory;

use Exception;
use PrefixCmd\Make\MakerBase;

class BlocksCategory extends MakerBase
{
    public static function create_custom_blocks_category(): void
    {
        $data['name'] = self::$event->getIO()->ask( 'Please, enter a name for your custom blocks category [For example: MyAwesomeBlocksCategory]: ' );

        if ( null === $data['name'] ) {
            throw new Exception( 'You haven\'t entered a name for the custom blocks category' );
        }

        $data['slug'] = self::$event->getIO()->ask( 'Please, enter a slug for your new custom blocks category [For example: my-awesome-blocks-category]: ' );

        if ( null === $data['slug'] ) {
            throw new Exception( 'You haven\'t entered a slug for the custom blocks category' );
        }

        $data['name'] = self::sanitize_name( $data['name'] );
        $data['slug'] = self::sanitize_slug( $data['slug'] );
        $data['singular_upper_name'] = str_ireplace( '-', ' ', mb_convert_case( $data['slug'], MB_CASE_TITLE ) );

        self::$event->getIO()->write( sprintf( 'The name of your custom blocks category is %s', $data['name'] ) );

        $source_dir      = 'cmd/Make/BlocksCategory/source';
        $destiny_dir     = 'src/BlocksCategories/' . $data['name'];

        $source_contents = scandir( $source_dir ) ?: [];

        self::create_files( $data, $source_dir, $destiny_dir, $source_contents );

        self::$event->getIO()->write( 'Congratulations, the custom blocks category has been created' );
    }
}