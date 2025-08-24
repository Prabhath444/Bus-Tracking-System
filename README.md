==========----------------------------------------   GPS Bus Tracking System - Laravel API ----------------------------------------===========

This repository contains the source code for the RESTful backend API of the SLGPS Bus Tracking System. This powerful and secure API is built with Laravel and is designed to serve a decoupled frontend application, such as a React SPA.
The API provides a complete solution for managing a fleet of buses, drivers, routes, and schedules, and includes real-time GPS location tracking with automated alert generation.


✨ Key Features
•	Secure Authentication: Token-based authentication for users powered by Laravel Sanctum.
•	Role-Based Access Control (RBAC): Utilizes Laravel Gates to ensure that only users with appropriate roles (e.g., 'Admin', 'Manager') can perform sensitive actions.
•	Full CRUD Functionality: Comprehensive, secure endpoints for managing all core resources: Users, Buses, Drivers, Routes, and Schedules.
•	Real-Time GPS Tracking: A dedicated endpoint to receive live location pings from GPS devices and endpoints to provide the latest location data for a live map.
•	Automated Alerting: The system automatically generates "Overspeed" alerts when a bus reports a speed exceeding a configurable limit.
•	Device Authentication: A custom middleware provides secure authentication for IoT/GPS devices using a static API key.
•	Dashboard Analytics: A single endpoint to retrieve high-level statistics for the admin dashboard.
•	Optimized Responses: Uses Laravel API Resources to transform and format all JSON responses, ensuring a clean and consistent data structure for the frontend.


🛠️ Tech Stack
•	Backend Framework: Laravel 12
•	Language: PHP 8.2+
•	Database: MySQL
•	Authentication: Laravel Sanctum

🔌 API Endpoints


All endpoints are prefixed with `/api`.

| Method       | Endpoint                        | Description                                           | Authentication | Authorization       |
|--------------|---------------------------------|-------------------------------------------------------|----------------|---------------------|
| POST         | /login                          | Authenticates a user and returns a bearer token.      | Public         | N/A                 |
| POST         | /logout                         | Revokes the user's current token.                     | Sanctum Token  | Authenticated User  |
| GET          | /user                           | Returns the currently authenticated user's details.   | Sanctum Token  | Authenticated User  |
| apiResource  | /buses                          | Full CRUD for managing buses.                         | Sanctum Token  | Admin/Manager       |
| apiResource  | /drivers                        | Full CRUD for managing drivers.                       | Sanctum Token  | Admin/Manager       |
| apiResource  | /routes                         | Full CRUD for managing routes.                        | Sanctum Token  | Admin/Manager       |
| apiResource  | /schedules                      | Full CRUD for managing schedules.                     | Sanctum Token  | Admin/Manager       |
| apiResource  | /users                          | Full CRUD for managing users.                         | Sanctum Token  | Admin Only          |
| POST         | /location/ping                  | Receives a GPS location ping from a device.           | X-API-KEY      | Trusted Device      |
| GET          | /location/latest                | Gets the latest location for all buses.               | Sanctum Token  | Authenticated User  |
| GET          | /buses/{id}/location/latest     | Gets the latest location for a single bus.            | Sanctum Token  | Authenticated User  |
| GET          | /alerts                         | Lists all system-generated alerts.                    | Sanctum Token  | Admin/Manager       |
| GET          | /dashboard                      | Retrieves statistics for the main dashboard.          | Sanctum Token  | Admin/Manager       |
| GET          | /schedule-options               | Gets lists of buses, drivers, and routes for forms.   | Sanctum Token  | Admin/Manager       |


Frontend Integration

This API is designed to be consumed by a Single Page Application (SPA). The recommended frontend is a React application that uses the following architecture:
•	API Client: Axios is used for all HTTP requests. A central apiClient instance is configured with the base URL of the API.
•	Authentication Flow:
    1.	The React app sends user credentials to the /api/login endpoint.
    2.	Upon success, the received Bearer Token is stored in the browser's localStorage for session persistence.
    3.	The central apiClient instance is dynamically configured to include the Authorization: Bearer <token> header on all subsequent requests.
•	State Management: A global React Context (AuthContext) manages the user's authentication state (user, token, loading), making it accessible to all components.
•	Protected Routes: react-router-dom is used for routing. A custom ProtectedRoute component wraps all sensitive pages, automatically redirecting unauthenticated users to the     sign-in page.

🚀 Local Setup and Installation

To get the project running on a local development machine, follow these steps:
1. Clone the repository:
git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name

2. Install PHP dependencies:
composer install

3. Create your environment file:
copy .env.example .env

4. Generate an application key:
php artisan key:generate

5. Configure your .env file:
•	Set up your DB_DATABASE, DB_USERNAME, and DB_PASSWORD to connect to a local MySQL database.
•	Add the required environment variables: GPS_API_KEY and SPEED_LIMIT_KPH.
6. Run the database migrations:
php artisan migrate

7. (Optional) Seed the database:
If you have a seeder or an SQL script, populate the database with initial data.

9. Serve the application:
php artisan serve

The API will be available at http://127.0.0.1:8000.

