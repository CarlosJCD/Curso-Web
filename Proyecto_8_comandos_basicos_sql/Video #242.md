# Video #242 - Seccion #20

## Seleccionar por condiciones

```sql
SELECT * FROM reservaciones WHERE id IN(1,3);
+----+--------+----------+------------+-----------------------------------------+-------------+
| id | nombre | hora     | fecha      | servicios                               | apellido    |
+----+--------+----------+------------+-----------------------------------------+-------------+
|  1 | Juan   | 10:30:00 | 2021-06-28 | Corte de Cabello Adulto, Corte de Barba | De la torre |
|  3 | Pedro  | 20:00:00 | 2021-06-25 | Corte de Cabello Adulto                 | Juarez      |
+----+--------+----------+------------+-----------------------------------------+-------------+

SELECT * FROM reservaciones WHERE servicios LIKE '%mujer%' AND fecha LIKE '%-06-%';
+----+--------+----------+------------+------------------------+----------+
| id | nombre | hora     | fecha      | servicios              | apellido |
+----+--------+----------+------------+------------------------+----------+
|  4 | Mireya | 19:00:00 | 2021-06-25 | Peinado Mujer          | Perez    |
| 14 | Ana    | 14:30:00 | 2021-06-28 | Corte de Cabello Mujer | Preciado |
| 31 | Raquel | 20:30:00 | 2021-06-25 | Corte de Cabello Mujer | Peña     |
+----+--------+----------+------------+------------------------+----------+
```
