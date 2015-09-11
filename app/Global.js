function Global() { }

// HOST:
Global.host = 'http://localhost/Employees/';

// TEMPLATES:
Global.templatesUrl = 'templates/';

// MODULES:
Global.viewsUrl = 'app/Views/';

// SCRIPTS:
Global.scripts = 'scripts/';

// BACKEND:
Global.backend = 'backend/';

// Employees Module
Global.getAllEmployees = Global.host + Global.backend + 'employees/';
Global.addEmployee = Global.host + Global.backend + 'employees/register/';
Global.getEmployeeInformations = Global.host + Global.backend + 'employees/edit/';
Global.deleteEmployee = Global.host + Global.backend + 'employees/delete/';
Global.getEmployeeDescription = Global.host + Global.backend + 'employees/view/';
Global.employeeImageSrc = 'assets/images/default.png';

// Jobs Module
Global.getAllJobs = Global.host + Global.backend + 'jobs/';

// Upload files
Global.uploadPeoplePhoto = Global.host + Global.scripts + 'upload-people-photo.php';

// HTTP status codes
Global.httpUnauthorized = 401;
Global.httpOk = 200;

// Routes
Global.pageNotFound = '/employees';
