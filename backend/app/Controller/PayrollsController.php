<?php
	class PayrollsController extends AppController {
		public $components = array('RequestHandler');

	    // add a new brand
	    public function add() {
	    	$employee = $this->request->data['employee'];
	    	$workedDays = $this->request->data['worked_days'];
	    	$totalDays = $this->request->data['total_days'];

	    	$this->Payroll->create();

	    	$queryEmployeeSalary = 'SELECT salary FROM people WHERE people.id = '.$employee.'';
	    
	        $employeeSalary = $this->Payroll->query($queryEmployeeSalary);

	    	if ($workedDays) {
	    		$totalPayroll = $workedDays * $employeeSalary[0]['people']['salary']  / $totalDays;;
	    		$this->request->data['total_payroll'] = $totalPayroll;
	    	} else {
	    		$this->request->data['total_payroll'] = $employeeSalary[0]['people']['salary'];
	    	}

			if ($this->Payroll->save($this->request->data)) {
	            $message = _Global::$httpOk;
	        } else {
	            $message = _Global::$httpBadRequest;
	        }
	    }

	    // view details about one payroll
	    public function view($id = null) {
			if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT * FROM payrolls WHERE employee = '.$id.'';

	        $payroll = $this->Payroll->query($queryString);

	        if (!$payroll) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $this->set('payroll', $payroll);
	    }

	    // view details about one payroll
	    public function viewPayroll($id = null) {
			if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT * FROM payrolls WHERE id = '.$id.'';

	        $payroll = $this->Payroll->query($queryString);

	        if (!$payroll) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $this->set('payroll', $payroll);
	    }

	    public function delete() {
			if ($this->Payroll->delete($this->request->data['id'])) {
	            $message = _Global::$httpOk;
	        } else {
	            $message = _Global::$httpBadRequest;
	        }

			$this->set('message', $message);
		}
	}
?>