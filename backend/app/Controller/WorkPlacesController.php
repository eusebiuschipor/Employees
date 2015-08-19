<?php
	class WorkPlacesController extends AppController {
		public $components = array('RequestHandler');

	    // get organization locations
		public function getOrganizationWorkPlaces() {
			$queryString = 'SELECT * FROM work_places '.
						   'WHERE organizationId = '.$this->request->data['organizationId'].'';

			$workPlaces = $this->WorkPlace->query($queryString);
			$this->set('workPlaces', $workPlaces);
	    }
	}
?>