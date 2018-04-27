<?php
/**
 * Created by PhpStorm.
 * User: localservice2
 * Date: 27/04/18
 * Time: 10:35 AM
 */

namespace App\Lib\Delacon\Remote;

use App\Lib\Delacon\Application;
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
    private $url;
    private $method;
    private $headers;
    private $parameters;
    private $body;

    private $response;

    public function __construct(Application $app, $url, $method = self::METHOD_GET)
    {
        $this->app = $app;
        $this->url = $url;
        $this->parameters = [];

        switch ($method) {
            case self::METHOD_GET:
            case self::METHOD_POST:
                $this->method = $method;
                break;
            default:
                throw new Exception("Invalid request method [$method]");
        }

        $delaconConfig = $this->app->getConfig()['delacon'];

        if (isset($delaconConfig['params'])) {
            $this->setParameter('params', $delaconConfig['params']);
        }

    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return Application
     */
    public function getApp(): Application
    {
        return $this->app;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return mixed|string
     */
    public function formattedUrl()
    {
        $url = $this->getUrl();
        $config = $this->app->getConfig()['delacon'];

        $url .= '?userid=' . $config['user_id'];
        $url .= '&password=' . $config['password'];

        $parameters = $this->getParameters()['params'];

        foreach ($parameters as $paramKey => $paramValue) {
            $url .= '&' . $paramKey . '=' . $paramValue;
        }

        return $url;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send()
    {
        $result = $this->app->getClient()->request($this->getMethod(), $this->formattedUrl());

        $this->response = $result;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}