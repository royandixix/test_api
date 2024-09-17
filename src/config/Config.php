<?php

namespace MyApp\Config;

use MyApp\Core\DotEnv;

class Config
{
    public static function load()
    {
        // Path to .env file
        $dotenv = new DotEnv(__DIR__ . '../../.env');
        $dotenv->load();

        // Define constants
        define('BASEURL', getenv('BASE_URL'));
        define('DB_HOST', getenv('DB_HOST'));
        define('DB_NAME', getenv('DB_NAME'));
        define('DB_USER', getenv('DB_USER'));
        define('DB_PASSWORD', getenv('DB_PASSWORD'));
    }
}
