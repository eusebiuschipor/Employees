function Global() { }

// HOST:
Global.host = 'http://localhost/AngularJS/';

// TEMPLATES:
Global.templatesUrl = 'templates/';

// MODULES:
Global.viewsUrl = 'app/View/';

// SCRIPTS:
Global.scripts = 'scripts/';

// BACKEND:
Global.backend = 'backend/';

// Employees Module
Global.getAllEmployees = Global.host + Global.backend + 'employees/';
Global.addEmployee = Global.host + Global.backend + 'employees/register/';
Global.getEmployeeInformations = Global.host + Global.backend + 'employees/edit/';

// Jobs Module
Global.getAllJobs = Global.host + Global.backend + 'jobs/';

// Upload files
Global.uploadPeoplePhoto = Global.host + Global.scripts + 'upload-people-photo.php';

// HTTP status codes
Global.httpUnauthorized = 401;
Global.httpOk = 200;

// Routes
Global.pageNotFound = '/404';
