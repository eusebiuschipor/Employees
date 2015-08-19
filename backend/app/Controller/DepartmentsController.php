<?php
	class DepartmentsController extends AppController {
		public $components = array('RequestHandler');

		// get all departments list
		public function index() {
			$departments = $this->Department->find('all');
			$this->set('departments', $departments);
	    }

	    // get organization jobs
		public function getOrganizationDepartments() {
			$queryString = 'SELECT id, name FROM departments '.
						   'WHERE organizationId = '.$this->request->data['organizationId'].'';

			$departments = $this->Department->query($queryString);
			$this->set('departments', $departments);
	    }

	    // add a new job
	    public function add() {
	    	$this->Department->create();

			if ($this->Department->save($this->request->data)) {
	            $message = _Global::$httpOk;
	        } else {
	            $message = _Global::$httpBadRequest;
	        }

	        $this->set(array(
	            'message' => $message,
	            '_serialize' => array('message')
	        ));
	    }

	    public function delete() {
			if ($this->Department->delete($this->request->data['id'])) {
	            $message = _Global::$httpOk;
	        } else {
	            $message = _Global::$httpBadRequest;
	        }

			$this->set('message', $message);
		}

		// view details about one department
	    public function view($id = null) {
			if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT name '.
	        			   'FROM departments '.
	        			   'WHERE id = '.$id.'';

	        $department = $this->Department->query($queryString);

	        if (!$department) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $this->set('department', $department);
	    }
	}
?>