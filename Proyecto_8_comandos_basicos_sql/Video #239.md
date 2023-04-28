# Video #239 - Seccion #20

## Funciones Agregadoras

### Contabilizar.

Contabiliar cuantos `n` registros tienen `x` valor en una determinada tabla.

```sql
SELECT COUNT(id), fecha FROM reservaciones GROUP BY fecha ORDER BY COUNT(id) DESC;
+-----------+------------+
| COUNT(id) | fecha      |
+-----------+------------+
|         7 | 2021-07-02 |
|         6 | 2021-06-28 |
|         6 | 2021-07-30 |
|         6 | 2021-06-25 |
|         6 | 2021-07-01 |
+-----------+------------+
```

### Sumatoria

Sumatoria de una columna con valores numericos de una determinada tabla bajo un alias temporal.

```sql
SELECT SUM(precio) AS totalServicios FROM servicios;
+----------------+
| totalServicios |
+----------------+
|        1240.00 |
+----------------+
```

### Valor minimo

Retorna el menor valor de x columna en una determinada tabla bajo un alias temporal.

```sql
SELECT MIN(precio) AS precioMenor FROM servicios;
+-------------+
| precioMenor |
+-------------+
|       50.00 |
+-------------+
```

### Valor máximo

Retorna el menor valor de x columna en una determinada tabla bajo un alias temporal.

```sql
SELECT MAX(precio) AS precioMayor FROM servicios;
+-------------+
| precioMayor |
+-------------+
|      400.00 |
+-------------+
```
