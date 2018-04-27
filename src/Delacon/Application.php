<?php

namespace App\Lib\Delacon;

use App\Lib\Delacon\Remote\Request;
use Exception;
use GuzzleHttp\Client;

abstract class Application
{
    private $client;

    protected static $_defaultConfig = [
        'delacon' => [
            'user_id' => 'abc123',
            'password' => 'pass123',
            'url' => 'https://vxml5.delacon.com.au/site/report/report.jsp',
            'method' => 'GET',
            'params' => [
                'datefrom' => '',
                'dateto' => '',
                'reportoption' => 'xml'
            ]
        ],
    ];

    protected $config;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(array $userConfig)
    {
        $this->setConfig($userConfig);
        $this->client = new Client();
    }

    /**
     * @param $config
     * @return array
     */
    public function setConfig($config)
    {
        $this->config = array_replace_recursive(
            self:: $_defaultConfig,
            $config
        );

        return $this->config;
    }

    /**
     * @return array
     */
    public static function getDefaultConfig(): array
    {
        return self:: $_defaultConfig;
    }

    /**
     * Retrieve call tracking report
     *
     */
    public function retrieveReports()
    {
        try {
            $request = new Request($this, $this->getConfig()['delacon']['url'], Request::METHOD_GET);

            $request->send();

            return $request->getResponse();

        } catch(\Exception $e) {
            return response()->json(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }

    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

}
