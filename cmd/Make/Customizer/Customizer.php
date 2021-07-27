<?php
namespace PrefixCmd\Make\Customizer;

use Composer\Script\Event;
use Exception;
use PrefixCmd\Make\Customizer\Panel\Panel;

class Customizer
{
    public static function make( Event $event, ?string $flag ) : void
    {
        $options = array( 'panel', 'section', 'control' );

        if ( null === $flag ) {
            throw new Exception( sprintf( 'The flag is not allow to be null. Options are: %s', implode( ', ', $options ) ) );
        }

        if ( false === in_array( $flag, $options ) )
            throw new Exception( sprintf( 'The %s option is not set for the customizer command', $flag ) );

        switch( $flag ) {
            case 'panel':
                $panel = new Panel( $event );
                $panel::create_customizer_panel();
                break;
            case 'section':
                $event->getIO()->write( 'This is a section of the customizer' );
                break;
            case 'control':
                $event->getIO()->write( 'This is a control of the customizer' );
                break;
        }
    }
}