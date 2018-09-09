# ShibaHug
PHP library that makes interfacing PHP with MySQL as easy as pie! 

## How to install
Just include de ShibaHug library in your project and you are done.
```php
include "shibahug.php";
```
## How to Use
After including the library in your project, you'll have to connect to a database. I normaly recommend storing your connection parameters in separate variables and then calling the connection with those variables as parameters whenever you want to perform an operation on your database, but that's up to you.

```php
//Connection parameters
$database_url = "localhost";
$username = "myUser";
$password = "password1234";
$dbname = "myDatabase";

//Connect to the database
sqlConnect($database_url, $username, $password, $dbname);
```

After you've finished doing whatever it was you needed to do with your database, close the connection using:
```php
sqlClose();
```

## Available Operations
### sqlConnect
**Function:** `sqlConnect($serverurl, $username, $password, $dbname)`
**Use:** Used to connect to a database. It must be called before performing any other ShibaHug database operation.
**Parameters:**
 * `$table`: the table where the values will be inserted.
 * `$serverurl`: your database url. For example, 'localhost'.
 * `$username`: the username used to connect to the database.
 * `$password`: the password used to connect to the database.
 * `$dbname`: the name of the database you wish to access.
**Returns:** Nothing

### sqlClose
**Function:** `sqlClose()`
**Use:** closes the connection with the database.
**Parameters:** None
**Returns:** Nothing

### sqlInsert
**Function:** `sqlInsert($table, $fields, $values)`
**Use:** Used to perform an SQL insertion on the connected database.
**Parameters:**
 * `$table`: the table where the values will be inserted.
 * `$fields`: the fields where the values will be inserted.
 * `$values`: the values to be inserted.
**Returns:** Nothing
**Example:** `sqlInsert('user', 'name, surname', '"John", "Smith"')`

### sqlSelect
**Function:** `sqlSelect($table, $fields, $conditions)`
**Use:** Returns an array of maps: the array is the number of rows that matched the conditions, [0] for the first one, [1] for the second, etc. Then the map is the fields requested from the row (as specified in $fields).
**Parameters:**
 * `$table`: the table used to select values from.
 * `$fields`: the fields used to select values from.
 * `$conditions`: the conditions the values to be brought must complay with.
**Returns:** the aforementioned array of maps.
**Example:** `sqlSelect('user', 'surname', 'name="John"')` will return the following array: `[[surname: "Smith"]]`.
