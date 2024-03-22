# User Management System

This Laravel application is a Person Management System that allows admin to create users includig softdeleted. User address is created via event listener

## Technologies use

php "^8.2"
laravel "^11.0"

## Features

- User crud operation
- Adreess automically create via event
- Soflt deleted user crud

## Installation

1. **Clone the repository:** `git clone <https://github.com/Md-khaled/people-management>`
2. **Navigate to the project directory:** `cd user-management-system`
3. **Install Composer dependencies:** `composer install`
4. **Copy the `.env.example` file to `.env` and configure your environment variables likevMySql:** `cp .env.example .env`
5. **Generate a new application key:** `php artisan key:generate`
6. **Run database migrations to create the necessary tables:** `php artisan migrate:fresh`
7. **npm install and npm run dev**
8. **Serve the application:** `php artisan serve`

The application will be available at `http://localhost:8000`.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a pull request.

## License

This project is licensed under the [Khaled Mahmud](https://github.com/Md-khaled).
