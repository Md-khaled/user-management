Person Management System
This Laravel application is a Person Management System that allows admin to create users includig softdeleted. User address is created via event listener

Technologies use
php "^8.2"
laravel "^11.0"

Features
User crud operation
Adreess automically create via event
Soflt deleted user crud

Installation
Clone the repository: git clone
Navigate to the project directory: cd user-management-system
Install Composer dependencies: composer update
Copy the .env.example file to .env and configure your environment variables like MySql: cp .env.example .env
Generate a new application key: php artisan key:generate
Run database migrations to create the necessary tables: php artisan migrate:fresh
Install npm
Run: npm run dev
The application will be available at http://localhost:8000.

License
This project is licensed under the Khaled Mahmud.