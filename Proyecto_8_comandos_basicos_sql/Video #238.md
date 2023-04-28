# Video #238 - Seccion #20

## Seleccionar por un determinado valor en ciertas columnas

```sql
SELECT * FROM servicios WHERE precio > 90;
+----+---------------------+--------+
| id | nombre              | precio |
+----+---------------------+--------+
|  6 | Tinte               | 300.00 |
|  7 | Uñas                | 400.00 |
|  9 | Tratamiento Capilar | 150.00 |
+----+---------------------+--------+

SELECT * FROM servicios WHERE precio <= 80;
+----+-------------------------+--------+
| id | nombre                  | precio |
+----+-------------------------+--------+
|  1 | Corte de Cabello Niño   |  60.00 |
|  2 | Corte de Cabello Hombre |  80.00 |
|  3 | Corte de Barba          |  60.00 |
|  4 | Peinado Mujer           |  80.00 |
|  5 | Peinado Hombre          |  60.00 |
|  8 | Lavado de Cabello       |  50.00 |
+----+-------------------------+--------+


SELECT * FROM servicios WHERE precio = 80;
+----+-------------------------+--------+
| id | nombre                  | precio |
+----+-------------------------+--------+
|  2 | Corte de Cabello Hombre |  80.00 |
|  4 | Peinado Mujer           |  80.00 |
+----+-------------------------+--------+

```

## Seleccionar por un intervalo de valores en ciertas columnas

```sql
SELECT * FROM servicios WHERE precio BETWEEN 100 AND 200;
+----+---------------------+--------+
| id | nombre              | precio |
+----+---------------------+--------+
|  9 | Tratamiento Capilar | 150.00 |
+----+---------------------+--------+
```
