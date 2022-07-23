<?php

namespace plantlogic\routing\v1;

use plantlogic\objects\APIResponse;
use Slim\App;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class AppRoutingV1
{

    public static function setupRoutes(App $app, APIResponse $apiResponse)
    {
        $app->post("/registerDevice", function(Request $request, Response $response, $args) use ($apiResponse) {


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
    }
}