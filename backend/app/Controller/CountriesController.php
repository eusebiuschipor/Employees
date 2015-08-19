<?php
	class CountriesController extends AppController {
		public $components = array('RequestHandler');

		// get all jobs list
		public function index() {
			$countries = $this->Country->find('all');
			$this->set("countries", $countries);
	    }
	}
?>