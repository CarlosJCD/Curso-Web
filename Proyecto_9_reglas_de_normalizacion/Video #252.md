# Video #252 - Seccion #22

## Multiples Joins para la tabla pibote

```sql
SELECT * citasServicios
    LEFT JOIN citas ON citas.id = citaServicios.citaId
    LEFT JOIN clientes ON citas.clienteId = clientes.ID
    LEFT JOIN servicios ON servicios.Id = citasServicios.servicioID
```
