<?php
function obtener_servicios()
{
    try {
        require 'database.php';

        $query_statement = "SELECT * FROM servicios";

        $query = mysqli_query($db_connection, $query_statement);

        echo '<pre>';
        var_dump(mysqli_fetch_all($query));
        echo '</pre>';
    } catch (mysqli_sql_exception $e) {
        echo '<pre>';
        var_dump($e);
        echo '</pre>';
    } finally {
        $db_closed = mysqli_close($db_connection);
        echo '<pre>';
        var_dump($db_closed);
        echo '</pre>';
    }
}

obtener_servicios();
