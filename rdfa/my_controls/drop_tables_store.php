<?php

//Drop all tables from DB

$mysqli = new mysqli("localhost", "root", "root", "p-dpa-sparql");
$mysqli->query('SET foreign_key_checks = 0');
if ($result = $mysqli->query("SHOW TABLES"))
{
    while($row = $result->fetch_array(MYSQLI_NUM))
    {
        $mysqli->query('DROP TABLE IF EXISTS '.$row[0]);
    }
}

$mysqli->query('SET foreign_key_checks = 1');
$mysqli->close();

echo 'All tables dropped!';
?>