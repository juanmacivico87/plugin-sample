<?php
namespace PrefixCmd\Make;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;
use Exception;
use PrefixCmd\Make\CustomPostType\CustomPostType;

class Make
{
    public static function make( Event $event ) : void
    {
        $options = array( 'block', 'block-category', 'cpt', 'customizer', 'endpoint', 'metabox', 'rest-api', 'role', 'shortcode', 'taxonomy' );
        $args    = $event->getArguments();

        if ( false !== empty( $args ) )
            throw new Exception( 'No arguments found for make command' );

        if ( false === in_array( $args[0], $options ) )
            throw new Exception( sprintf( 'The %s option is not set for the make command', $args[0] ) );

        switch( $args[0] ) {
            case 'block':
                $event->getIO()->write( 'This is a block' );
                break;
            case 'block-category':
                $event->getIO()->write( 'This is a category of blocks' );
                break;
            case 'cpt':
                $cpt = new CustomPostType( $event );
                $cpt::create_custom_post_type();
                break;
            case 'customizer':
                $event->getIO()->write( 'This is a section of the customizer' );
                break;
            case 'endpoint':
                $event->getIO()->write( 'This is a custom endpoint' );
                break;
            case 'metabox':
                $event->getIO()->write( 'This is a group of metaboxes' );
                break;
            case 'rest-api':
                $event->getIO()->write( 'This is a custom field for the Rest API' );
                break;
            case 'role':
                $event->getIO()->write( 'This is a role' );
                break;
            case 'shortcode':
                $event->getIO()->write( 'This is a shortcode' );
                break;
            case 'taxonomy':
                $event->getIO()->write( 'This is a custom taxonomy' );
                break;
        }
    }
}