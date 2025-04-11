## TALENAVI TECH TEST
This is a backend developer tech test using Laravel 12. Laravel is a web application framework with expressive, elegant syntax.

### Installation Methods
1. Clone the repository
```bash
git clone https://github.com/K2FA/talenavitest.git
cd talenavitest
```

2. Install composer package
```bash
composer install
```

3. Open in code editor and Copy paste `.env-example`, rename copying env to `.env`

4. Make database talenavitest in MySQL database

5. In terminal run artisan syntax to generate key
```bash
php artisan key:generate
```

6. Migrate database
```bash
php artisan migrate:fresh
```

7. Run the server using artisan syntax
```bash
php artisan serve
```

### Testing Postman
1. Open postman and create new collection

2. Add new request

3. Change method `POST`, `GET`, `DELETE`, `PUT` *(according what you want to test)*
```bash
127.0.0.1:8000
```

4. Add localhost server and url. `Example:`
```bash
# Method POST
127.0.0.1:8000/api/todo
```

### Result
![Create Todo](https://github.com/K2FA/talenavitest/blob/master/public/images/todo-post.png)
![Status Chart](https://github.com/K2FA/talenavitest/blob/master/public/images/status-chart.png)
![Priority Chart](https://github.com/K2FA/talenavitest/blob/master/public/images/priority-chart.png)
![Assignee Chart](https://github.com/K2FA/talenavitest/blob/master/public/images/assignee-chart.png)
![Export Excel](https://github.com/K2FA/talenavitest/blob/master/public/images/export-excel.png)
