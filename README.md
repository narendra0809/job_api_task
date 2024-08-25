The Simple Job Board API is a RESTful API built using Laravel that allows users to manage job listings and applications. It includes functionalities for user authentication, job management, and job applications. The API uses Laravel Sanctum for authentication and provides endpoints for creating, updating, deleting, and searching job listings.

Features
User Authentication: Register, log in, and manage user sessions with Laravel Sanctum.
Job Listings: Perform CRUD operations on job listings.
Job Applications: Apply for jobs and view applications.
Search: Search job listings by title or location.
Technologies Used
Laravel: PHP framework used to build the API.
MySQL: Database for storing job and user data.
Laravel Sanctum: API token authentication.
JSON Resources: Data transformation in API responses.
Setup Instructions
Prerequisites
PHP 8.x or higher
Composer
MySQL or compatible database
Installation
Clone the Repository

bash
Copy code
git clone https://github.com/narendra0809/job_api_task.git
cd task_job_api
Install Dependencies

bash
Copy code
composer install
Set Up Environment

Copy the .env.example file to .env:

bash
Copy code
cp .env.example .env
Generate a new application key:

bash
Copy code
php artisan key:generate
Configure the Database

Edit the .env file and set your database connection details:

env
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
Run Migrations

bash
Copy code
php artisan migrate
Seed the Database (Optional)

bash
Copy code
php artisan db:seed
Start the Laravel Development Server

bash
Copy code
php artisan serve
The API will be accessible at http://localhost:8000.

API Endpoints
Authentication
Register

Endpoint: POST /api/register
Request Body:
json
Copy code
{
  "name": "John Doe",
  "email": "john.doe@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
Response:
json
Copy code
{
  "token": "user-access-token"
}
Login

Endpoint: POST /api/login
Request Body:
json
Copy code
{
  "email": "john.doe@example.com",
  "password": "password123"
}
Response:
json
Copy code
{
  "token": "user-access-token"
}
Job Listings
Get All Jobs

Endpoint: GET /api/jobs
Response:
json
Copy code
[
  {
    "id": 1,
    "title": "Software Engineer",
    "description": "Job description here",
    "company": "Tech Corp",
    "location": "New York",
    "salary": 90000,
    "created_at": "2024-08-24T21:07:02",
    "updated_at": "2024-08-24T21:07:02"
  }
]
Create Job

Endpoint: POST /api/jobs
Request Body:
json
Copy code
{
  "title": "Software Engineer",
  "description": "We are looking for a skilled software engineer to join our team.",
  "company": "Tech Corp",
  "location": "New York",
  "salary": 90000
}
Response:
json
Copy code
{
  "id": 1,
  "title": "Software Engineer",
  "description": "We are looking for a skilled software engineer to join our team.",
  "company": "Tech Corp",
  "location": "New York",
  "salary": 90000,
  "created_at": "2024-08-24T21:07:02",
  "updated_at": "2024-08-24T21:07:02"
}
Get Job by ID

Endpoint: GET /api/jobs/{id}
Response:
json
Copy code
{
  "id": 1,
  "title": "Software Engineer",
  "description": "Job description here",
  "company": "Tech Corp",
  "location": "New York",
  "salary": 90000,
  "created_at": "2024-08-24T21:07:02",
  "updated_at": "2024-08-24T21:07:02"
}
Update Job

Endpoint: PUT /api/jobs/{id}
Request Body:
json
Copy code
{
  "title": "Senior Software Engineer",
  "description": "Updated job description",
  "company": "Tech Corp",
  "location": "New York",
  "salary": 100000
}
Response:
json
Copy code
{
  "id": 1,
  "title": "Senior Software Engineer",
  "description": "Updated job description",
  "company": "Tech Corp",
  "location": "New York",
  "salary": 100000,
  "created_at": "2024-08-24T21:07:02",
  "updated_at": "2024-08-25T15:00:00"
}
Delete Job

Endpoint: DELETE /api/jobs/{id}
Response:
json
Copy code
{
  "message": "Job deleted successfully"
}
Search Jobs

Endpoint: GET /api/jobs/search
Query Parameters:
title: Optional, search by job title
location: Optional, search by job location
Response:
json
Copy code
[
  {
    "id": 1,
    "title": "Software Engineer",
    "description": "Job description here",
    "company": "Tech Corp",
    "location": "New York",
    "salary": 90000,
    "created_at": "2024-08-24T21:07:02",
    "updated_at": "2024-08-24T21:07:02"
  }
]
Job Applications
Apply for Job

Endpoint: POST /api/jobs/{job_id}/apply
Request Body:
json
Copy code
{
  "user_id": 1
}
Response:
json
Copy code
{
  "message": "Application submitted successfully"
}
Get Applications for Job

Endpoint: GET /api/jobs/{job_id}/applications
Response:
json
Copy code
[
  {
    "id": 1,
    "user_id": 1,
    "job_id": 1,
    "created_at": "2024-08-24T21:07:02",
    "updated_at": "2024-08-24T21:07:02"
  }
]
Error Handling
Validation Errors: Returns 422 Unprocessable Entity with validation errors if request data is invalid.
Not Found: Returns 404 Not Found if a resource is not found.
Unauthorized: Returns 401 Unauthorized for requests that require authentication but are missing a valid token.
Contributing
To contribute to this project, please fork the repository and submit a pull request with your changes. Include tests for new features or bug fixes.