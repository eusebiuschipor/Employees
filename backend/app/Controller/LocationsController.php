<?php
	class LocationsController extends AppController {
		public $components = array('RequestHandler');

	    // get organization locations
		public function getOrganizationLocations() {
			$queryString = 'SELECT * FROM locations '.
						   'WHERE organizationId = '.$this->request->data['organizationId'].'';

			$locations = $this->Location->query($queryString);
			$this->set('locations', $locations);
	    }
	}
?>