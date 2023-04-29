# Video #249 - Seccion #22

## Unir 2 tablas

NOTA:

- INNER: Retorna registros coincidentes en ambas tablas
- LEFT: Retorna todos los registros de la izquierda y los que coincidad con los de la derecha.
- LEFT: Retorna todos los registros de la derecha y los que coincidad con los de la izquierda.

```sql
SElECT * FROM citas INNER JOIN clientes ON clientes.id = citas.clienteId;
```
