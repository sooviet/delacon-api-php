<?php

	namespace Delacon\Models;


	class DelaconRequest
	{
		const REPORT_DATE_FROM = 'dateFrom';

		const REPORT_PASSWORD = 'password';

		const REPORT_DATE_TO = 'dateTo';

		const REPORT_USER_ID = 'userId';

		const REPORT_REPORT_OPTION = 'reportOption';

		const REPORT_SHOW_RECURL = 'showrecurl';

		const REPORT_SHOW_CITY = 'showCity';

		const REPORT_IS_CALL_RECORDING_MESSAGE_COMPLETED = 'isCallRecordingMessageCompleted';

		const REPORT_REPORT_TYPE = 'reporttype';

		const REPORT_SHOW_STATE = 'showstate';

		private $userId;

		private $password;

		private $dateFrom;

		private $dateTo;

		private $reportOption;

		private $showrecurl;

		private $showCity;

		private $isCallRecordingMessageCompleted;

		private $reporttype;

		private $showstate;


		/**
		 * @return mixed
		 */
		public function getUserId()
		{
			return $this->userId;
		}

		/**
		 * @param mixed $userId
		 */
		public function setUserId($userId)
		{
			$this->userId = $userId;
		}

		/**
		 * @return mixed
		 */
		public function getPassword()
		{
			return $this->password;
		}

		/**
		 * @param mixed $password
		 */
		public function setPassword($password)
		{
			$this->password = $password;
		}

		/**
		 * @return mixed
		 */
		public function getDateFrom()
		{
			return $this->dateFrom;
		}

		/**
		 * @param mixed $dateFrom
		 */
		public function setDateFrom($dateFrom)
		{
			$this->dateFrom = $dateFrom;
		}

		/**
		 * @return mixed
		 */
		public function getDateTo()
		{
			return $this->dateTo;
		}

		/**
		 * @param mixed $dateTo
		 */
		public function setDateTo($dateTo)
		{
			$this->dateTo = $dateTo;
		}

		/**
		 * @return mixed
		 */
		public function getReportOption()
		{
			return $this->reportOption;
		}

		/**
		 * @param mixed $reportOption
		 */
		public function setReportOption($reportOption)
		{
			$this->reportOption = $reportOption;
		}

		/**
		 * @return mixed
		 */
		public function getShowrecurl()
		{
			return $this->showrecurl;
		}

		/**
		 * @param mixed $showrecurl
		 */
		public function setShowrecurl($showrecurl)
		{
			$this->showrecurl = $showrecurl;
		}

		/**
		 * @return mixed
		 */
		public function getShowCity()
		{
			return $this->showCity;
		}

		/**
		 * @param mixed $showCity
		 */
		public function setShowCity($showCity)
		{
			$this->showCity = $showCity;
		}

		/**
		 * @return mixed
		 */
		public function getIsCallRecordingMessageCompleted()
		{
			return $this->isCallRecordingMessageCompleted;
		}

		/**
		 * @param mixed $isCallRecordingMessageCompleted
		 */
		public function setIsCallRecordingMessageCompleted($isCallRecordingMessageCompleted)
		{
			$this->isCallRecordingMessageCompleted = $isCallRecordingMessageCompleted;
		}

		/**
		 * @return mixed
		 */
		public function getReporttype()
		{
			return $this->reporttype;
		}

		/**
		 * @param mixed $reporttype
		 */
		public function setReporttype($reporttype)
		{
			$this->reporttype = $reporttype;
		}

		/**
		 * @return mixed
		 */
		public function getShowstate()
		{
			return $this->showstate;
		}

		/**
		 * @param mixed $showstate
		 */
		public function setShowstate($showstate)
		{
			$this->showstate = $showstate;
		}

		/**
		 * Fetches report data
		 *
		 * @return array
		 */
		public function fetchReportData()
		{
			return [
				self::REPORT_DATE_FROM => $this->getDateFrom(),

				self::REPORT_DATE_TO => $this->getDateTo(),

				self::REPORT_IS_CALL_RECORDING_MESSAGE_COMPLETED => $this->getIsCallRecordingMessageCompleted(),

				self::REPORT_PASSWORD => $this->getPassword(),

				self::REPORT_REPORT_OPTION => $this->getReportOption(),

				self::REPORT_SHOW_CITY => $this->getShowCity(),

				self::REPORT_SHOW_STATE => $this->getShowstate(),

				self::REPORT_REPORT_TYPE => $this->getReporttype(),
			];
		}

	}