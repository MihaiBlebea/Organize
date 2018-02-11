<?php

namespace SerbanBlebea\Organize;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use SerbanBlebea\Organize\Organize;
use SerbanBlebea\Organize\Connector\Connector;
use Framework\Configs\Config;

class OrganizeComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('Organize', function() {
            $config = new Config();
            $config = $config->getConfig("database");
            $connector = new Connector($config["connect"]["servername"],
                                       $config["connect"]["database"],
                                       $config["connect"]["username"],
                                       $config["connect"]["password"]);

            $organize = new Organize($connector);
            $organize->setup([
                "migrations" => [
                    "SerbanBlebea\Organize\Example\AppMigrator",
                    "SerbanBlebea\Organize\Example\ChildMigrator",
                    "SerbanBlebea\Organize\Example\GradeMigrator"
                ]
            ]);
            return $organize;
        });
    }

    public function run($instance)
    {

    }
}
