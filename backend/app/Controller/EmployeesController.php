<?php
	class EmployeesController extends AppController {
		public $components = array('RequestHandler');

		// get all employees list
		public function index() {
			$queryString = 	'SELECT employees.id, employees.name, employees.email, employees.address, jobs.title FROM employees '.
						   	'INNER JOIN jobs ON employees.job_title = jobs.id ';

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

	    public function delete() {
			if ($this->Employee->delete($this->request->data['id'])) {
	            $message = _Global::$httpOk;
	        } else {
	            $message = _Global::$httpBadRequest;
	        }

			$this->set('message', $message);
		}

		// view details about one employee
	    public function view($id = null) {
	    	if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

			$queryString = 	'SELECT employees.id, employees.name, employees.email, employees.address, jobs.title FROM employees '.
						   	'INNER JOIN jobs ON employees.job_title = jobs.id '.
						   	'WHERE employees.id = '.$id.' ';

			$employee = $this->Employee->query($queryString);

			if (!$employee) {
	            throw new NotFoundException(__('Invalid item'));
	        }

			$this->set('employee', $employee);
	    }
	}
?>