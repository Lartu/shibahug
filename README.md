![picture](https://img.shields.io/badge/version-2.1-green.svg)

# 🐕 ShibaHug 🐕
PHP library that makes interfacing PHP with MySQL as easy as pie!

## Why use ShibaHug?

ShibaHug is designed to be super easy to use, super tiny and super straight to the point. You could use bigger and more complicated libraries, with certainly more features, or just use the build in methods and classes PHP offers, but if you want something simple and clean that's definitely plug-and-play with no fuss and no problems, you should give ShibaHug a try.

## How to install
Just include de ShibaHug library in your project and you are done.
```php
include "shibahug.php";
```
ShibaHug requires the `mysqli` module to be available. If you have a default *PHP 5* or above installation you should be alright. If you purposely disabled the module, you should enable it in order to use this library.

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

- - - -

### sqlClose
**Function:** `sqlClose()`

**Use:** closes the connection with the database.

**Parameters:** None

**Returns:** Nothing

- - - -

### sqlInsert
**Function:** `sqlInsert($table, $fields, $values)`

**Use:** Used to perform an SQL insertion on the connected database.

**Parameters:**
 * `$table`: the table where the values will be inserted.
 * `$fields`: the fields where the values will be inserted.
 * `$values`: the values to be inserted.\
**Returns:** Nothing

**Example:** `sqlInsert('user', 'name, surname', '"John", "Smith"')`

- - - -

### sqlSelect
**Function:** `sqlSelect($table, $fields, $conditions)`

**Use:** Returns an array of maps: the array is the number of rows that matched the conditions, [0] for the first one, [1] for the second, etc. Then the map is the fields requested from the row (as specified in $fields).

**Parameters:**
 * `$table`: the table used to select values from.
 * `$fields`: the fields used to select values from.
 * `$conditions`: the conditions the values to be brought must comply with.
 
**Returns:** the aforementioned array of maps.

**Example:** `sqlSelect('user', 'surname', 'name="John"')` will return the following array: `[[surname: "Smith"]]`.

- - - -

### sqlUpdate
**Function:** `sqlUpdate($table, $fields_values, $conditions)`

**Use:** Used to perform an SQL update on the connected database.

**Parameters:**
 * `$table`: the table where the values will be updated.
 * `$fields_values`: the fields and values to be updated.
 * `$conditions`: the conditions the values to be updated must comply with.
 
**Returns:** Nothing

**Example:** `sqlUpdate('user', 'surname="White"', 'name="John"')`

- - - -

### sqlDelete
**Function:** `sqlDelete($table, $conditions)`

**Use:** Deletes all rows from `$table` that match the conditions in `$conditions`.

**Parameters:**
 * `$table`: the table from where the values will be deleted.
 * `$conditions`: the conditions the values to be deleted must comply with.
 
**Returns:** Nothing

**Example:** `sqlDelete('user', 'surname="White"')`

- - - -

### sqlCount
**Function:** `sqlCount($table, $conditions)`

**Use:** Counts all the rows that comply with the passed conditions.

**Parameters:**
 * `$table`: the table used to count values from.
 * `$conditions`: the aforementioned conditions.
 
**Returns:** the number of rows that comply with the conditions.

**Example:** `sqlCount('user', 'name="John"')`

- - - -

### sqlEncode
**Function:** `sqlEncode($data)`

**Use:** Encodes data so that it can be safely inserted into the database without risk of it being used to perform an SQL Inyection.

**Parameters:**
 * `$data`: the data to be encoded.
 
**Returns:** the encoded data.

**Example:** `sqlEncode('x'; DROP TABLE members; --')`
