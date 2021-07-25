<?php
namespace PrefixCmd\Make;

use Composer\Script\Event;
use Exception;

abstract class MakerBase
{
    public static $event;

    public function __construct( Event $event )
    {
        self::$event = $event;
    }

    public static function create_files( array $data, string $source_dir, string $destiny_dir, array $source_contents ) : void
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

            if ( false !== is_dir( $new_content ) ) {
                $dir_content = scandir( $new_content );

                self::create_files( $data, $new_content, $new_destiny, $dir_content );
                self::$event->getIO()->write( sprintf( 'Directory %s has been created', $new_destiny ) );
                
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

    public static function sanitize_name( string $name ) : ?string
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

    public static function sanitize_slug( string $slug ) : ?string
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

    public static function sanitize_shortcode_tag( string $tag ) : ?string
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
            '/–/'           => '_',
            '/[’‘‹›‚]/u'    => '',
            '/[“”«»„]/u'    => '',
            '/ /'           => '',
        );

        return preg_replace( array_keys( $utf8 ), array_values( $utf8 ), $tag );
    }

    public static function sanitize_value( array $data, string $value ) : string
    {
        $replaces = array(
            'name'                => 'class_name',
            'slug'                => 'class_slug',
            'route'               => 'class_route',
            'tag'                 => 'class_shortcode_tag',
            'singular_lower_name' => 'class_singular_lower_name',
            'singular_upper_name' => 'class_singular_upper_name',
            'plural_lower_name'   => 'class_plural_lower_name',
            'plural_upper_name'   => 'class_plural_upper_name',
        );

        foreach( $replaces as $key => $replace ) {
            if ( false === isset( $data[$key] ) ) {
                continue;
            }

            $value = str_ireplace( $replace, $data[$key], $value );
        }

        return $value;
    }
}