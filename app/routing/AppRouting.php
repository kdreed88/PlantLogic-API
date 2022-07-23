<?php

namespace plantlogic\routing;

use plantlogic\middleware\MiddlewareAuthentication;
use plantlogic\response\APIResponse;
use Slim\App;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteCollectorProxy;

class AppRouting
{
    public static function setupRoutes(App $app)
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

        $app->group("", function(RouteCollectorProxy $proxy)  use ($app, $apiResponse) {
            
            $app->post("/registerDevices", function(Request $request, Response $response, $args) use ($apiResponse) {


                return $apiResponse->buildResponse($response);
            });

            $app->get("/getDevice", function(Request $request, Response $response, $args) use ($apiResponse) {


                return $apiResponse->buildResponse($response);
            });

            $app->post("/updateDevice", function(Request $request, Response $response, $args) use ($apiResponse) {


                return $apiResponse->buildResponse($response);
            });

            $app->get("/deleteDevice", function(Request $request, Response $response, $args) use ($apiResponse) {


                return $apiResponse->buildResponse($response);
            });

            $app->post("/customiseCalibration", function(Request $request, Response $response, $args) use ($apiResponse) {


                return $apiResponse->buildResponse($response);
            });

            $app->post("/customiseAlerts", function(Request $request, Response $response, $args) use ($apiResponse) {


                return $apiResponse->buildResponse($response);
            });

            $app->get("/customiseOffset", function(Request $request, Response $response, $args) use ($apiResponse) {


                return $apiResponse->buildResponse($response);
            });

            $app->post("/batchAlerts", function(Request $request, Response $response, $args) use ($apiResponse) {


                return $apiResponse->buildResponse($response);
            });

            $app->post("uplink", function(Request $request, Response $response, $args) use ($apiResponse) {


                return $apiResponse->buildResponse($response);
            });

            $app->post("manualPump", function(Request $request, Response $response, $args) use ($apiResponse) {


                return $apiResponse->buildResponse($response);
            });

            $app->post("/resetAccumulation", function(Request $request, Response $response, $args) use ($apiResponse) {


                return $apiResponse->buildResponse($response);
            });

            $app->post("/startCalibration", function(Request $request, Response $response, $args) use ($apiResponse) {


                return $apiResponse->buildResponse($response);
            });

            $app->post("/endCalibration", function(Request $request, Response $response, $args) use ($apiResponse) {


                return $apiResponse->buildResponse($response);
            });
            
        })->add(new MiddlewareAuthentication());
    }
}