<?php
	class DocumentsController extends AppController {
		public $components = array('RequestHandler');

		// get all documents list
		public function index() {
			$documents = $this->Document->find('all');
			$this->set('documents', $documents);
	    }

		// add a new document
	    public function add() {
	    	$this->Document->create();

			if ($this->Document->save($this->request->data)) {
	            $message = _Global::$httpOk;
	        } else {
	            $message = _Global::$httpBadRequest;
	        }

	        $this->set(array(
	            'message' => $message,
	            '_serialize' => array('message')
	        ));
	    }

	    // view details about one people
	    public function view($id = null) {
			if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT title FROM documents '.
	        			   'WHERE documents.id = '.$id.'';

	        $document = $this->Document->query($queryString);

	        if (!$document) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $this->set('document', $document);
	    }

	    public function delete() {
			if ($this->Document->delete($this->request->data['id'])) {
	            $message = _Global::$httpOk;
	        } else {
	            $message = _Global::$httpBadRequest;
	        }

			$this->set('message', $message);
		}

		// get organization documents
		public function getOrganizationDocuments() {
			$queryString = 'SELECT id, title FROM documents '.
						   'WHERE organizationId = '.$this->request->data['organizationId'].'';

			$documents = $this->Document->query($queryString);
			$this->set('documents', $documents);
	    }

	    // get document content
	    public function getDocumentContent($id = null) {
			if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT content FROM documents '.
	        			   'WHERE id = '.$id.'';

	        $content = $this->Document->query($queryString);

	        if (!$content) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $this->set('content', $content[0]['documents']['content']);
	    }
	}
?>