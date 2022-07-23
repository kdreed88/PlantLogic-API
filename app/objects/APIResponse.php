<?php

namespace plantlogic\response;

use plantlogic\utilities\UtilityArrayCleanup;
use Slim\Psr7\Response;

class APIResponse
{
    private $status = self::OK;

    private $data = array();

    private $message = "";

    private $details = "";

    private $forceJSON = false;

    private $errorCode = null;

    public function __construct()
    {
        $this->setStatus(self::OK);
    }

    public function setStatus(int $status)
    {
        $this->status = $status;

        $this->setMessageForStatus($status);

    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setData(array $data)
    {
        UtilityArrayCleanup::trimValues($data);

        if (count($this->data) > 0)
        {
            $data = array_merge($data, $this->data);
        }

        $this->data = $data;
    }

    public function getData(bool $asJson = false)
    {
        if (count($this->data) == 0)
            $this->data = [];

        if ($asJson)
            return json_encode($this->data);

        return $this->data;
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setErrorCode(string $source, string $errorCode)
    {
        $this->errorCode = "$source:$errorCode";
    }

    public function setDetails(string $details)
    {
        $this->details = $details;
    }

    public function getDetails(): string
    {
        if (strlen($this->details) === 0 && count($this->data) > 0)
        {
            $this->details = implode("<br>", $this->data);
        }

        return $this->details;
    }

    public function toArray(): array
    {
        return array(
            "data"=>$this->data,
            "message"=>$this->message,
        );
    }

    public function isValid(): bool
    {
        return $this->status === self::OK;
    }

    public function forceJSON()
    {
        $this->forceJSON = true;
    }


    /**
     * Transfer the API Response into a PSR-7 Response
     *
     * @param Response $response
     * @return Response
     */
    public function buildResponse(Response &$response): Response
    {
        if ($this->isValid())
        {
            if (($this->forceJSON || (count($this->data) > 0 || strlen($this->message) == 0)))
            {
                $response->getBody()->write($this->getData(true));

                return $response->withStatus($this->getStatus())->withHeader("Content-Type", "application/json");
            }
            else
            {
                $response->getBody()->write($this->getMessage());

                return $response->withStatus($this->getStatus())->withHeader("Content-Type", "text/plain");
            }
        }
        else
        {
            if ($this->errorCode !== null && strlen(trim($this->errorCode)) > 0)
            {
                $response->getBody()->write($this->errorCode." - ".$this->getDetails());
            }
            else
            {
                $response->getBody()->write($this->getDetails());
            }


            return $response->withStatus($this->getStatus(), $this->getMessage())->withHeader("Content-Type", "text/plain");
        }
    }

    private function setMessageForStatus(int $status)
    {
        switch ($status)
        {
            case self::Continue:
                $this->setMessage("CONTINUE");
                break;

            case self::Processing:
                $this->setMessage("PROCESSING");
                break;

            case self::OK:
                $this->setMessage("OK");
                break;

            case self::Created:
                $this->setMessage("CREATED");
                break;

            case self::Accepted:
                $this->setMessage("ACCEPTED");
                break;

            case self::No_Content:
                $this->setMessage("NO CONTENT");
                break;

            case self::Reset_Content:
                $this->setMessage("REST CONTENT");
                break;

            case self::Bad_Request:
                $this->setMessage("BAD REQUEST");
                break;

            case self::Unauthorized:
                $this->setMessage("UNAUTHORIZED");
                break;

            case self::Payment_Required:
                $this->setMessage("PAYMENT REQUIRED");
                break;

            case self::Forbidden:
                $this->setMessage("FORBIDDEN");
                break;

            case self::Not_Acceptable:
                $this->setMessage("NOT ACCEPTABLE");
                break;

            case self::Request_Timeout:
                $this->setMessage("REQUEST TIMEOUT");
                break;

            case self::Internal_Server_Error:
                $this->setMessage("INTERNAL SERVER ERROR");
                break;

            case self::Not_Implemented:
                $this->setMessage("NOT IMPLEMENTED");
                break;

            case self::Service_Unavailable:
                $this->setMessage("SERVICE UNAVAILABLE");
                break;
        }
    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    // RESPONSE CODES
    //
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * This interim response indicates that everything so far is OK and that the client should continue the request, or
     * ignore the response if the request is already finished.
     */
    const Continue = 100;

    /**
     * This code indicates that the server has received and is processing the request, but no response is available yet.
     */
    const Processing = 102;

    /**
     * The request has succeeded. The meaning of the success depends on the HTTP method:
     *   GET: The resource has been fetched and is transmitted in the message body.
     *   HEAD: The entity headers are in the message body.
     *   PUT or POST: The resource describing the result of the action is transmitted in the message body.
     *   TRACE: The message body contains the request message as received by the server.
     */
    const OK = 200;

    /**
     * The request has succeeded and a new resource has been created as a result. This is typically the response sent
     * after POST requests, or some PUT requests.
     */
    const Created = 201;

    /**
     * The request has been received but not yet acted upon. It is noncommittal, since there is no way in HTTP to later
     * send an asynchronous response indicating the outcome of the request. It is intended for cases where another process or server handles the request, or for batch processing.
     */
    const Accepted = 202;

    /**
     * There is no content to send for this request, but the headers may be useful. The user-agent may update its cached
     * headers for this resource with the new ones.
     */
    const No_Content = 204;

    /**
     * Tells the user-agent to reset the document which sent this request.

     */
    const Reset_Content = 205;

    /**
     * The server could not understand the request due to invalid syntax.
     */
    const Bad_Request = 400;

    /**
     * Although the HTTP standard specifies "unauthorized", semantically this response means "unauthenticated". That is,
     * the client must authenticate itself to get the requested response.
     */
    const Unauthorized = 401;

    /**
     * This response code is reserved for future use. The initial aim for creating this code was using it for digital
     * payment systems, however this status code is used very rarely and no standard convention exists.
     */
    const Payment_Required = 402;

    /**
     * The client does not have access rights to the content; that is, it is unauthorized, so the server is refusing to
     * give the requested resource. Unlike 401, the client's identity is known to the server.
     */
    const Forbidden = 403;

    /**
     * The server can not find the requested resource. In the browser, this means the URL is not recognized. In an API,
     * this can also mean that the endpoint is valid but the resource itself does not exist. Servers may also send this
     * response instead of 403 to hide the existence of a resource from an unauthorized client. This response code is
     * probably the most famous one due to its frequent occurrence on the web.
     */
    const Not_Found = 404;

    /**
     * This response is sent when the web server, after performing server-driven content negotiation, doesn't find any
     * content that conforms to the criteria given by the user agent.
     */
    const Not_Acceptable = 406;

    /**
     * This response is sent on an idle connection by some servers, even without any previous request by the client.
     * It means that the server would like to shut down this unused connection. This response is used much more since
     * some browsers, like Chrome, Firefox 27+, or IE9, use HTTP pre-connection mechanisms to speed up surfing. Also
     * note that some servers merely shut down the connection without sending this message.
     */
    const Request_Timeout = 408;

    /**
     * The server has encountered a situation it doesn't know how to handle.
     */
    const Internal_Server_Error = 500;

    /**
     * The request method is not supported by the server and cannot be handled. The only methods that servers are
     * required to support (and therefore that must not return this code) are GET and HEAD.
     */
    const Not_Implemented = 501;

    /**
     * The server is not ready to handle the request. Common causes are a server that is down for maintenance or that is
     * overloaded. Note that together with this response, a user-friendly page explaining the problem should be sent.
     * This responses should be used for temporary conditions and the Retry-After: HTTP header should, if possible,
     * contain the estimated time before the recovery of the service. The webmaster must also take care about the
     * caching-related headers that are sent along with this response, as these temporary condition responses should
     * usually not be cached.
     */
    const Service_Unavailable = 503;
}