<?php

namespace SerbanBlebea\Organize\Factory;

use SerbanBlebea\Organize\Connector\Connector;
use Framework\Configs\Config;

class ConnectorFactory
{
    private static $config;

    public static function init()
    {
        $config = new Config();
        self::$config = $config->getConfig("database");
    }

    public static function build()
    {
        static::init();

        return new Connector(self::$config["connect"]["servername"],
                             self::$config["connect"]["database"],
                             self::$config["connect"]["username"],
                             self::$config["connect"]["password"]);
    }
}
