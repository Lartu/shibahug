<?php
mb_internal_encoding("UTF-8");

/*
sqlConnect($serverurl, $username, $password, $dbname)
Use: Used to connect to a database. It must be called before performing any other ShibaHug database operation.
Parameters:
    - $serverurl: your database url. For example, 'localhost'.
    - $username: the username used to connect to the database.
    - $password: the password used to connect to the database.
    - $dbname: the name of the database you wish to access.
Returns: Nothing
*/
function sqlConnect($serverurl, $username, $password, $dbname){
	global $conn;
	$conn = new mysqli($serverurl, $username, $password, $dbname);
	$conn->query("SET CHARACTER SET utf8mb4");
	if ($conn->connect_error) {
		die("ShibaHug Error: Connection to the database failed (" . $conn->connect_error.")");
	}
}

/*
sqlClose()
Use: closes the connection with the database.
*/
function sqlClose(){
	global $conn;
	$conn->close();
}

/*
sqlInsert($table, $fields, $values)
Use: Used to perform an SQL insertion on the connected database.
Parameters:
    - $table: the table where the values will be inserted.
    - $fields: the fields where the values will be inserted.
    - $values: the values to be inserted.
Example: sqlInsert('user', 'name, surname', '"John", "Smith"')
Returns: Nothing
*/
function sqlInsert($table, $fields, $values){
	global $conn;
	$sql = "INSERT INTO ".$table." (".$fields.") VALUES (".$values.")";
	if ($conn->query($sql) === TRUE) {
		return $last_id = $conn->insert_id;
	} else {
		echo("ShibaHug Error: sqlInsert failed (" . $conn->connect_error.")");
		return -1;
	}
}

/*
sqlSelect($table, $fields, $conditions)
Use: Returns an array of maps: the array is the number of rows that matched the conditions, [0] for the first one, [1] for the second, etc. Then the map is the fields requested from the row (as specified in $fields).
Parameters:
    - $table: the table used to select values from.
    - $fields: the fields used to select values from.
    - $conditions: the conditions the values to be brought must complay with.
Returns: the aforementioned array of maps.
Example: sqlSelect('user', 'surname', 'name="John"') will return the following array: [[surname: "Smith"]].
.*/
function sqlSelect($table, $fields, $conditions){
	global $conn;
	$sql = "SELECT * FROM ".$table." WHERE " . $conditions;
	$result = $conn->query($sql);
	$resultado = array();
	if($result->num_rows>0){
		$i=0;
		while($row = $result->fetch_assoc()){
			$resultado[$i] = $row;
			$i++;
		}
	}
	return ($resultado);
}

/*
sqlUpdate($table, $fields_values, $conditions)
Use: Used to perform an SQL update on the connected database.
Parameters:
    - $table: the table where the values will be inserted.
    - $fields_values: the fields and values to be updated.
    - $conditions: the conditions the values to be updated must complay with.
Example: sqlUpdate('user', 'surname="White"', 'name="John"')
Returns: Nothing
*/
function sqlUpdate($table, $fields_values, $conditions){
	global $conn;
	$sql = "UPDATE $table SET $fields_values WHERE $conditions";
	if ($conn->query($sql) !== TRUE) {
		die("ShibaHug Error: sqlUpdate failed (" . $conn->connect_error.")");
	}
}

/*
sqlDelete($table, $conditions)
Use: Deletes all rows from $table that match the conditions in $conditions.
Parameters:
    - $table: the table from where the values will be deleted.
    - $conditions: the conditions the values to be deleted must complay with.
Example: sqlDelete('user', 'surname="White"')
Returns: Nothing
*/
function sqlDelete($table, $conditions){
	global $conn;
	$sql = "DELETE FROM ".$table." WHERE " . $conditions;
	if ($conn->query($sql) !== TRUE) {
		die("ShibaHug Error: sqlDelete failed (" . $conn->connect_error.")");
	}
}

/*
sqlCount($table, $conditions)
Use: Counts all the rows that complay with the passed conditions.
Parameters:
    - $table: the table used to count values from.
    - $conditions: the aforementioned conditions.
Returns: the number of rows that comply with the conditions.
Example: sqlCount('user', 'name="John"')
.*/
function sqlCount($table, $conditions){
	global $conn;
	$sql = "SELECT COUNT(*) as cantidad FROM ".$table." WHERE " . $conditions;
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$valor=$row["cantidad"];
	return ($valor);
}

/*
sqlEncode($data)
Use: Encodes data so that it can be safely inserted into the database without risk of it being used to perform an SQL Inyection.
Parameters:
    - $data: the data to be encoded.
Returns: the encoded data.
.*/
function sqlEncode($data){
	$data = trim($data);
	$data =stripslashes($data);
	$data =htmlspecialchars($data);
	$data = addslashes($data);
	$data =str_replace("\"", "&#34;", $data);
	$data =str_replace("'", "&#39;", $data);
	return $data;
}
?>
