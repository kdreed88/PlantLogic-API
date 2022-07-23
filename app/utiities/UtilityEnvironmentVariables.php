<?php

namespace plantlogic\utilities;

use Dotenv\Dotenv;

class UtilityEnvironmentVariables
{
    private static ?UtilityEnvironmentVariables $instance = null;

    private array $environment_variables;

    public static function getInstance(): UtilityEnvironmentVariables
    {
        if (self::$instance === null)
            self::$instance = new UtilityEnvironmentVariables();

        return self::$instance;
    }

    private function __construct()
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $this->environment_variables = $dotenv->load();
    }

    public function getVariable(string $key = ""): ?string {
        if (isset($this->environment_variables[$key]))
            return $this->environment_variables[$key];

        return null;
    }
}