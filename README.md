### CRUD OPERATIONS FOR USERS WITH REST API

> CRUD operations for users using OOPS & REST API (Create, Read/View, Update, Delete, Search).

## Get started

1. Create a database named `crud-api` in MySQL, then import `crud-api.sql` file from the root folder.

2. Set database configuration in `config/configuration.php`

```
define('DBHOST', '127.0.0.1');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'crud-api');
```

3. API endpoints

###### HOST = localhost / 127.0.0.1
###### PROJECT_FOLDER_NAME = php-crud-api

http://HOST/PROJECT_FOLDER_NAME/api/get-all-users.php

http://HOST/PROJECT_FOLDER_NAME/api/create.php

http://HOST/PROJECT_FOLDER_NAME/api/update.php?id=YOUR_USER_ID

http://HOST/PROJECT_FOLDER_NAME/api/get-user.php?id=YOUR_USER_ID

http://HOST/PROJECT_FOLDER_NAME/api/delete.php?id=YOUR_USER_ID

http://HOST/PROJECT_FOLDER_NAME/api/search.php?q=SEARCH_QUERY_STRING

4. Import POSTMAN collection `Crud-API.postman_collection.json` to use API's more efficienty.