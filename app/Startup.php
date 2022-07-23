<?php

namespace plantlogic;

use plantlogic\middleware\AppMiddleware;
use plantlogic\routing\AppRouting;
use plantlogic\utilities\UtilityEnvironmentVariables;
use Slim\App;
use Slim\Factory\AppFactory;

class Startup
{
    private static ?Startup $instance = null;

    private ?App $app = null;

    public static function getInstance(): Startup
    {
        if (self::$instance === null)
            self::$instance = new Startup();

        return self::$instance;
    }

    private function __construct()
    {
        // Load the environment variable instance
        UtilityEnvironmentVariables::getInstance(__DIR__);

        // Instantiate the app factory
        $this->app = AppFactory::create();

        // Set the base path for use when the execution location is in a sub-directory from the web root
        $this->app->setBasePath("/apiv2");

        // Add in the routing middleware hooks
        $this->app->addRoutingMiddleware();

        AppMiddleware::registerPrestartMiddleware($this->app);
    }

    public function getBasePath(): string
    {
        return $this->app->getBasePath();
    }

    public function start()
    {
        AppRouting::setupRoutes($this->app);

        AppMiddleware::registerPoststartMiddleware($this->app);

        $this->app->run();
    }
}