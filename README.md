# Task Management

Postman Exported Collection Link:

https://cloudy-zodiac-270430.postman.co/workspace/Erwin~44f26bcd-1855-474c-8632-8f615e0b930a/collection/2778039-891e8da5-1247-4284-a240-a2e53957413c?action=share&creator=2778039

## Project Setup Guide

Welcome to the project! Follow these steps to set up both the backend and frontend locally on your computer after cloning the repositories.

# Backend Setup

## Step 1: Clone the Repository

```bash
git clone https://github.com/erwin-real/task-management.git

cd backend
```

## Step 2: Install Dependencies

Ensure Composer is installed, then run:

```bash
composer install
```

## Step 3: Configure Environment Variables

- Create a .env file:

```bash
  cp .env.example .env
```

- Update the .env file with your environment details, such as database credentials:

```bash
  DB_CONNECTION=mysql

  DB_HOST=127.0.0.1

  DB_PORT=3306

  DB_DATABASE=your_database_name

  DB_USERNAME=your_username

  DB_PASSWORD=your_password
```

## Step 4: Generate the Application Key

Run the following command to generate an application key:

```bash
php artisan key:generate
```

## Step 5: Set Up the Database

- Create a database in your MySQL server with the name specified in the .env file.

- Run migrations to set up the schema:

```bash
  php artisan migrate
```

## Step 6: Seed the Database (Optional)

If the project requires seeded data, run:

```bash
php artisan db:seed
```

## Step 7: Start the Backend Server

Start the Laravel development server:

```bash
php artisan serve
```

Your backend will be running at http://localhost:8000.

# Frontend Setup

## Step 1: Clone the Repository

```bash
git clone https://github.com/erwin-real/task-management.git

cd frontend
```

## Step 2: Install Dependencies

Ensure Node.js is installed, then run:

```bash
npm install
```

## Step 3: Start the Frontend Development Server

Start the Vue development server:

```bash
npm run dev
```

Your frontend will be running at http://localhost:5173.

## Connecting Frontend and Backend (Optional)

## Step 1: Enable CORS (Cross-Origin Resource Sharing)

Update the backend’s config/cors.php file to allow requests from the frontend:

```bash
'allowed_origins' => ['http://localhost:5173'],
```

## Step 2: Sanctum Configuration

If using Laravel Sanctum, ensure the SANCTUM_STATEFUL_DOMAINS environment variable includes the frontend domain:

```bash
SANCTUM_STATEFUL_DOMAINS=localhost:5173
```

## Common Issues and Troubleshooting

- Missing Dependencies:- Ensure Composer, Node.js, and npm are installed.

- Database Connection Issues:- Verify database credentials in the .env file.

- CORS Errors:- Update the backend's config/cors.php file.

- Version Conflicts:- Ensure the correct versions of PHP, Node.js, and dependencies specified in composer.json and package.json are installed.
