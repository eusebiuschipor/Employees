<?php
	class EmployeesController extends AppController {
		public $components = array('RequestHandler');

		// get all employees list
		public function index() {
			$queryString = 'SELECT * FROM employees';

			$employees = $this->Employee->query($queryString);
			$this->set('employees', $employees);
	    }

	    // add a new people 
	    public function register() {
	    	$this->Employee->create();

	    	if ($this->request->data['password']) {
				$this->request->data['password'] = md5($this->request->data['password']);
	    	}

			if ($this->Employee->save($this->request->data)) {
	            $message = _Global::$httpOk;
	        } else {
	            $message = _Global::$httpBadRequest;
	        }

	        $this->set(array(
	            'message' => $message,
	            '_serialize' => array('message')
	        ));
	    }

	    // get information for a specific people, for editing
	    public function edit($id = null) {
			if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT * FROM employees WHERE employees.id = '.$id.'';
	        $employee = $this->Employee->query($queryString);

	        if (!$employee) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $this->set('employee', $employee);
	    }
	}
?>