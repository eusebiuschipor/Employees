<?php
	class WorkTimesController extends AppController {
		public $components = array('RequestHandler');

	    // get organization locations
		public function getOrganizationWorkTimes() {
			$queryString = 'SELECT * FROM work_times '.
						   'WHERE organizationId = '.$this->request->data['organizationId'].'';

			$workTimes = $this->WorkTime->query($queryString);
			$this->set('workTimes', $workTimes);
	    }
	}
?>