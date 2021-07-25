<?php
namespace PrefixCmd\Make;

use Composer\Script\Event;
use Exception;
use PrefixCmd\Make\BlocksCategory\BlocksCategory;
use PrefixCmd\Make\CustomPostType\CustomPostType;
use PrefixCmd\Make\Endpoint\Endpoint;
use PrefixCmd\Make\RestApi\RestApi;
use PrefixCmd\Make\Role\Role;
use PrefixCmd\Make\Shortcode\Shortcode;

class Make
{
    public static function make( Event $event ) : void
    {
        $options = array( 'block', 'blocks-category', 'cpt', 'customizer', 'endpoint', 'metabox', 'rest-api-field', 'role', 'shortcode', 'taxonomy' );
        $args    = $event->getArguments();

        if ( false !== empty( $args ) )
            throw new Exception( 'No arguments found for make command' );

        if ( false === in_array( $args[0], $options ) )
            throw new Exception( sprintf( 'The %s option is not set for the make command', $args[0] ) );

        switch( $args[0] ) {
            case 'block':
                $event->getIO()->write( 'This is a block' );
                break;
            case 'blocks-category':
                $blocks_category = new BlocksCategory( $event );
                $blocks_category::create_custom_blocks_category();
                break;
            case 'cpt':
                $cpt = new CustomPostType( $event );
                $cpt::create_custom_post_type();
                break;
            case 'customizer':
                $event->getIO()->write( 'This is a section of the customizer' );
                break;
            case 'endpoint':
                $endpoint = new Endpoint( $event );
                $endpoint::create_custom_endpoint();
                break;
            case 'metabox':
                $event->getIO()->write( 'This is a group of metaboxes' );
                break;
            case 'rest-api-field':
                $rest_api = new RestApi( $event );
                $rest_api::create_custom_rest_api_field();
                break;
            case 'role':
                $role = new Role( $event );
                $role::create_custom_role();
                break;
            case 'shortcode':
                $shortcode = new Shortcode( $event );
                $shortcode::create_custom_shortcode();
                break;
            case 'taxonomy':
                $event->getIO()->write( 'This is a custom taxonomy' );
                break;
        }
    }
}