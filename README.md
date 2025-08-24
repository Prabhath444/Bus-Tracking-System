<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPS Bus Tracking System - Laravel API</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f7fafc;
            color: #2d3748;
            line-height: 1.6;
            margin: 0;
            padding: 2rem;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem 3rem;
        }
        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a202c;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
            text-align: center;
        }
        h2 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #2d3748;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 0.5rem;
            margin-top: 2.5rem;
            margin-bottom: 1.5rem;
        }
        h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        p, ul {
            margin-bottom: 1rem;
            color: #4a5568;
        }
        ul {
            padding-left: 20px;
        }
        li {
            margin-bottom: 0.5rem;
        }
        strong {
            color: #2d3748;
            font-weight: 600;
        }
        code {
            font-family: "SFMono-Regular", Consolas, "Liberation Mono", Menlo, Courier, monospace;
            background-color: #edf2f7;
            color: #c53030;
            padding: 0.2em 0.4em;
            border-radius: 3px;
            font-size: 85%;
        }
        pre {
            background-color: #1a202c;
            color: #e2e8f0;
            padding: 1rem;
            border-radius: 8px;
            overflow-x: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        pre code {
            background-color: transparent;
            color: inherit;
            padding: 0;
            font-size: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }
        th, td {
            border: 1px solid #e2e8f0;
            padding: 0.75rem;
            text-align: left;
        }
        th {
            background-color: #f7fafc;
            font-weight: 600;
        }
        tbody tr:nth-child(odd) {
            background-color: #f7fafc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>GPS Bus Tracking System - Laravel API</h1>

        <p>This repository contains the source code for the RESTful backend API of the SLGPS Bus Tracking System. This powerful and secure API is built with Laravel and is designed to serve a decoupled frontend application, such as a React SPA.</p>
        <p>The API provides a complete solution for managing a fleet of buses, drivers, routes, and schedules, and includes real-time GPS location tracking with automated alert generation.</p>

        <h2>✨ Key Features</h2>
        <ul>
            <li><strong>Secure Authentication</strong>: Token-based authentication for users powered by <strong>Laravel Sanctum</strong>.</li>
            <li><strong>Role-Based Access Control (RBAC)</strong>: Utilizes Laravel Gates to ensure that only users with appropriate roles (e.g., 'Admin', 'Manager') can perform sensitive actions.</li>
            <li><strong>Full CRUD Functionality</strong>: Comprehensive, secure endpoints for managing all core resources: Users, Buses, Drivers, Routes, and Schedules.</li>
            <li><strong>Real-Time GPS Tracking</strong>: A dedicated endpoint to receive live location pings from GPS devices and endpoints to provide the latest location data for a live map.</li>
            <li><strong>Automated Alerting</strong>: The system automatically generates "Overspeed" alerts when a bus reports a speed exceeding a configurable limit.</li>
            <li><strong>Device Authentication</strong>: A custom middleware provides secure authentication for IoT/GPS devices using a static API key.</li>
            <li><strong>Dashboard Analytics</strong>: A single endpoint to retrieve high-level statistics for the admin dashboard.</li>
            <li><strong>Optimized Responses</strong>: Uses Laravel API Resources to transform and format all JSON responses, ensuring a clean and consistent data structure for the frontend.</li>
        </ul>

        <h2>🛠️ Tech Stack</h2>
        <ul>
            <li><strong>Backend Framework</strong>: Laravel 12</li>
            <li><strong>Language</strong>: PHP 8.2+</li>
            <li><strong>Database</strong>: MySQL</li>
            <li><strong>Authentication</strong>: Laravel Sanctum</li>
        </ul>

        <h2>🔌 API Endpoints</h2>
        <p>All endpoints are prefixed with <code>/api</code>.</p>
        <table>
            <thead>
                <tr>
                    <th>Method</th>
                    <th>Endpoint</th>
                    <th>Description</th>
                    <th>Authentication</th>
                    <th>Authorization</th>
                </tr>
            </thead>
            <tbody>
                <tr><td><code>POST</code></td><td><code>/login</code></td><td>Authenticates a user and returns a bearer token.</td><td>Public</td><td>N/A</td></tr>
                <tr><td><code>POST</code></td><td><code>/logout</code></td><td>Revokes the user's current token.</td><td>Sanctum Token</td><td>Authenticated User</td></tr>
                <tr><td><code>GET</code></td><td><code>/user</code></td><td>Returns the currently authenticated user's details.</td><td>Sanctum Token</td><td>Authenticated User</td></tr>
                <tr><td><code>apiResource</code></td><td><code>/buses</code></td><td>Full CRUD for managing buses.</td><td>Sanctum Token</td><td>Admin/Manager</td></tr>
                <tr><td><code>apiResource</code></td><td><code>/drivers</code></td><td>Full CRUD for managing drivers.</td><td>Sanctum Token</td><td>Admin/Manager</td></tr>
                <tr><td><code>apiResource</code></td><td><code>/routes</code></td><td>Full CRUD for managing routes.</td><td>Sanctum Token</td><td>Admin/Manager</td></tr>
                <tr><td><code>apiResource</code></td><td><code>/schedules</code></td><td>Full CRUD for managing schedules.</td><td>Sanctum Token</td><td>Admin/Manager</td></tr>
                <tr><td><code>apiResource</code></td><td><code>/users</code></td><td>Full CRUD for managing users.</td><td>Sanctum Token</td><td>Admin Only</td></tr>
                <tr><td><code>POST</code></td><td><code>/location/ping</code></td><td>Receives a GPS location ping from a device.</td><td><strong>X-API-KEY</strong></td><td>Trusted Device</td></tr>
                <tr><td><code>GET</code></td><td><code>/location/latest</code></td><td>Gets the latest location for all buses.</td><td>Sanctum Token</td><td>Authenticated User</td></tr>
                <tr><td><code>GET</code></td><td><code>/buses/{id}/location/latest</code></td><td>Gets the latest location for a single bus.</td><td>Sanctum Token</td><td>Authenticated User</td></tr>
                <tr><td><code>GET</code></td><td><code>/alerts</code></td><td>Lists all system-generated alerts.</td><td>Sanctum Token</td><td>Admin/Manager</td></tr>
                <tr><td><code>GET</code></td><td><code>/dashboard</code></td><td>Retrieves statistics for the main dashboard.</td><td>Sanctum Token</td><td>Admin/Manager</td></tr>
                <tr><td><code>GET</code></td><td><code>/schedule-options</code></td><td>Gets lists of buses, drivers, and routes for forms.</td><td>Sanctum Token</td><td>Admin/Manager</td></tr>
            </tbody>
        </table>

        <h2>frontend-integration Frontend Integration</h2>
        <p>This API is designed to be consumed by a Single Page Application (SPA). The recommended frontend is a React application that uses the following architecture:</p>
        <ul>
            <li><strong>API Client</strong>: <strong>Axios</strong> is used for all HTTP requests. A central <code>apiClient</code> instance is configured with the base URL of the API.</li>
            <li><strong>Authentication Flow</strong>:
                <ol>
                    <li>The React app sends user credentials to the <code>/api/login</code> endpoint.</li>
                    <li>Upon success, the received Bearer Token is stored in the browser's <strong><code>localStorage</code></strong> for session persistence.</li>
                    <li>The central <code>apiClient</code> instance is dynamically configured to include the <code>Authorization: Bearer &lt;token&gt;</code> header on all subsequent requests.</li>
                </ol>
            </li>
            <li><strong>State Management</strong>: A global <strong>React Context</strong> (<code>AuthContext</code>) manages the user's authentication state (<code>user</code>, <code>token</code>, <code>loading</code>), making it accessible to all components.</li>
            <li><strong>Protected Routes</strong>: <code>react-router-dom</code> is used for routing. A custom <code>ProtectedRoute</code> component wraps all sensitive pages, automatically redirecting unauthenticated users to the sign-in page.</li>
        </ul>

        <h2>☁️ Cloud Deployment Guide (Google Cloud Platform)</h2>
        <p>This application is configured for deployment on <strong>Google Cloud Run</strong> with a <strong>Google Cloud SQL</strong> database.</p>
        <ol>
            <li><strong>Prepare the Project</strong>: The repository includes a multi-stage <code>Dockerfile</code>, an <code>entrypoint.sh</code> script, and a <code>.dockerignore</code> file for building a production-ready container.</li>
            <li><strong>Google Cloud Setup</strong>: Create a GCP project, enable billing, and enable the required APIs (Cloud Run, Cloud SQL, Artifact Registry, etc.). Create a Cloud SQL for MySQL instance.</li>
            <li><strong>Build & Push the Container</strong>: Use Cloud Build (<code>gcloud builds submit</code>) to build the container image and push it to Artifact Registry.</li>
            <li><strong>Deploy to Cloud Run</strong>: Create a Cloud Run service, select the container image, and configure it with the correct port (<code>8080</code>), a connection to your Cloud SQL instance, and all necessary environment variables and secrets (using Secret Manager).</li>
        </ol>

        <h2>🚀 Local Setup and Installation</h2>
        <p>To get the project running on a local development machine, follow these steps:</p>
        
        <h3>1. Clone the repository:</h3>
        <pre><code>git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name</code></pre>

        <h3>2. Install PHP dependencies:</h3>
        <pre><code>composer install</code></pre>

        <h3>3. Create your environment file:</h3>
        <pre><code>copy .env.example .env</code></pre>

        <h3>4. Generate an application key:</h3>
        <pre><code>php artisan key:generate</code></pre>

        <h3>5. Configure your <code>.env</code> file:</h3>
        <ul>
            <li>Set up your <code>DB_DATABASE</code>, <code>DB_USERNAME</code>, and <code>DB_PASSWORD</code> to connect to a local MySQL database.</li>
            <li>Add the required environment variables: <code>GPS_API_KEY</code> and <code>SPEED_LIMIT_KPH</code>.</li>
        </ul>

        <h3>6. Run the database migrations:</h3>
        <pre><code>php artisan migrate</code></pre>

        <h3>7. (Optional) Seed the database:</h3>
        <p>If you have a seeder or an SQL script, populate the database with initial data.</p>

        <h3>8. Serve the application:</h3>
        <pre><code>php artisan serve</code></pre>
        <p>The API will be available at <code>http://127.0.0.1:8000</code>.</p>
    </div>
</body>
</html>
