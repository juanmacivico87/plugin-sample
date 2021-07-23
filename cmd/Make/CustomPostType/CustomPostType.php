<?php
namespace PrefixCmd\Make\CustomPostType;

use Composer\Script\Event;
use Exception;
use PrefixCmd\Make\MakerBase;

class CustomPostType extends MakerBase
{
    public static function create_custom_post_type() : void
    {
        $data['name'] = self::$event->getIO()->ask( 'Please, enter a name for your new custom post type [For example: MyAwesomeCpt]: ' );

        if ( null === $data['name'] )
            throw new Exception( 'You haven\'t entered a name for the custom post type' );

        $data['slug'] = self::$event->getIO()->ask( 'Please, enter a slug for your new custom post type [For example: my-awesome-cpt]: ' );

        if ( null === $data['slug'] )
            throw new Exception( 'You haven\'t entered a slug for the custom post type' );

        $data['slug_for_plural'] = self::$event->getIO()->ask( 'Please, enter a slug for plural of your new custom post type [For example: my-awesomes-cpts]: ' );

        if ( null === $data['slug_for_plural'] )
            throw new Exception( 'You haven\'t entered a slug for plural of the custom post type' );

        $data['name'] = self::sanitize_name( $data['name'] );
        $data['slug'] = self::sanitize_slug( $data['slug'] );
        $data['slug_for_plural'] = self::sanitize_slug( $data['slug_for_plural'] );
        $data['singular_lower_name'] = str_ireplace( '-', '_', mb_convert_case( $data['slug'], MB_CASE_LOWER ) );
        $data['plural_lower_name'] = str_ireplace( '-', '_', mb_convert_case( $data['slug_for_plural'], MB_CASE_LOWER ) );
        $data['singular_upper_name'] = str_ireplace( '-', ' ', mb_convert_case( $data['slug'], MB_CASE_TITLE ) );
        $data['plural_upper_name'] = str_ireplace( '-', ' ', mb_convert_case( $data['slug_for_plural'], MB_CASE_TITLE ) );

        self::$event->getIO()->write( sprintf( 'The name of your new custom post type is %s', $data['name'] ) );

        $source_dir      = 'cmd/Make/CustomPostType/source';
        $destiny_dir     = 'src/PostsTypes/' . $data['name'];

        $source_contents = scandir( $source_dir ) ?: [];

        self::create_files( $data, $source_dir, $destiny_dir, $source_contents );

        self::$event->getIO()->write( 'Congratulations, the new custom post type has been created' );
    }
}