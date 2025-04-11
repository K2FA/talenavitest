## TALENAVI TECH TEST
This is a backend developer tech test using Laravel 12. Laravel is a web application framework with expressive, elegant syntax.

### Installation Methods
1. Clone the repository
`git clone https://github.com/K2FA/talenavitest.git`
`cd talenavitest`

2. Install composer package
`composer install`

3. Open in code editor and Copy paste *.env-example*, rename copying env to *.env*

4. Make database talenavitest in MySQL database

5. In terminal run artisan syntax to generate key
`php artisan key:generate`

6. Migrate database
`php artisan migrate:fresh`

7. Run the server using artisan syntax
`php artisan serve`

### Testing Result
1. Open postman and create new collection

2. Add new request

3. Change method '**POST**, **GET**, **DELETE**, **PUT**' (according what you want to test)
`127.0.0.1:8000`

4. Add localhost server and url. Example:
`127.0.0.1:8000/api/todo`
