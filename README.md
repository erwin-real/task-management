# Task Management

Postman Exported Collection Link:

https://cloudy-zodiac-270430.postman.co/workspace/Erwin~44f26bcd-1855-474c-8632-8f615e0b930a/collection/2778039-891e8da5-1247-4284-a240-a2e53957413c?action=share&creator=2778039

Project Setup Guide

Welcome to the project! Follow these steps to set up both the backend and frontend locally on your computer after cloning the repositories.

Backend Setup
Step 1: Clone the Repository
git clone https://github.com/erwin-real/task-management.git
cd backend

Step 2: Install Dependencies
Ensure Composer is installed, then run:
composer install

Step 3: Configure Environment Variables

- Create a .env file:
  cp .env.example .env

- Update the .env file with your environment details, such as database credentials:
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=your_database_name
  DB_USERNAME=your_username
  DB_PASSWORD=your_password

Step 4: Generate the Application Key
Run the following command to generate an application key:
php artisan key:generate

Step 5: Set Up the Database

- Create a database in your MySQL server with the name specified in the .env file.
- Run migrations to set up the schema:
  php artisan migrate

Step 6: Seed the Database (Optional)
If the project requires seeded data, run:
php artisan db:seed

Step 7: Start the Backend Server
Start the Laravel development server:
php artisan serve

Your backend will be running at http://localhost:8000.
