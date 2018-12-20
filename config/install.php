<?php

/**
 * Open a connection via PDO to create a
 * new database and table with structure.
 *
 */

require 'config.php';

$installDB = 'CREATE DATABASE ' . DBNAME . ';

use '  . DBNAME . ';

CREATE TABLE ' . USERSTABLE . '(
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	email VARCHAR(50) NOT NULL,
	age INT(3),
	location VARCHAR(50),
	date TIMESTAMP
);';

try {
    $connection = new PDO('mysql:host ' . HOST, USERNAME, PASSWORD, OPTIONS);
    $connection->exec($installDB);
    
    echo "Database and table users created successfully.";
} catch(PDOException $error) {
    echo $tableUsers . "<br>" . $error->getMessage();
}
