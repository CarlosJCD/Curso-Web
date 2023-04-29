# Video #251 - Seccion #22

## Consultas en la tabla pivote

```sql
SELECT * FROM citasServicios
    LEFT JOIN citas ON citas.id = citaId
    LEFT JOIN servicios ON servicios.id = citasServicios.servicioID

```
