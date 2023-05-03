<?php
function obtener_servicios()
{
    try {
        require 'database.php';

        $query_statement = "SELECT * FROM servicios";

        $query = mysqli_query($db_connection, $query_statement);

        return $query;
    } catch (mysqli_sql_exception $e) {
        echo '<pre>';
        var_dump($e);
        echo '</pre>';
    } finally {
        mysqli_close($db_connection);
    }
}
