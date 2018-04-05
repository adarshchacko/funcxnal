# funcxnal

**A sample project to illustrate search**


Steps to be taken:

1. Create a database with the name **funcxnal**.

2. Make necessary changes in .env file so that the relevant values looks as follows:

```
APP_NAME=Funcxnal

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=funcxnal
DB_USERNAME=<username>
DB_PASSWORD=<password>

```



In the terminal

3. Run ```composer update```

4. Run ```php artisan migrate```

5. Run ```php artisan db:seed```

6. Run ```php artisan serve```

7. Open **localhost:8000** in the browser.

8. You need to register yourself / login, to use search.