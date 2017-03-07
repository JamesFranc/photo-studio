<?php
//This php page should be Included on any page that requires a database connection
// Example: include("dbconnection.php");

//DB configuration Constants
define('_HOST_NAME_', 'localhost');
define('_USER_NAME_', 'root');
define('_DB_PASSWORD', 'root');
define('_DATABASE_NAME_', 'dbproject');
define('SALT_STRING', 'dbproject');
//PDO Database Connection
try {
  $databaseConnection = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
  $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "connected to the database as "._USER_NAME_."<br>";
} catch(PDOException $errMsg) {
  echo 'ERROR: ' . $errMsg->getMessage();
}

?>
