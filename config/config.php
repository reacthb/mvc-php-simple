<?php

/**
 * Configuration for database connection
 *
 */
const HOST = "localhost";
const USERNAME = "root";
const PASSWORD = "2357@Mysql";
const DBNAME = "mvc_crud";
const DSN = "mysql:host=" . HOST . ";dbname=" . DBNAME. ";charset=utf8";
const OPTIONS = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
const USERSTABLE = "users";
