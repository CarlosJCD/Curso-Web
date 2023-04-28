# Video #240 - Seccion #20

## Busquedas en SQL

### Busquedas con `LIKE`

`LIKE` retorna registros que coincidan ciertos valores.

```sql
SELECT * FROM servicios WHERE nombre LIKE 'Corte%';
+----+-------------------------+--------+
| id | nombre                  | precio |
+----+-------------------------+--------+
|  1 | Corte de Cabello Niño   |  60.00 |
|  2 | Corte de Cabello Hombre |  80.00 |
|  3 | Corte de Barba          |  60.00 |
+----+-------------------------+--------+

SELECT * FROM servicios WHERE nombre LIKE '%cabello%';
+----+-------------------------+--------+
| id | nombre                  | precio |
+----+-------------------------+--------+
|  1 | Corte de Cabello Niño   |  60.00 |
|  2 | Corte de Cabello Hombre |  80.00 |
|  8 | Lavado de Cabello       |  50.00 |
+----+-------------------------+--------+
```
