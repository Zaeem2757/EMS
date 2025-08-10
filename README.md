## Setup Instructions:

-clone this: https://github.com/Zaeem2757/EMS.git
- run composer install command in the terminal
- create database in mysql with name "ems".
- run php artisan migrate in terminal
- open seeders and made changes in Database seeders like change name and password for your admin user.
- then first run RoleSeeder php artisan db:seed --class=RoleSeeder and then php artisan db:seed --class=DatabaseSeeder
- run "php artisan serve" and open (http://127.0.0.1:8000) in browser for local development server.
- now you are good to go open the project and add Departments and Employees Enjoy!!!!.
