<?php

namespace plantlogic\middleware;

use plantlogic\objects\APIResponse;
use plantlogic\utilities\UtilityEnvironmentVariables;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class MiddlewareAuthentication
{
    /**
     * @param Request $request
     * @param RequestHandler $handler
     * @return Response
     */
    public function __invoke(Request $request, RequestHandler $handler): Response {

        // Get the headers from the request
        $headers = $request->getHeaders();

        // Ensure that there is at least one header and the app header key was set
        if (count($headers) > 0 && array_key_exists("x-app-header", $headers))
        {
            // Check that the ap pheader key matches the one saved in the environment
            if ($headers['x-app-header'][0] === UtilityEnvironmentVariables::getInstance()->getVariable('X_APP_HEADER'))
            {
                // Handle the next process in the request chain
                return $handler->handle($request);
            }
        }

        // Return the proper response indicating forbidden access
        return (new Response())->withStatus(APIResponse::Unauthorized, "Unauthorized");
    }
}