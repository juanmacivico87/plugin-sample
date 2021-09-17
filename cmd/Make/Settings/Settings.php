<?php
namespace PrefixCmd\Make\Settings;

use Composer\Script\Event;
use Exception;
use PrefixCmd\Make\Settings\ACF\ACF;
use PrefixCmd\Make\Settings\Core\Core;

class Settings
{
    public static function make( Event $event, ?string $flag ): void
    {
        $options = [ 'core', 'acf' ];

        if ( null === $flag ) {
            throw new Exception( sprintf( 'The flag is not allow to be null. Options are: %s', implode( ', ', $options ) ) );
        }

        if ( false === in_array( $flag, $options ) ) {
            throw new Exception( sprintf( 'The %s option is not set for the taxonomy command', $flag ) );
        }

        switch( $flag ) {
            case 'core':
                $core = new Core( $event );
                $core::create_settings_page();
                break;
            case 'acf':
                $acf = new ACF( $event );
                $acf::create_settings_page();
                break;
        }
    }
}