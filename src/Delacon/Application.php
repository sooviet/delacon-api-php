<?php

namespace Delacon;

use Delacon\Models\DelaconRequest;

abstract class Application
{

    /*
     * Api Basic Report Url
     *
     * */
    const API_METHOD_REPORT_URL = 'https://vxml5.delacon.com.au/site/report/report.jsp';

	/*
     * Api Authentication Url
     *
     * */
    const API_METHOD_AUTHENTICATION_URL = 'https://pla.delaconcorp.com/site/jsp/login.jsp';

    const API_METHOD_REPORT = 'report_url';

    const API_METHOD_AUTHENTICATION = 'api_authentication_url';

    const API_HEADER_AUTHENTICATION = 'Auth';

	/*
	 * Delacon report
	 **/
	protected $authMethod;

	/*
	 * Delacon XML Api Url
	 **/
	protected $apiUrl;

	/*
	 * Delacon XML Api Key
	 **/
	protected $apiKey;

	/*
	 * Delacon XML Api Header
	 **/
	protected $apiHeader;

	/*
	 * Delacon report
	 **/
	protected $request;

	/**
	 * XmlApplication constructor.
	 *
	 * @param DelaconRequest $request
	 * @param string $authMethod
	 * @param null $apiKey
	 */
	public function __construct(DelaconRequest $request, $authMethod = self::API_METHOD_REPORT, $apiKey = null)
	{
		parent::__construct();

		$this->request = $request;
		$this->authMethod = $authMethod;
		$this->apiKey = $apiKey;
	}

	/**
	 * @return mixed
	 */
	public function getAuthMethod()
	{
		return $this->authMethod;
	}

	/**
	 * @return mixed
	 */
	public function getApiUrl()
	{
		return $this->apiUrl;
	}

	/**
	 * @return mixed
	 */
	public function getApiKey()
	{
		return $this->apiKey;
	}

	/**
	 * @return mixed
	 */
	public function getApiHeader()
	{
		return $this->apiHeader;
	}

	/**
	 * Get delacon report's request data
	 *
	 * @return array
	 */
	public function getDelaconRequestData()
	{
		return $this->request->fetchReportData();
	}

	abstract protected function reports();

}
