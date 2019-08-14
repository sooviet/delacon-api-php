<?php
/**
 * Request Class
 *
 * User: Soviet Ligal
 */

namespace Delacon\Remote;

use Delacon\Application;
use Exception;
use GuzzleHttp\Client;

class Request
{
    const METHOD_GET    = 'GET';
    const METHOD_POST   = 'POST';

    const CONTENT_TYPE_XML  = 'text/xml';
    const CONTENT_TYPE_JSON = 'application/json';

    const HEADER_ACCEPT            = 'Accept';
    const HEADER_CONTENT_TYPE      = 'Content-Type';
    const HEADER_CONTENT_LENGTH    = 'Content-Length';
    const HEADER_AUTHORIZATION     = 'Authorization';

    private $app;
    private $client;
    private $url;
    private $method;
    private $headers;

    private $response;

	/**
	 * Request constructor.
	 *
	 * @param Application $app
	 * @param string $method
	 * @throws Exception
	 */
	public function __construct(Application $app, $method = self::METHOD_GET)
    {
        $this->app = $app;
        $this->url = $this->app->getApiUrl();
        $this->headers = $this->app->getApiHeader();

        $this->client = new Client();

        switch ($method) {
            case self::METHOD_GET:
            case self::METHOD_POST:
                $this->method = $method;
                break;
            default:
                throw new Exception("Invalid request method [$method]");
        }

    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->app->getApiUrl();
    }

    /**
     * @return mixed|string
     */
    public function formattedUrl()
    {
        $url = $this->getUrl();

        $params = http_build_query($this->app->getDelaconRequestData());

        return $url . $params;
    }

    /**
     * Send request
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send()
    {
        $result = $this->client->request($this->method, $this->formattedUrl());

        $this->response = $result;
    }

    /**
     * Get response
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}