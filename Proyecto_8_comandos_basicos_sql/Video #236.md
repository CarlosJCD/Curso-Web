# Video #236 - Seccion #20

## Añadir una columna a una tabla

```sql
ALTER TABLE servicios ADD descripcion VARCHAR(100) NOT NULL;
```

## Modificar una columna de una tabla

NOTA: No se puede modificar el tipo de dato que maneja la columna, pero si la extension del dato.

```sql
ALTER TABLE servicios CHANGE descripcion info_servicio VARCHAR(80) NOT NULL;
```
