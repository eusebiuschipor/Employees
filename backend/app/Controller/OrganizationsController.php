<?php
	class OrganizationsController extends AppController {
		public $components = array('RequestHandler');

		// add a new organizations 
	    public function register() {
	    	$this->Organization->create();

			$this->request->data['password'] = md5($this->request->data['password']);

			if ($this->Organization->save($this->request->data)) {
	            $message = _Global::$httpOk;
	        } else {
	            $message = _Global::$httpBadRequest;
	        }

	        $this->set(array(
	            'message' => $message,
	            '_serialize' => array('message')
	        ));
	    }

	    public function login() {
	    	$email = $this->request->data['email'];
	    	$password = md5($this->request->data['password']);

	    	// $email = 'evermanage@yahoo.com';
	    	// $password = md5('md97jn');

			$conditions = array(
    			'Organization.email' => $email,
    			'Organization.password' => $password
			);

			if ($this->Organization->hasAny($conditions)) {
				$organizationId = $this->Organization->query('SELECT id FROM organizations WHERE email="'.$email.'";');

				$message = array(
								'token' => _Global::$token,
								'organizationId' => $organizationId
							); 
			} else {
				$message = _Global::$httpUnauthorized;
			}

			$this->set(compact('message'));
		}

		public function changePassword() {
			// $this->request->data['email'] = 'evermanage2@yahoo.com';
			// $this->request->data['oldPassword'] = 'qwe';
			// $this->request->data['newPassword'] = 'zxc';
			// $this->request->data['organizationId'] = 1;

			$email = $this->request->data['email'];
	    	$oldPassword = md5($this->request->data['oldPassword']);
	    	$conditions = null;
	    	$saveObject = array();
	    	$message = null;
	    	$saveObject['password'] = md5($this->request->data['newPassword']);
    		$saveObject['id'] = $this->request->data['organizationId'];

	    	$conditions = array(
    			'Organization.email' => $email,
    			'Organization.password' => $oldPassword
			);

			if ($this->Organization->hasAny($conditions)) {
	    		if ($this->Organization->save($saveObject)) {
	            	$message = _Global::$httpOk;
		        } else {
		            $message = _Global::$httpBadRequest;
		        }
	    	} else {
	    		$message = _Global::$httpUnauthorized;
	    	}

	    	$this->set(array(
	            'message' => $message,
	            '_serialize' => array('message')
	        ));
		}
	}
?>