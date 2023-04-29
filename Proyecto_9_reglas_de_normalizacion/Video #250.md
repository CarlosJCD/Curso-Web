# Video #249 - Seccion #22

## Tablas pivote

```sql
CREATE TABLE citaServicios(
    id INT(11) NOT NULL AUTO_INCREMENT,
    citaId INT(11) NOT NULL,
    servicioID INT(11) NOT NULL,
    PRIMARY KEY (id),
    KEY citaId (citaId),
    CONSTRAINT citas_FK
    FOREIGN KEY (citaId)
    REFERENCES citas (id),
    KEY servicioId (servicioId),
    CONSTRAINT servicios_FK
    FOREIGN KEY (servicioId)
    REFERENCES servicios (id)
    );
```
