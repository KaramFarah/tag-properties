<h1>CRM SOFTWARE INSALL:</h1>

## Requirements

- Web server including:
- Composer softare
- PHP 8.1+
- MySQL 8.0+
- Apache/Nginx 
- All PHP modules for used laravel software

## Usage

- Clone the repository with `git clone`
- Copy `.env.example` file to `.env` and edit database credentials there
- Run: `inside storage/framework create this directories 'views' , 'sessions' , 'cache'`
- Run `composer install`
- Run `php artisan key:generate`
- Run `php artisan migrate --seed` (it has some seeded data - see below)
- Launch the main URL via: `php artisan serve` then after that's can view dashboard
- That's it: launch the main URL and login with default credentials `karam@tishreen.net` - `123123123`
- How can I display images? you can use the command line this `php artisan storage:link`
- For development: Run `php artisan serve`
- For production: Set up hosting and point to created folder above.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
"# laravel-AdsMangment-test" 
