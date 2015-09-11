<?php
	class PeoplesController extends AppController {
		public $components = array('RequestHandler');

		// get all people list
		public function index() {
			$queryString = 'SELECT people.id, people.first_name, people.last_name, people.photo, people.country, people.department, people.brand, jobs.title FROM people '.
						   'INNER JOIN jobs ON people.jobTitle = jobs.id '.
						   'WHERE people.organizationId = '.$this->request->data['organizationId'].' '.
						   'LIMIT '.$this->request->data['limit'].' OFFSET '.$this->request->data['offset'].'';

			$peoples = $this->People->query($queryString);
			$this->set('peoples', $peoples);
	    }

	    public function getPeopleBrand($id = null) {
	    	if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT brands.name FROM people INNER JOIN brands ON people.brand = brands.id WHERE people.id = '.$id.'';
	    
	        $brand = $this->People->query($queryString);

	        if (!$brand) {
	            $brand[0]['brands']['name'] = '';
	        }

	        $this->set(array(
	            'brand' => $brand,
	            '_serialize' => array('brand')
	        ));
	    }

	    public function getPeopleCountry($id = null) {
	    	if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT countries.name FROM people INNER JOIN countries ON people.country = countries.id WHERE people.id = '.$id.'';
	    
	        $country = $this->People->query($queryString);

	        if (!$country) {
	            $country[0]['countries']['name'] = '';
	        }

	        $this->set(array(
	            'country' => $country,
	            '_serialize' => array('country')
	        ));
	    }

	    public function getPeopleDepartment($id = null) {
	    	if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT departments.name FROM people INNER JOIN departments ON people.department = departments.id WHERE people.id = '.$id.'';
	    
	        $department = $this->People->query($queryString);

	        if (!$department) {
	            $department[0]['departments']['name'] = '';
	        }

	        $this->set(array(
	            'department' => $department,
	            '_serialize' => array('department')
	        ));
	    }

	    public function getPeopleLocation($id = null) {
	    	if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT locations.name FROM people INNER JOIN locations ON people.location = locations.id WHERE people.id = '.$id.'';
	    
	        $location = $this->People->query($queryString);

	        if (!$location) {
	            $location[0]['locations']['name'] = '';
	        }

	        $this->set(array(
	            'location' => $location,
	            '_serialize' => array('location')
	        ));
	    }

	    public function getPeopleWorkTimes($id = null) {
	    	if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT work_times.interval FROM people INNER JOIN work_times ON people.work_time = work_times.id WHERE people.id = '.$id.'';
	    
	        $workTime = $this->People->query($queryString);

	        if (!$workTime) {
	            $workTime[0]['work_times']['interval'] = '';
	        }

	        $this->set(array(
	            'workTime' => $workTime,
	            '_serialize' => array('workTime')
	        ));
	    }

	    public function getPeopleWorkPlace($id = null) {
	    	if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT work_places.name FROM people INNER JOIN work_places ON people.working_place = work_places.id WHERE people.id = '.$id.'';
	    
	        $workPlace = $this->People->query($queryString);

	        if (!$workPlace) {
	            $workPlace[0]['work_places']['name'] = '';
	        }

	        $this->set(array(
	            'workPlace' => $workPlace,
	            '_serialize' => array('workPlace')
	        ));
	    }

	    public function getPeopleMaritalStatus($id = null) {
	    	if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT marital_statuses.name FROM people INNER JOIN marital_statuses ON people.marital_status = marital_statuses.id WHERE people.id = '.$id.'';
	    
	        $maritalStatus = $this->People->query($queryString);

	        if (!$maritalStatus) {
	            $maritalStatus[0]['marital_statuses']['name'] = '';
	        }

	        $this->set(array(
	            'maritalStatus' => $maritalStatus,
	            '_serialize' => array('maritalStatus')
	        ));
	    }

	    public function getPeopleTeam($id = null) {
	    	if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT teams.name FROM people INNER JOIN teams ON people.team_id = teams.id WHERE people.id = '.$id.'';
	    
	        $team = $this->People->query($queryString);

	        if (!$team) {
	            $team[0]['teams']['name'] = '';
	        }

	        $this->set(array(
	            'team' => $team,
	            '_serialize' => array('team')
	        ));
	    }

	    public function getPeopleBloodGroup($id = null) {
	    	if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT blood_group.name FROM people INNER JOIN blood_group ON people.blood_group = blood_group.id WHERE people.id = '.$id.'';
	    
	        $bloodGroup = $this->People->query($queryString);

	        if (!$bloodGroup) {
	            $bloodGroup[0]['blood_group']['name'] = '';
	        }

	        $this->set(array(
	            'bloodGroup' => $bloodGroup,
	            '_serialize' => array('bloodGroup')
	        ));
	    }

	    public function getPeopleGender($id = null) {
	    	if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT gender.name FROM people INNER JOIN gender ON people.gender = gender.id WHERE people.id = '.$id.'';
	    
	        $gender = $this->People->query($queryString);

	        if (!$gender) {
	            $gender[0]['gender']['name'] = '';
	        }

	        $this->set(array(
	            'gender' => $gender,
	            '_serialize' => array('gender')
	        ));
	    }

	    // view details about one people
	    public function view($id = null) {
			if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT people.first_name, people.last_name, people.photo, people.username, people.email, people.address, people.birthday, people.location, '.
	        			   'people.telephone, people.work_time, people.mentor, people.hobbies, people.education, '.
	        			   'people.birthday, people.team_id, people.blood_group, people.alternate_email, people.partner_birthday, '.
	        			   'people.maiden_name, people.partner, people.gender, people.nickname, people.join_date, '.
	        			   'jobs.title '.
	        			   'FROM people '.
	        			   'INNER JOIN jobs ON people.jobTitle = jobs.id '.
	        			   'WHERE people.id = '.$id.'';

	        $people = $this->People->query($queryString);

	        if (!$people) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $this->set('people', $people);
	    }

	    public function getPeopleNameById($id = null) {
	    	if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT first_name, last_name FROM people WHERE id = '.$id.';';

	        $people = $this->People->query($queryString);

	        if (!$people) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $this->set('people', $people);
	    }

	    public function getPeopleFromASpecificTeam() {
	    	$queryString = 'SELECT people.id, people.first_name, people.last_name, people.photo, people.country, people.department, people.brand, jobs.title FROM people '.
						   'INNER JOIN jobs ON people.jobTitle = jobs.id '.
						   'WHERE people.organizationId = '.$this->request->data['organizationId'].' AND people.team_id = '.$this->request->data['teamId'].'';

			$peoples = $this->People->query($queryString);
			$this->set('peoples', $peoples);
	    }

	    // get information for a specific people, for editing
	    public function edit($id = null) {
			if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT * FROM people WHERE people.id = '.$id.'';

	        $people = $this->People->query($queryString);

	        if (!$people) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $this->set('people', $people);
	    }

	    // add a new people 
	    public function register() {
	    	$this->People->create();

	    	if ($this->request->data['password']) {
				$this->request->data['password'] = md5($this->request->data['password']);
	    	}

			if ($this->People->save($this->request->data)) {
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

			$conditions = array(
    			'People.email' => $email,
    			'People.password' => $password
			);

			if ($this->People->hasAny($conditions)) {
				$people = $this->People->query('SELECT id, organizationId, team_id FROM people WHERE email="'.$email.'";');
				
				$message = array(
					'token' => _Global::$token,
					'id' => $people[0]['people']['id'],
					'organizationId' => $people[0]['people']['organizationId'],
					'teamId' => $people[0]['people']['team_id']
				); 
			} else {
				$message = _Global::$httpUnauthorized;
			}

			$this->set('message', $message);
		}

		public function delete() {
			if ($this->People->delete($this->request->data['id'])) {
	            $message = _Global::$httpOk;
	        } else {
	            $message = _Global::$httpBadRequest;
	        }

			$this->set('message', $message);
		}

		public function changePassword() {
			$email = $this->request->data['email'];
	    	$oldPassword = md5($this->request->data['oldPassword']);
	    	$conditions = null;
	    	$saveObject = array();
	    	$message = null;
	    	$saveObject['password'] = md5($this->request->data['newPassword']);
    		$saveObject['id'] = $this->request->data['peopleId'];

	    	$conditions = array(
    			'People.email' => $email,
    			'People.password' => $oldPassword
			);

			if ($this->People->hasAny($conditions)) {
	    		if ($this->People->save($saveObject)) {
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

		public function getHolidayDaysInformations($id = null) {
			if (!$id) {
	            throw new NotFoundException(__('Invalid item'));
	        }

	        $queryString = 'SELECT people.holiday_year_days, people.available_holiday_days FROM people WHERE people.id = '.$id.'';
	    
	        $holiday = $this->People->query($queryString);

	        $this->set(array(
	            'holiday' => $holiday,
	            '_serialize' => array('holiday')
	        ));
		}
	}
?>