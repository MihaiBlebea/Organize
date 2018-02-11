<?php

namespace App\Database;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use App\Database\Organize;
use App\Database\Connector\Connector;
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
                    "App\Database\Example\AppMigrator",
                    "App\Database\Example\ChildMigrator",
                    "App\Database\Example\GradeMigrator"
                ]
            ]);
            return $organize;
        });
    }

    public function run($instance)
    {

    }
}
