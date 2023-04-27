# Video #233 - Seccion #20

## Seleccionar registros

### Seleccionar toda una tabla

```sql
SELECT * FROM servicios;
```

### Seleccionar columnas en particular

```sql
SELECT nombre FROM servicios;

SELECT nombre, precio FROM servicios;
```

## Ordenar consultas

### Orden ascendente

```sql
SELECT id, nombre, precio FROM servicios ORDER BY precio ASC;
```

### Orden descendente

```sql
SELECT id, nombre, precio FROM servicios ORDER BY precio DESC;
```

## Limites en consultas

```sql
SELECT id, nombre, precio FROM servicios LIMIT 2;
```

## Valores en especifico

```sql
SELECT id, nombre, precio FROM servicios WHERE id = 3;
```
