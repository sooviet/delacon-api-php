<?php

namespace Delacon\Application;

use Delacon\Application;
use Delacon\Remote\Request;

class XmlApplication extends Application
{

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
				throw new \Exception("Invalid auth method.");
		}
    }

	/**
	 * Validate Auth Method
	 *
	 * @return bool
	 * @throws \Exception
	 */
	private function validateAuthMethod()
	{
		if (!$this->apiKey) {
			throw new \Exception("Required API Key is missing");
		}

		return true;
    }

	/**
	 * Validate Report Method
	 *
	 * @return bool
	 * @throws \Exception
	 */
	private function validateReportMethod()
	{
		if (!$this->request->getUserId() || !$this->request->getPassword()) {
			throw new \Exception("Required Parameter(s) UserID or Password is missing");
		}

		return true;
	}

	/**
	 * Retrieve call tracking report
	 *
	 */
	public function reports()
	{
		try {
			$this->prepareReport();

			$request = new Request($this);

			$request->send();

			return $request->getResponse();

		} catch(\Exception $e) {
			return ['code' => $e->getCode(), 'message' => $e->getMessage()];
		}
	}

}