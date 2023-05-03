<?php

$db_connection = mysqli_connect(hostname: 'localhost', password: '', username: 'root', database: 'appsalon');

echo '<pre>';
var_dump($db_connection);
echo '</pre>';
