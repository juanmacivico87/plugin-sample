<?php
namespace PrefixCmd\Make\Customizer;

use Composer\Script\Event;
use Exception;
use PrefixCmd\Make\Customizer\Control\Control;
use PrefixCmd\Make\Customizer\Panel\Panel;
use PrefixCmd\Make\Customizer\Section\Section;

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
                $section = new Section( $event );
                $section::create_customizer_section();
                break;
            case 'control':
                $control = new Control( $event );
                $control::create_customizer_control();
                break;
        }
    }
}