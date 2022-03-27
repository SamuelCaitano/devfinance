<?php
 
// set timezone
date_default_timezone_set("America/Sao_Paulo");

// database credentials
define("dbhost", "localhost");
define("dbname", "devfinance");
define("dbuser", "root");
define("dbpass", ""); 

try {
  $conn = new PDO("mysql:host=".dbhost.";dbname=".dbname, dbuser, dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
