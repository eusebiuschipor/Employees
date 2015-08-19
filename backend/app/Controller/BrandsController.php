<?php
	class BrandsController extends AppController {
		public $components = array('RequestHandler');

		// get all brands from a specific organization
		public function index() {
			$brands = $this->Brand->find('all');
			$this->set('brands', $brands);
	    }

	    // get organization brands
		public function getOrganizationBrands() {
			$queryString = 'SELECT id, name FROM brands '.
						   'WHERE organizationId = '.$this->request->data['organizationId'].'';

			$brands = $this->Brand->query($queryString);
			$this->set('brands', $brands);
	    }

	    // add a new brand
	    public function add() {
	    	$this->Brand->create();

			if ($this->Brand->save($this->request->data)) {
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
			if ($this->Brand->delete($this->request->data['id'])) {
	            $message = _Global::$httpOk;
	        } else {
	            $message = _Global::$httpBadRequest;
	        }

			$this->set('message', $message);
		}

		// view details about one brand
	    public function view($id = null) {
			if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT name '.
	        			   'FROM brands '.
	        			   'WHERE id = '.$id.'';

	        $brand = $this->Brand->query($queryString);

	        if (!$brand) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $this->set('brand', $brand);
	    }
	}
?>