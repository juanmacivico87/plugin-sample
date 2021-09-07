<?php
namespace PrefixCmd\Make\Settings\Core;

use Exception;
use PrefixCmd\Make\MakerBase;

class Core extends MakerBase
{
    public static function create_settings_page(): void
    {
        $data            = [
            'name' => 'SettingsCore'
        ];
        $source_dir      = 'cmd/Make/Settings/Core/source';
        $destiny_dir     = 'src/Settings/' . $data['name'];

        $source_contents = scandir( $source_dir ) ?: [];

        self::create_files( $data, $source_dir, $destiny_dir, $source_contents );

        self::$event->getIO()->write( 'Congratulations, the new settings page has been created' );
    }
}