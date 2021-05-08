<?php
namespace PrefixCmd\Make\CustomPostType;

use Composer\Script\Event;
use Exception;

class CustomPostType
{
    private static $event;

    public function __construct( Event $event )
    {
        self::$event = $event;
    }

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

    private static function create_files( array $data, string $source_dir, string $destiny_dir, array $source_contents ) : void
    {
        if ( false !== empty( $source_contents ) )
            throw new Exception( sprintf( 'No content found in %s directory', $source_dir ) );

        if ( false === file_exists( $destiny_dir ) )
            mkdir( $destiny_dir, 0700, true );

        foreach( $source_contents as $key => $content ) {
            if ( 0 === $key || 1 === $key )
                continue;
            
            $new_content = $source_dir . '/' . $content;
            $new_destiny = self::sanitize_value( $data, $destiny_dir . '/' . $content );

            // var_dump( $new_content );
            // var_dump( $new_destiny );
            // echo '';

            if ( false !== is_dir( $new_content ) ) {
                $dir_content = scandir( $new_content );

                self::create_files( $data, $new_content, $new_destiny, $dir_content );
                self::$event->getIO()->write( sprintf( 'Directory %s has been created', $new_destiny ) );
                // var_dump( $dir_content );
                continue;
            }

            $file_content = file_get_contents( $new_content );

            if ( false === $file_content )
                throw new Exception( sprintf( 'Couldn\'t get %s file', $new_destiny ) );

            $file_content = self::sanitize_value( $data, $file_content );
            $is_created   = file_put_contents( $new_destiny, $file_content );

            if ( false !== $is_created )
                self::$event->getIO()->write( sprintf( 'File %s has been created', $new_destiny ) );
        }
    }

    private static function sanitize_name( string $name ) : ?string
    {
        $name = ucwords( $name );

        $utf8 = array(
            '/[ ]/'         => '',
            '/[áàâãªä]/u'   => 'a',
            '/[ÁÀÂÃÄ]/u'    => 'A',
            '/[ÍÌÎÏ]/u'     => 'I',
            '/[íìîï]/u'     => 'i',
            '/[éèêë]/u'     => 'e',
            '/[ÉÈÊË]/u'     => 'E',
            '/[óòôõºö]/u'   => 'o',
            '/[ÓÒÔÕÖ]/u'    => 'O',
            '/[úùûü]/u'     => 'u',
            '/[ÚÙÛÜ]/u'     => 'U',
            '/ç/'           => 'c',
            '/Ç/'           => 'C',
            '/ñ/'           => 'n',
            '/Ñ/'           => 'N',
            '/–/'           => '',
            '/[’‘‹›‚]/u'    => '',
            '/[“”«»„]/u'    => '',
            '/ /'           => '',
        );

        return preg_replace( array_keys( $utf8 ), array_values( $utf8 ), $name );
    }

    private static function sanitize_slug( string $slug ) : ?string
    {
        $utf8 = array(
            '/[ ]/'         => '',
            '/[áàâãªä]/u'   => 'a',
            '/[ÁÀÂÃÄ]/u'    => 'a',
            '/[ÍÌÎÏ]/u'     => 'i',
            '/[íìîï]/u'     => 'i',
            '/[éèêë]/u'     => 'e',
            '/[ÉÈÊË]/u'     => 'e',
            '/[óòôõºö]/u'   => 'o',
            '/[ÓÒÔÕÖ]/u'    => 'o',
            '/[úùûü]/u'     => 'u',
            '/[ÚÙÛÜ]/u'     => 'u',
            '/ç/'           => 'c',
            '/Ç/'           => 'c',
            '/ñ/'           => 'n',
            '/Ñ/'           => 'n',
            '/–/'           => '-',
            '/_/'           => '-',
            '/[’‘‹›‚]/u'    => '',
            '/[“”«»„]/u'    => '',
            '/ /'           => '',
        );

        return preg_replace( array_keys( $utf8 ), array_values( $utf8 ), $slug );
    }

    private static function sanitize_value( array $data, string $value ) : string
    {
        $value = str_ireplace( 'class_name', $data['name'], $value );
        $value = str_ireplace( 'class_slug', $data['slug'], $value );
        $value = str_ireplace( 'class_singular_lower_name', $data['singular_lower_name'], $value );
        $value = str_ireplace( 'class_plural_lower_name', $data['plural_lower_name'], $value );
        $value = str_ireplace( 'class_singular_upper_name', $data['singular_upper_name'], $value );
        $value = str_ireplace( 'class_plural_upper_name', $data['plural_upper_name'], $value );

        return $value;
    }
}