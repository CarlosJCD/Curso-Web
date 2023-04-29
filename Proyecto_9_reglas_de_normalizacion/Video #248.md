# Video #248 - Seccion #22

## Relacionar 2 tablas

```sql
CREATE TABLE citas (
    id INT(11) NOT NULL AUTO_INCREMENT,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    clienteId INT(11) NOT NULL,
    PRIMARY KEY (id),
    KEY clienteID (clienteID),
    CONSTRAINT cliente_FK
    FOREIGN KEY (clienteID)
    REFERENCES clientes (id)
    );

SHOW TABLES;
+--------------------+
| Tables_in_appsalon |
+--------------------+
| citas              |
| clientes           |
| servicios          |
+--------------------+

```
