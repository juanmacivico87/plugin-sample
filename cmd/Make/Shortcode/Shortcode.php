<?php
namespace PrefixCmd\Make\Shortcode;

use Exception;
use PrefixCmd\Make\MakerBase;

class Shortcode extends MakerBase
{
    public static function create_custom_shortcode() : void
    {
        $data['name'] = self::$event->getIO()->ask( 'Please, enter a name for your new shortcode class [For example: MyAwesomeShortcode]: ' );

        if ( null === $data['name'] )
            throw new Exception( 'You haven\'t entered a name for the shortcode class' );

        $data['tag'] = self::$event->getIO()->ask( 'Please, enter a tag for your new shortcode [For example: my_awesome_shortcode]: ' );

        if ( null === $data['tag'] )
            throw new Exception( 'You haven\'t entered a tag for the shortcode' );

        $data['name'] = self::sanitize_name( $data['name'] );
        $data['tag'] = self::sanitize_tag( $data['tag'] );

        self::$event->getIO()->write( sprintf( 'The name of your new shortcode class is %s', $data['name'] ) );

        $source_dir      = 'cmd/Make/Shortcode/source';
        $destiny_dir     = 'src/Shortcodes/' . $data['name'];

        $source_contents = scandir( $source_dir ) ?: [];

        self::create_files( $data, $source_dir, $destiny_dir, $source_contents );

        self::$event->getIO()->write( 'Congratulations, the new shortcode has been created' );
    }
}