<?php
$dbMechine = "localhost";
$userName = "root";
$pass="";
$dbName = "studentform";
$con = "";



try{
     $con =mysqli_connect($dbMechine, $userName, $pass, $dbName);
     echo "database is connected";
}catch(mysqli_sql_exception){
    echo "database is not connected";
}
?>