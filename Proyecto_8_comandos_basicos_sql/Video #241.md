# Video #240 - Seccion #20

## Concatenar

### Concatenar resultados de una consulta

```sql
SELECT CONCAT(nombre, ' ', apellido) AS nombreCompleto FROM reservaciones;
+--------------------+
| nombreCompleto     |
+--------------------+
| Juan De la torre   |
| Antonio Hernandez  |
| Pedro Juarez       |
| Mireya Perez       |
| Jose Castillo      |
| Maria Diaz         |
| Clara Duran        |
| Miriam Ibañez      |
| Samuel Reyes       |
| Joaquin Muñoz      |
| Julia Lopez        |
| Carmen Ruiz        |
| Isaac Sala         |
| Ana Preciado       |
| Sergio Iglesias    |
| Aina Acosta        |
| Carlos Ortiz       |
| Roberto Serrano    |
| Carlota Perez      |
| Ana Maria Igleias  |
| Jaime Jimenez      |
| Roberto Torres     |
| Juan Cano          |
| Santiago Hernandez |
| Berta Gomez        |
| Miriam Dominguez   |
| Antonio Castro     |
| Hugo Alonso        |
| Victoria Perez     |
| Jimena Leon        |
| Raquel Peña        |
+--------------------+
```

```sql
SELECT * FROM reservaciones WHERE CONCAT(nombre, " ", apellido) LIKE '%Ana Preciado%';
+----+--------+----------+------------+------------------------+----------+
| id | nombre | hora     | fecha      | servicios              | apellido |
+----+--------+----------+------------+------------------------+----------+
| 14 | Ana    | 14:30:00 | 2021-06-28 | Corte de Cabello Mujer | Preciado |
+----+--------+----------+------------+------------------------+----------+

SELECT * FROM reservaciones WHERE CONCAT(nombre, " ", apellido) LIKE 'Carlos%';
+----+--------+----------+------------+------------------------+----------+
| id | nombre | hora     | fecha      | servicios              | apellido |
+----+--------+----------+------------+------------------------+----------+
| 17 | Carlos | 20:00:00 | 2021-06-25 | Corte de Cabello Niño  | Ortiz    |
+----+--------+----------+------------+------------------------+----------+

SELECT hora, fecha, servicios, CONCAT(nombre, " ", apellido) as nombreCompleto FROM reservaciones WHERE servicios LIKE "%cabello%";
+----------+------------+-----------------------------------------+--------------------+
| hora     | fecha      | servicios                               | nombreCompleto     |
+----------+------------+-----------------------------------------+--------------------+
| 10:30:00 | 2021-06-28 | Corte de Cabello Adulto, Corte de Barba | Juan De la torre   |
| 14:00:00 | 2021-07-30 | Corte de Cabello Niño                   | Antonio Hernandez  |
| 20:00:00 | 2021-06-25 | Corte de Cabello Adulto                 | Pedro Juarez       |
| 10:00:00 | 2021-07-01 | Uñas, Tinte, Corte de Cabello Mujer     | Clara Duran        |
| 09:00:00 | 2021-07-30 | Corte de Cabello Adulto                 | Isaac Sala         |
| 14:30:00 | 2021-06-28 | Corte de Cabello Mujer                  | Ana Preciado       |
| 10:00:00 | 2021-07-02 | Corte de Cabello Adulto                 | Sergio Iglesias    |
| 20:00:00 | 2021-06-25 | Corte de Cabello Niño                   | Carlos Ortiz       |
| 10:00:00 | 2021-07-30 | Corte de Cabello Niño                   | Roberto Serrano    |
| 14:00:00 | 2021-07-01 | Corte de Cabello Niño                   | Jaime Jimenez      |
| 10:00:00 | 2021-07-02 | Corte de Cabello Adulto                 | Roberto Torres     |
| 09:00:00 | 2021-07-02 | Corte de Cabello Niño                   | Juan Cano          |
| 19:00:00 | 2021-06-28 | Corte de Cabello Niño                   | Santiago Hernandez |
| 19:00:00 | 2021-06-28 | Corte de Cabello Niño                   | Miriam Dominguez   |
| 14:30:00 | 2021-07-02 | Corte de Cabello Adulti                 | Antonio Castro     |
| 10:30:00 | 2021-07-30 | Uñas, Corte de Cabello Mujer            | Jimena Leon        |
| 20:30:00 | 2021-06-25 | Corte de Cabello Mujer                  | Raquel Peña        |
+----------+------------+-----------------------------------------+--------------------+
```
