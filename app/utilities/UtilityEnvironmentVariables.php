<?php

namespace plantlogic\utilities;

use Dotenv\Dotenv;

class UtilityEnvironmentVariables
{
    private static ?UtilityEnvironmentVariables $instance = null;

    private array $environment_variables;

    public static function getInstance(?string $appDir = null): UtilityEnvironmentVariables
    {
        if (self::$instance === null)
            self::$instance = new UtilityEnvironmentVariables($appDir);

        return self::$instance;
    }

    private function __construct(string $appDir)
    {
        $dotenv = Dotenv::createImmutable(dirname($appDir));
        $this->environment_variables = $dotenv->load();
    }

    public function getVariable(string $key = ""): ?string {
        if (isset($this->environment_variables[$key]))
            return $this->environment_variables[$key];

        return null;
    }
}