<?php declare(strict_types=1);

namespace App\Database;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class DatabaseConnection
{
    private static ?Connection $instance = null;

    public static function getConnection(): Connection
    {
        if (self::$instance === null) {
            $connectionParams = [
                'dbname' => $_ENV["DB_NAME"],
                'user' => $_ENV["USER"],
                'password' => $_ENV["PASSWORD"],
                'host' => $_ENV["HOST"],
                'driver' => 'pdo_mysql',
            ];
            self::$instance = DriverManager::getConnection($connectionParams);
        }

        return self::$instance;
    }
}
