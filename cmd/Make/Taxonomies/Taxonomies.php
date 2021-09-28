<?php
namespace PrefixCmd\Make\Taxonomies;

use Composer\Script\Event;
use Exception;
use PrefixCmd\Make\Taxonomies\Hieralchical\Hieralchical;
use PrefixCmd\Make\Taxonomies\NotHieralchical\NotHieralchical;

class Taxonomies
{
    public static function make( Event $event, ?string $flag ): void
    {
        $options = [ 'hieralchical', 'not-hieralchical' ];

        if ( null === $flag ) {
            throw new Exception( sprintf( 'The flag is not allow to be null. Options are: %s', implode( ', ', $options ) ) );
        }

        if ( false === in_array( $flag, $options ) ) {
            throw new Exception( sprintf( 'The %s option is not set for the taxonomy command', $flag ) );
        }

        switch( $flag ) {
            case 'hieralchical':
                $hieralchical = new Hieralchical( $event );
                $hieralchical::create_custom_hieralchical_taxonomy();
                break;
            case 'not-hieralchical':
                $not_hieralchical = new NotHieralchical( $event );
                $not_hieralchical::create_custom_not_hieralchical_taxonomy();
                break;
        }
    }
}