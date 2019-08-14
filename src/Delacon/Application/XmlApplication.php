<?php

namespace Delacon\Application;

use Delacon\Application;
use Delacon\Remote\Request;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class XmlApplication extends Application
{

	/*
	 * JSON Response
	 **/
	const RESPONSE_JSON = 'json';

	/*
	 * XML Response
	 **/
	const RESPONSE_XML = 'xml';

	/**
	 * Prepare Report
	 *
	 */
	private function prepareReport()
	{
		switch ($this->authMethod) {
			case parent::API_METHOD_AUTHENTICATION:
				$this->validateAuthMethod();

				$this->apiUrl = parent::API_METHOD_AUTHENTICATION_URL;
				$this->apiHeader = [
						parent::API_HEADER_AUTHENTICATION => $this->apiKey
				];
				break;

			case parent::API_METHOD_REPORT:
				$this->validateReportMethod();

				$this->apiUrl = parent::API_METHOD_REPORT_URL;

				break;

			default:
				throw new Exception("Invalid auth method.");
		}
    }

	/**
	 * Validate Auth Method
	 *
	 * @return bool
	 * @throws Exception
	 */
	private function validateAuthMethod()
	{
		if (!$this->apiKey) {
			throw new Exception("Required API Key is missing");
		}

		return true;
    }

	/**
	 * Validate Report Method
	 *
	 * @return bool
	 * @throws Exception
	 */
	private function validateReportMethod()
	{
		if (!$this->request->getUserId() || !$this->request->getPassword()) {
			throw new Exception("Required Parameter(s) UserID or Password is missing");
		}

		return true;
	}

	/**
	 * Response of the report
	 *
	 * @param $request
	 * @param $responseType
	 * @return mixed
	 * @throws Exception
	 */
	private function response($request, $responseType)
	{
		if ($responseType === self::RESPONSE_JSON)
			return $request->getJsonResponse();

		else if ($responseType === self::RESPONSE_XML)
			return $request->getResponse();

		else
			throw new Exception("Invalid response type");
	}

	/**
	 * Retrieve call tracking report
	 *
	 * @param string $responseType
	 * @return false|string
	 * @throws GuzzleException
	 * @throws Exception
	 */
	public function reports($responseType = 'json')
	{
		try {
			$this->prepareReport();

			$request = new Request($this);

			$request->send(); //send Api request

			return $this->response($request, $responseType);

		} catch(Exception $e) {

			throw new Exception($e->getMessage());
		}
	}

}