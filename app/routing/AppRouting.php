<?php

namespace plantlogic\routing;

use plantlogic\middleware\MiddlewareAuthentication;
use plantlogic\objects\APIResponse;
use plantlogic\routing\v1\AppRoutingV1;
use Slim\App;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteCollectorProxy;

class AppRouting
{
    public static function setupRoutes(App &$app)
    {
        $apiResponse = new APIResponse();

// 2022-07-22 (dreed): These to functions are deprecated and used for TTN V2. All calls are now made using Webhooks with TTN V3
//        // Get the current list of devices
//        $app->get("/devices", function(Request $request, Response $response, $args) use ($apiResponse) {
//            return $apiResponse->buildResponse($response);
//        });
//
//        // Get the current uplink
//        $app->get("/uplink", function(Request $request, Response $response, $args) use ($apiResponse) {
//            return $apiResponse->buildResponse($response);
//        });

        $app->get("/whoami", function(Request $request, Response $response, $args) use ($apiResponse) {

            $apiResponse->setStatus(APIResponse::OK);
            $apiResponse->setMessage("plantlogic");

            return $apiResponse->buildResponse($response);
        });



        $app->group("", function(RouteCollectorProxy $proxy)  use ($app, $apiResponse) {

            AppRoutingV1::setupRoutes($app, $apiResponse);

        })->add(new MiddlewareAuthentication());

        $app->any('/{path:.*}', function (Request $request, Response $response, array $args) {
            $response->getBody()->write("Not implemented");

            return $response->withStatus(APIResponse::Not_Implemented);
        });
    }
}